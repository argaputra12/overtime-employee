# Overtime Letter Printing Application

This application is designed to make it easier for employees to request overtime letters. With this application, employees can request overtime letters online and have them approved by their superiors or HRD.

## Features

- Requesting overtime letters
- Approving overtime letters
- Printing approved overtime letters
- Sending notifications to superiors or HRD

## Installation

1. Clone this repository
2. Run the command `composer install`
3. Copy file `.env.example` to `.env`
4. Run the command `npm install`
5. Create a new database and configure it in the `.env` file
6. Run the command `php artisan migrate`
7. Run the command `php artisan db:seed`
8. Run the command `php artisan serve`
9. Run the command `npm run dev`

## Test Account

For testing the application, you can use the following account:

- Employee
    - Email: user@user.com
    - Password: password

- Manager
    - Email: manager@manager.com
    - Password: password

## Usage

1. Open a web browser and access the address `http://localhost:8000`
2. Login using the account that has been created
3. Click the "Request Overtime Letter" button and fill in the available form
4. Click the "Submit" button to request an overtime letter
5. Wait for approval from your superior or HRD
6. After approval, click the "Print" button to print the overtime letter

