
# Larablog

Blog created with **Laravel** on a **MySQL** database.

## Installation

Clone the repository with `git clone https://github.com/joanpuigra/larablog.git`.

Run `npm install`to install all dependencies.

Install **HERD** or **Laragon** to create a local server.

Add the connection to MySQL on the `.env` file.

## Configuration

### Default connection

```php
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3308
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

Even as a **Laravel project**, it works with *Vite* and *npm*, run it as development with `npm run dev`.

## Connection

Connect with your browser on: [http://larablog.test/](http://larablog.test/)

If you try to **run** with `php artisan serve` or access by `localhost` it won't work.
