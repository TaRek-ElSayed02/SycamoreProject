<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserChoice;
use App\Models\Patient;

class UserChoiceController extends Controller
{
    public function store(Request $request, $patientId)
    {
        // Validate the request data
        $request->validate([
            'choice' => 'required|in:Pulmonary fibrosis,Pulmonary embolism,Pneumonia,Interstitial lung disease',
        ]);

        // Check if the patient exists
        $patient = Patient::find($patientId);
        if (!$patient) {
            return response()->json(['message' => 'Patient not found'], 404);
        }

        // Create a new user choice for the patient
        $choice = new UserChoice();
        $choice->choice = $request->choice;
        $choice->patient_id = $patientId; // Associate the choice with the patient
        $choice->save();

        return response()->json(['message' => 'Choice stored successfully', 'choice' => $choice], 201);
    }
}
