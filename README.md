# Task 2
This is my school project. I will build a fully working website. I will build an E-Commerce application.

## Features
- Admin Features
    - Create Products

## Routes
- Admin Routes
    - `/admin`: Admin Dashboard

## Running The Application
1. Setup database
```SQL
CREATE DATABASE `Shop`;

CREATE TABLE `Shop`.`products` (
    `id` int AUTO_INCREMENT,
    `name` varchar(50) NOT NULL,
    `price` float(7,2) NOT NULL,
    `quantity` int(5) NOT NULL,
    `size` enum('small', 'medium', 'large') NOT NULL,
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` datetime DEFAULT NULL, PRIMARY KEY (id)
);
```

```sh
php -S localhost:8000
```
