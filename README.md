# Tool Management System

A simple Laravel application for managing tools, customers, suppliers, sales, and rentals.

## Local Development (No External Dependencies)

### Option 1: Using Docker Compose (Recommended)

1. **Clone the repository**
   ```bash
   git clone <your-repo-url>
   cd tool-management-system
   ```

2. **Run with Docker Compose**
   ```bash
   docker-compose up --build
   ```

3. **Access the application**
   - Open: http://localhost:8000
   - Default admin: admin@toolstore.com / password

### Option 2: Using Docker directly

1. **Build the image**
   ```bash
   docker build -t tool-management .
   ```

2. **Run the container**
   ```bash
   docker run -p 8000:80 tool-management
   ```

3. **Access the application**
   - Open: http://localhost:8000

### Option 3: Traditional Laravel setup

1. **Install dependencies**
   ```bash
   composer install
   npm install
   npm run build
   ```

2. **Set up environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. **Set up database**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

4. **Run the application**
   ```bash
   php artisan serve
   ```

## Features

- **Tool Management**: Add, edit, delete tools
- **Customer Management**: Manage customer information
- **Supplier Management**: Track suppliers
- **Sales Tracking**: Record and track sales
- **Rental Management**: Handle tool rentals
- **Reporting**: Generate various reports
- **User Authentication**: Secure login system

## Database

- Uses SQLite for local development (no external database needed)
- Automatically creates and seeds the database
- No credentials or API keys required

## Environment

- **APP_ENV**: local
- **APP_DEBUG**: true (for development)
- **DB_CONNECTION**: sqlite
- **SESSION_DRIVER**: file
- **CACHE_DRIVER**: file

## Default Login

- **Email**: admin@toolstore.com
- **Password**: password
