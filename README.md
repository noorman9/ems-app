# Equipment Maintenance System (EMS)

A web-based Equipment Maintenance System built with Laravel to manage equipment, maintenance activities, spare parts inventory, stock movements, and maintenance reports.

## Features

- **Authentication** — Login and logout.
- **Role-Based Access** — Access control based on user roles.
- **Equipment Management** — Create, view, update, and manage equipment records.
- **Maintenance Management** — Schedule maintenance and track its progress from scheduled to in progress and completed.
- **Spare Parts Management** — Manage spare parts information and inventory.
- **Stock Movements** — Record incoming and outgoing stock transactions.
- **Maintenance Parts Usage** — Record spare parts used during maintenance and update inventory accordingly.
- **Maintenance Reports** — Review maintenance records and their status.

## Technology Stack

- PHP 8.5
- Laravel 13
- MySQL / MariaDB
- Blade Templates
- HTML and CSS

## Requirements

Before running the application, make sure the following software is installed:

- PHP with the required Laravel extensions
- Composer
- MySQL or MariaDB
- Node.js and npm, if frontend assets need to be installed or built

## Installation

1. Clone or copy this repository to your local machine.

2. Open a terminal in the project directory:

   ```bash
   cd ems
   ```

3. Install PHP dependencies:

   ```bash
   composer install
   ```

4. Create the environment configuration file:

   ```bash
   cp .env.example .env
   ```

   On Windows, you can also copy `.env.example` to `.env` using File Explorer.

5. Generate the application key:

   ```bash
   php artisan key:generate
   ```

6. Create a database named `ems` in MySQL or MariaDB.

7. Configure the database connection in `.env`:

   ```dotenv
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=ems
   DB_USERNAME=your_database_username
   DB_PASSWORD=your_database_password
   ```

   Replace the username and password with your local database credentials.

8. Run the database migrations:

   ```bash
   php artisan migrate
   ```

9. If the project requires frontend dependencies, install and build them:

   ```bash
   npm install
   npm run build
   ```

10. Start the development server:

    ```bash
    php artisan serve
    ```

11. Open the local application at:

    `http://127.0.0.1:8000`

## Database Setup Notes

- Database migrations create the tables required by the application.
- User accounts and roles must be configured according to the project's available seeders and authentication setup.
- Do not run seeders in an existing database without checking their behavior first.

## Maintenance Workflow

1. Create or select an equipment record.
2. Schedule a maintenance activity.
3. Start the maintenance activity.
4. Record spare parts used, when applicable.
5. Complete the maintenance activity.
6. Review the maintenance records and reports.

## Inventory Workflow

- Incoming stock increases the spare part quantity.
- Outgoing stock decreases the spare part quantity.
- Stock transactions are recorded in stock movement history.
- The system validates stock availability before recording outgoing transactions.

## Development

Useful Laravel commands:

```bash
php artisan route:list
php artisan migrate:status
php artisan test
```

Run automated tests with `php artisan test` if the project has tests configured.

## Project Status

This project was developed as an Equipment Maintenance System application, with its main workflows manually tested during development.

## License

This project is provided for its intended development, demonstration, or assessment purposes. Add the applicable license information if the project is distributed publicly.
