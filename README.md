<h1 align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="224px"/><br/>
  Larasubs
</h1>
<p align="center">Larasubs is a simple subscription platform</p>

### ✨ Features

> Create Post

Request
```
POST http://127.0.0.1:8000/api/post
```

Request Body
```
{
  "title": "This title",
  "content": "This Content",
  "website_id": 1, // website_id here is data that already exists in the table
}
```
Response
```
{
  "status": "success",
  "data": {
    "id": 1,
    "title": "This Title",
    "content": "This Content",
    "website_id": 1
  }
}
```


> Create Subscription

Request
```
POST http://127.0.0.1:8000/api/subscriptions
```

Request Body
```
{
  "email": "name@example.com",
  "post_id": 5 // post_id here is data that already exists in the table
}
```
Response
```
{
  "status": "success",
  "data": {
    "id": 1,
    "email": "name@example.com",
    "post_id": 5
  }
}
```


### ⚙️ PHP 8.1
- Larasubs requires a PHP version of at least 8.1.

### ⚡️ Installation
1. Clone GitHub repo for this project locally
```bash
git clone https://github.com/dibaliqaja/larasubs.git
```
2. Change directory in project which already clone
```bash
cd larasubs
```
3. Install Composer dependencies
```bash
composer install
```
4. Create a copy of your .env file
```bash
cp .env.example .env
```
5. Generate an app encryption key
```bash
php artisan key:generate
```
6. Create an empty database for our application

8. In the .env file, add database information to allow Laravel to connect to the database
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE={database-name}
DB_USERNAME={username-database}
DB_PASSWORD={password-database}
```
9. Migrate the database
```bash
php artisan migrate
```
10. Seed the database
```bash
php artisan db:seed
```
11. Running project
```bash
php artisan serve
```

📝 Note:

If testing for email, can use mailtrap. For using, change env mail to
```bash
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME={mailtrap_username}
MAIL_PASSWORD={mailtrap_password}
```

And for queue, can use database. For using, change env queue connection to
```bash
QUEUE_CONNECTION=database
```

Running queue
```bash
php artisan queue:work
```

Running send post email
```bash
php artisan app:send-post-emails
```

## 📋 License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
