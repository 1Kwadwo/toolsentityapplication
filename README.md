# Tool Management System

A comprehensive Laravel-based tool retail and inventory management system with sales, rentals, customer management, and reporting capabilities.

## Features

### 🔐 Authentication & User Management

-   **Role-based access control**: Admin, Manager, and Cashier roles
-   **Secure authentication** using Laravel Breeze
-   **User profile management**

### 📊 Dashboard

-   **Real-time statistics**: Total tools, low stock alerts, today's sales, overdue rentals
-   **Quick alerts**: Low stock warnings and overdue rental notifications
-   **Recent activity**: Latest sales and top-selling tools
-   **Visual indicators**: Color-coded status and stock levels

### 🛠️ Inventory Management

-   **Complete CRUD operations** for tools
-   **Stock tracking** with minimum stock level alerts
-   **Barcode/SKU support** for easy identification
-   **Condition tracking**: New, Good, Fair, Poor
-   **Supplier management** with contact information
-   **Category organization** for better inventory structure

### 💰 Sales & POS System

-   **Point-of-sale functionality** for selling tools
-   **Multiple payment methods**: Cash, Card, Mobile Money
-   **Automatic stock deduction** when items are sold
-   **Receipt generation** with unique receipt numbers
-   **Discount application** and final amount calculation
-   **Loyalty points system** for customers

### 📅 Rental Management

-   **Tool rental system** with date tracking
-   **Automatic late fee calculation** (10% of rental fee per day)
-   **Rental status tracking**: Active, Returned, Overdue
-   **Due date management** with overdue notifications
-   **Return processing** with fee calculation

### 👥 Customer Management

-   **Customer database** with contact information
-   **Purchase history** tracking
-   **Rental history** tracking
-   **Loyalty points** accumulation and tracking
-   **Customer activity** monitoring

### 🏢 Supplier Management

-   **Supplier database** with contact details
-   **Supplier-tool relationships**
-   **Active/inactive supplier status**
-   **Contact person information**

### 📈 Reports & Analytics

-   **Sales reports** with date range filtering
-   **Rental reports** with revenue analysis
-   **Inventory status** reports
-   **Customer analytics** and top customers
-   **Top-selling tools** analysis
-   **Monthly revenue** trends

## Technology Stack

-   **Backend**: Laravel 12.x
-   **Frontend**: Blade templates with TailwindCSS
-   **Database**: PostgreSQL (for production), SQLite (for development)
-   **Authentication**: Laravel Breeze
-   **Styling**: TailwindCSS
-   **Icons**: Heroicons (SVG)

## Installation

### Prerequisites

-   PHP 8.2 or higher
-   Composer
-   Node.js and npm
-   PostgreSQL (for production) or SQLite (for development)

### Local Development Setup

1. **Clone the repository**

    ```bash
    git clone <repository-url>
    cd tool-management-system
    ```

2. **Install PHP dependencies**

    ```bash
    composer install
    ```

3. **Install Node.js dependencies**

    ```bash
    npm install
    ```

4. **Environment setup**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

5. **Database configuration**

    - For SQLite (development):
        ```bash
        touch database/database.sqlite
        ```
    - Update `.env` file with database settings

6. **Run migrations and seeders**

    ```bash
    php artisan migrate
    php artisan db:seed
    ```

7. **Build assets**

    ```bash
    npm run build
    ```

8. **Start the development server**
    ```bash
    php artisan serve
    ```

### Default Login Credentials

The system comes with pre-seeded users:

-   **Admin**: admin@toolstore.com / password
-   **Manager**: manager@toolstore.com / password
-   **Cashier**: cashier@toolstore.com / password

## Deployment on Render

### 1. Database Setup

-   Create a new **PostgreSQL** database on Render
-   Note the database credentials

### 2. Web Service Setup

-   Create a new **Web Service** on Render
-   Connect your GitHub repository
-   Set the following environment variables:

```env
APP_NAME="Tool Management System"
APP_ENV=production
APP_KEY=base64:your-generated-key
APP_DEBUG=false
APP_URL=https://your-app-name.onrender.com

DB_CONNECTION=pgsql
DB_HOST=your-postgres-host
DB_PORT=5432
DB_DATABASE=your-database-name
DB_USERNAME=your-username
DB_PASSWORD=your-password

CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
```

### 3. Build Commands

Set the following build commands in Render:

```bash
composer install --no-dev --optimize-autoloader
npm install
npm run build
php artisan migrate --force
php artisan db:seed --force
```

### 4. Start Command

```bash
php artisan serve --host 0.0.0.0 --port $PORT
```

## Project Structure

```
tool-management-system/
├── app/
│   ├── Http/Controllers/
│   │   ├── DashboardController.php
│   │   ├── ToolController.php
│   │   ├── SupplierController.php
│   │   ├── CustomerController.php
│   │   ├── SaleController.php
│   │   ├── RentalController.php
│   │   └── ReportController.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── Tool.php
│   │   ├── Supplier.php
│   │   ├── Customer.php
│   │   ├── Sale.php
│   │   └── Rental.php
│   └── ...
├── database/
│   ├── migrations/
│   ├── seeders/
│   └── ...
├── resources/
│   └── views/
│       ├── dashboard.blade.php
│       ├── tools/
│       ├── suppliers/
│       ├── customers/
│       ├── sales/
│       ├── rentals/
│       └── reports/
└── routes/
    └── web.php
```

## Key Features Implementation

### Stock Management

-   Automatic stock deduction on sales
-   Stock restoration on sale deletion
-   Low stock alerts with configurable thresholds
-   Available stock calculation for rentals

### Rental System

-   Date-based rental tracking
-   Automatic late fee calculation
-   Rental status management
-   Return processing with fee updates

### Sales System

-   Receipt generation with unique numbers
-   Multiple payment method support
-   Loyalty points integration
-   Discount application

### Reporting

-   Date-range filtered reports
-   Revenue analysis
-   Customer analytics
-   Inventory status reports

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests if applicable
5. Submit a pull request

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Support

For support and questions, please contact the development team or create an issue in the repository.
