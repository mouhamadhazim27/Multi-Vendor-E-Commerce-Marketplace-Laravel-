# HazimPlat Marketplace

A multi-vendor e-commerce marketplace built with Laravel, enabling independent vendors to manage their stores, products, and orders while allowing customers to browse products and place orders.

## Features

- **Vendor & Customer Management** – Supports separate roles for vendors and customers.
- **Product Management** – Manage products, categories, and product listings.
- **Shopping Cart & Checkout** – Add products to the cart and proceed through checkout.
- **Order Management** – Process and manage customer orders.
- **Product Search** – Search for products by name.
- **Multi-Vendor Database Design** – Database relationships support vendors, stores, products, and orders.

## Technologies Used

- **Backend:** PHP, Laravel
- **Database:** MySQL
- **Frontend:** Blade, Bootstrap, Tailwind CSS
- **JavaScript:** JavaScript, jQuery
- **Development Tools:** Composer, Node.js, npm

## Requirements

- PHP version compatible with the Laravel version used by this project
- Composer
- MySQL
- Node.js and npm, if required by the frontend assets

## Installation

### 1. Clone the repository

```bash
git clone https://github.com/mouhamadhazim27/Multi-Vendor-E-Commerce-Marketplace-Laravel-.git
```

### 2. Navigate to the project directory

```bash
cd Multi-Vendor-E-Commerce-Marketplace-Laravel-
```

### 3. Install PHP dependencies

```bash
composer install
```

### 4. Configure the environment

Copy `.env.example` to `.env`.

On Windows Command Prompt:

```cmd
copy .env.example .env
```

On Git Bash or Linux/macOS:

```bash
cp .env.example .env
```

### 5. Generate the application key

```bash
php artisan key:generate
```

### 6. Configure the database

Create a MySQL database and update the database settings in your `.env` file.

### 7. Run database migrations and seeders

```bash
php artisan migrate --seed
```

### 8. Install frontend dependencies (if required)

```bash
npm install
npm run build
```

### 9. Start the development server

```bash
php artisan serve
```

Open the local URL displayed in your terminal to access the application.

## Author

Developed by **Mouhamad Hazim** as a personal Laravel project.

## License

This project is available for educational and portfolio purposes. Contact the author for permission before redistributing it.
