import pyautogui
import random
import time
import requests

url = 'https://tooreal.tech/upload.php'

def take_screenshot():
    screenshot = pyautogui.screenshot()
    screenshot.save("screenshot.png")

for i in range(1):
    random_time = random.randint(0, 3600)
    remainder = 3600 - random_time
    time.sleep(random_time)

    take_screenshot()
    files = {
        'imageFile': ('screenshot.png', open('screenshot.png', 'rb'), 'image/png'),
        # fill in your username and password here
        'username': (None, '[USERNAME]'),
        'password': (None, '[PASSWORD]')
    }

    response = requests.post(url, files=files)
    
    if response.status_code == 200:
        print('Successfully uploaded file.')
        print('Server Response:', response.text)
    else:
        print(f'Failed to upload file. Status code: {response.status_code}')
        print('Server Response:', response.text)
    
    time.sleep(remainder)