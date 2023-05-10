# Learning Management System

## Table of Contents

- [Prerequisites](#Prerequisites)
- [Installation](#Installation)

## Prerequisites
1. PHP >= 8.1
2. Composer
3. Apache
4. MySQL
5. Other php extensions :- OpenSSL, PDO, Mbstring, Tokenizer, XML, Ctype, JSON, and BCMath
6. Laravel

## Installation

1. Copy .env.example file and rename it to .env
2. Set .env file (App_KEY, APP_URL, DB_DATABASE, DB_USERNAME, DB_PASSWORD)
3. Run command - ```composer install```
    - ```composer update```
4. give storage folder permission 
    - For Ubuntu :- ``` sudo chmod -R 777 storage/ ```
5. serve project :- ``` php artisan serve ```
