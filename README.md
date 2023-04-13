

## Stephs Subscription Service

Stephs Subscription Service is a Laravel-based web application that allows users to manage their MailerLite subscribers. Users can add, edit, and delete subscribers and view the subscriber list using DataTables.

## Features
- Add, edit, and delete MailerLite subscribers
- View the subscriber list using DataTables with server-side processing
- Validate and save MailerLite API keys in the database



## Short Installation

1. Clone the repository:
```
git clone https://github.com/yourusername/stephs-subscription-service.git
```
2. Change directory to the project folder:
```
cd stephs-subscription-service
```
3. Set your database connection details in the .env file:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mailerlite
DB_USERNAME=root
DB_PASSWORD=yourpassword

```
- ...
4. Start the development server:
```
php artisan serve
```
The application should now be accessible at http://localhost:8000.

## Usage
- Visit the application URL in your browser.

- Enter your MailerLite API key and submit. The application will validate the API key and save it in the database.

- Use the navigation menu to visit the subscribers page.

- Add, edit, and delete subscribers using the provided forms.

- View the subscriber list in a DataTable with server-side processing.

