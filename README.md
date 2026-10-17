# HazimPlat Marketplace

A multi-vendor e-commerce marketplace built with Laravel that allows independent vendors to manage their products and orders.

## Features

- Vendor and customer management
- Product and category management
- Shopping cart and checkout
- Order processing and management
- Product search
- Database relationships for multi-vendor operations

## Technologies Used

- Laravel
- PHP
- MySQL
- Blade
- Bootstrap & Tailwindcss
- JavaScript and jQuery

## Requirements

- PHP (compatible with your Laravel version)
- Composer
- MySQL
- Node.js and npm, if required by the project's frontend assets

## Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/mouhamadhazim27/Multi-Vendor-E-Commerce-Marketplace-Laravel-
   ```

2. Enter the project directory:

   ```bash
   cd Multi-Vendor-E-Commerce-Marketplace-Laravel-
   ```

3. Install dependencies:

   ```bash
   composer install
   ```

4. Create the environment file:

   ```bash
   cp .env.example .env
   ```

   On Windows, you can also copy `.env.example` to `.env` manually.

5. Generate the application key:

   ```bash
   php artisan key:generate
   ```

6. Configure your database credentials in `.env`.

7. Run migrations:

   ```bash
   php artisan migrate --seed
   ```

8. Start the development server:

   ```bash
   php artisan serve
   ```

## Author

Developed as a personal Laravel project.