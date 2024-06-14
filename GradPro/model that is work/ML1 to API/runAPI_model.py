import requests


# URL of the Flask API
url = 'http://127.0.0.1:8080/predict'

# Prompt the user to input values for oxy, pulse, and clieus
oxy = float(input("Enter the value for oxy: "))
pulse = float(input("Enter the value for pulse: "))
clieus = float(input("Enter the value for clieus: "))

# Input data for prediction
data = {
    'oxy': oxy,
    'pulse': pulse,
    'clieus': clieus
}

# Send POST request to the Flask API
response = requests.post(url, json=data)

# Check if request was successful (status code 200)
if response.status_code == 200:
    # Parse JSON response
    result = response.json()
    # Get the prediction from the response
    prediction = result['prediction']
    print('Prediction:', prediction)
else:
    print('Error:', response.text)