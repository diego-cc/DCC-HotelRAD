# DCC-HotelRAD
A hotel management application developed for an assignment at North Metropolitan TAFE, built with [Laravel](https://laravel.com/ "Laravel"). It uses MariaDB as database.

## Features
It includes all BREAD (Browse, Read, Edit, Add, Delete) actions and views for:

- Room rates
- Feedback subjects
- Room statuses

## Setup instructions

### 1. Clone the repository

`git clone https://github.com/diego-cc/DCC-HotelRAD.git`

### 2. Move to the project's directory

`cd DCC-HotelRAD`

### 3. Create the database

Move to the `resources/sql` directory and run the [SQL code](https://github.com/diego-cc/DCC-HotelRAD/blob/master/resources/sql/hotel-rad-db.sql "hotel-rad-db.sql") to create the database and user:

`mysql -u root -p < hotel-rad-db.sql`

### 4. Seed database

Run all migrations and seeds:

`php artisan migrate:fresh --seed`

### 5. Run the application

Move the project to your `www` directory (server root), start your PHP server of choice and navigate to any of these URLs (specifying the port that your server is running on):

```
http://localhost/dcc-hotelrad/public/rates
http://localhost/dcc-hotelrad/public/feedback_subjects
http://localhost/dcc-hotelrad/public/room_statuses
```

If you're using Laragon, the URLs below are also valid:

```
http://dcc-hotelrad.test/rates
http://dcc-hotelrad.test/feedback_subjects
http://dcc-hotelrad.test/room_statuses
```
