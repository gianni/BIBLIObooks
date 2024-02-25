# BIBLIObooks

The "BIBLIObooks" is a distributed system consisting of two Laravel projects deployed in separate containers.
Each project represents an independent instance of a library, allowing users to query the catalog and reserve books for a specific period.
The communication between the two systems is facilitated through a RESTful API.

[![GitHub Actions](https://img.shields.io/badge/GitHub%20Actions-enabled-brightgreen)](https://github.com/features/actions)
[![PHP Test](https://github.com/gianni/https://github.com/gianni/BIBLIObooks/actions/workflows/php-test.yml/badge.svg)](https://github.com/gianni/https://github.com/gianni/BIBLIObooks/actions/workflows/php-test.yml)
[![PHPStan](https://github.com/gianni/https://github.com/gianni/BIBLIObooks/actions/workflows/phpstan.yml/badge.svg)](https://github.com/gianni/https://github.com/gianni/BIBLIObooks/actions/workflows/phpstan.yml)

## Technologies

- [![PHP](https://img.shields.io/badge/PHP-8.2-purple)](https://www.php.net/)
The 8.2 version of PHP, bringing new features and improvements.
- [![Apache2](https://img.shields.io/badge/Apache2-latest-yellow)](https://httpd.apache.org/)
The web server for serving your PHP application.
- [![Docker](https://img.shields.io/badge/Docker-latest-blue)](https://www.docker.com/)
A containerization platform for packaging, distributing, and running applications.
- [![!Laravel](https://img.shields.io/badge/Laravel-10-red)](https://laravel.com/)
The backend framework for building robust and scalable web applications.
- [![Pest PHP](https://img.shields.io/badge/Pest%20PHP-latest-blue)](https://pestphp.com/)
A delightful PHP Testing Framework with a focus on simplicity.
- [![Scramble](https://img.shields.io/badge/Scramble-latest-blue)](https://scramble.dedoc.co/)
OpenAPI (Swagger) documentation generator for Laravel.


## Features

- 🚀 **Reservation API RESTful**: To create a book reservation from a library (biblio Florence) to another library (biblio Milan) and viceversa.
- 📚 **Book API RESTful**: CRUD requests to create, remove, update and delete books from the library
- 🎤 **Requests API RESTful**: Exercise purpose only: a "valid" request that passes validation rule and create a new reservation and a "not valid" request that doesn't pass the validation rule and return the errors


## Getting Started

### Prerequisites

- [Docker](https://www.docker.com/get-started)
- [Docker-Compose](https://docs.docker.com/compose/)

### Installation

1. Clone the repository:

   ```bash
   git clone git@github.com:gianni/BIBLIObooks.git
   ```
2. Move to the directory:

   ```bash
   cd BIBLIObooks
   ```
3. Start Docker containers:

   ```bash
   docker-compose up -d
   ```

4. Point the browser to the first "Biblio" (Florence) API documentation
   
    ```bash
    http://localhost:8001/docs/api
    ```

5. Point the browser to the second "Biblio" (Milan) API documentation
   
    ```bash
    http://localhost:8002/docs/api
    ```