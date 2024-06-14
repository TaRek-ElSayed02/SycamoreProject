from flask import Flask, request, jsonify
import numpy as np
import pickle

app = Flask(__name__)

# Load the model
model = pickle.load(open("model_pickle1.pkl", "rb"))


# Define the predict function
def predict(oxy, pulse, clieus):
    result = np.array([[float(oxy), float(pulse), float(clieus)]])
    prediction = model.predict(result)
    print(prediction)
    return prediction.item()


# Define the API endpoint for prediction
@app.route('/predict', methods=['GET'])
def predict_endpoint():
    # Get the query parameters from the request
    oxy = request.args.get('oxy')
    pulse = request.args.get('pulse')
    clieus = request.args.get('clieus')

    # Validate query parameters
    if oxy is None or pulse is None or clieus is None:
        return jsonify({"error": "Missing parameters: oxy, pulse, and clieus are required"}), 400

    try:
        # Perform prediction
        prediction = predict(oxy, pulse, clieus)
    except ValueError as e:
        return jsonify({"error": f"Invalid input: {str(e)}"}), 400

    # Save the prediction result back to the Laravel API
    payload = {
        "oxygen_rate": oxy,
        "heart_rate": pulse,
        "clieus": clieus,
        "prediction": prediction
    }

    response = request.post('http://127.0.0.1:8000/api/sensor_data', json=payload)

    if response.status_code == 201:
        result = {"prediction": prediction}
    else:
        result = {"error": "Failed to save prediction to the database"}

    # Return response as JSON
    return jsonify(result)


# Define a route for the root URL
@app.route('/')
def index():
    return 'Welcome to my Flask API!'


# Define a route for the favicon
@app.route('/favicon.ico')
def favicon():
    return '', 404


if __name__ == '__main__':
    app.run(port=8080, debug=True)
