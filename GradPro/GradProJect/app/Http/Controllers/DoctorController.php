<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Helpers\ApiResponse;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
#added
#added token 
use Laravel\Sanctum\PersonalAccessToken;

#------
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
//use Validator;
use Illuminate\Database\Eloquent\Factories\Factory;


class DoctorController extends Controller{

    public function register(Request $request)
    {
        $validator= Validator::make($request->all(),[
            'Name' => 'required|string',
            'Email'=>'required|string|email|unique:doctors,Email',
            'Password'=>'required|string|min:7',
            'Password_Confirmation'=>'required|string|min:7'
        ]);
        if ($validator->fails()){
            return response()->json($validator->errors()->toJson(),400);

        }
        $doctor= Doctor::create(array_merge(
            $validator->validated(), 
            ['Name' => $request->input('Name')],
            ['Email' => $request->input('Email')],
            ['Password' => bcrypt($request->Password)],
            #added
            ['Password_Confirmation' => bcrypt($request->Password_Confirmation)],
 
        ));

        #added
        $token = $doctor->createToken('DoctorAuthToken')->plainTextToken;


        return response()->json([
            'message' => "Doctor successfully registered",
            'Doctor' => $doctor,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ],201);
    
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Name' => 'required|string',
            'Email' => 'required|email',
            'Password' => 'required|string|min:7',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
    
        $Name = $request->input('Name');
        $email = $request->input('Email');
        $password = $request->input('Password');
    
        $authenticatedDoctor = Doctor::where('Email', $email)->first();
    
        if ($authenticatedDoctor && Hash::check($password, $authenticatedDoctor->Password)) {
            $token = $authenticatedDoctor->createToken('DoctorAuthToken')->plainTextToken;
    
            return $this->createToken($token, $email, $password,$Name);  
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
    

    
    public function createToken($token, $email, $password ,$Name)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'email' => $email,
            'Name'=>$Name,
            'password' => $password,
        ]);
    }

    

    #logout for doctor
    public function logout(Request $request)
    {
        $acessToken = $request->bearerToken();
        $token = PersonalAccessToken::findToken($acessToken);
        $token->delete();
        return response(
            [
                'message' =>'Doctor logout successfuly',
                'status' => 'success'
            ], status:200
        );
    }

    #to retrieve doctor info 
    public function doctorinfo()
   {
       $doctor = Doctor::all(); // Retrieve all doctor
       return response()->json($doctor);
   }

   #to delete doctor according to his id
   public function destroy($id)
    {
        try {
            $doctor = Doctor::findOrFail($id);
            $doctor->delete();
            
            return response()->json(['message' => 'Doctor deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete doctor'], 500);
        }
    }

    public function listname(Request $request)
    {
        $doctorNames = Doctor::select('Name')->get(); // Retrieve only the names of all doctors
        return response()->json(['doctors' => $doctorNames],200);
    }



}