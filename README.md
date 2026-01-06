# Laravel MongoDB Boilerplate

A modern, production-ready Laravel 12 boilerplate with MongoDB integration and Docker containerization. This starter template provides a clean foundation for building scalable web applications that require NoSQL database capabilities.

## 🎯 Purpose

This boilerplate eliminates the repetitive setup work when starting a new Laravel project with MongoDB. Instead of manually configuring Docker, MongoDB drivers, and Laravel every time, you get a fully configured development environment ready to go in minutes.

## ✨ What's Included

- **Laravel 12** - Latest version of the Laravel framework
- **MongoDB Integration** - Fully configured MongoDB database with Laravel MongoDB package (v5.5)
- **Docker Environment** - Complete containerized setup with Docker Compose
  - PHP 8.2+ container
  - Nginx web server
  - MongoDB 7 database
- **Authentication Ready** - Laravel Sanctum pre-installed for API authentication
- **Development Tools**
  - Laravel Tinker for interactive debugging
  - Laravel Pint for code formatting
  - PHPUnit for testing
  - Vite for frontend asset bundling
- **MongoModel Base Class** - Custom base model for MongoDB collections

## 🚀 What It's Good For

This boilerplate is ideal for:

- **API Development** - Building REST APIs with MongoDB as the data store
- **Rapid Prototyping** - Quick setup for proof-of-concepts and MVPs
- **Document-Oriented Applications** - Apps that benefit from flexible schema design
- **Real-time Applications** - Projects requiring fast reads/writes and horizontal scaling
- **Microservices** - Service-based architectures leveraging MongoDB's flexibility
- **Content Management Systems** - Dynamic content with varying structures
- **Analytics Dashboards** - Applications handling large volumes of semi-structured data

## 📋 Prerequisites

- Docker and Docker Compose installed
- Git
- Basic knowledge of Laravel and Docker

## 🛠️ Installation

1. **Clone the repository**

   ```bash
   git clone git@github.com:d0c1989/LaravelMongoBoilerplate.git
   cd LaravelMongoBoilerplate
   ```

2. **Run the installation script**

   ```bash
   chmod +x bin/install.sh
   ./bin/install.sh
   ```

   Or manually:

   ```bash
   docker-compose up -d
   docker-compose exec app composer install
   cp src/.env.example src/.env
   docker-compose exec app php artisan key:generate
   ```

3. **Access the application**
   - Application: http://localhost
   - MongoDB: localhost:27017 (internal to Docker network)

## 📁 Project Structure

```
├── bin/                  # Helper scripts (artisan, composer, install)
├── docker/              # Docker configuration files
│   ├── nginx/          # Nginx configuration
│   └── php/            # PHP Dockerfile
├── src/                # Laravel application root
│   ├── app/
│   │   └── Models/
│   │       └── MongoModel.php  # Base MongoDB model
│   ├── config/         # Configuration files
│   ├── routes/         # Route definitions
│   └── ...
└── docker-compose.yml  # Docker services definition
```

## 🎮 Usage

### Running Artisan Commands

```bash
bin/artisan tinker
bin/artisan make:mongo-model Product
```

### Running Composer Commands

```bash
bin/composer require package/name
bin/composer update
```

### Creating MongoDB Models

```bash
bin/artisan make:mongo-model Product
```

### Working with MongoDB

```php
// Create
Product::create([
    'name' => 'Widget',
    'price' => 29.99,
    'tags' => ['electronics', 'gadgets']
]);

// Query
$products = Product::where('price', '>', 20)->get();

// Update
Product::where('name', 'Widget')->update(['price' => 24.99]);

// Delete
Product::where('name', 'Widget')->delete();
```

## 🔧 Configuration

### MongoDB Connection

MongoDB is pre-configured in `src/config/database.php`. The connection uses the MongoDB container defined in `docker-compose.yml`:

```php
'mongodb' => [
    'driver' => 'mongodb',
    'dsn' => env('DB_URI', 'mongodb://'),
    'database' => env('DB_DATABASE', 'laravel'),
],
```

### Environment Variables

Update `src/.env` to customize your setup:

```env
DB_CONNECTION=mongodb
DB_DATABASE=laravel
```

## 🧪 Testing

```bash
bin/artisan test
```

## 📦 Docker Services

- **app** - PHP 8.2 application container
- **nginx** - Nginx web server (port 80)
- **mongo** - MongoDB 7 database server

### Managing Containers

```bash
# Start services
docker-compose up -d

# Stop services
docker-compose down

# View logs
docker-compose logs -f app

# Rebuild containers
docker-compose up -d --build
```

## 🤝 Contributing

Feel free to submit issues and enhancement requests!

## 📄 License

This project is open-sourced software licensed under the MIT license.

## 🙏 Acknowledgments

- Built with [Laravel](https://laravel.com)
- MongoDB integration via [mongodb/laravel-mongodb](https://github.com/mongodb/laravel-mongodb)
- Inspired by the need for a quick-start MongoDB + Laravel setup

---

**Happy coding!** 🚀
