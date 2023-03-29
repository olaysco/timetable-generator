## About

This project is a web application that allows a user to enter data required for
generating timetables for a college and then uses that data for generating timetables
on demand.

The web application is developed using Laravel PHP framework and Jquery.

The timetable generation is done using a genetic algorithm that runs as a Laravel
job in the background when timetables are requested.

The way forward for this project is de-coupling the genetic algorithm into a re-usable
library that can easily be plugged into other applications. The UX can also be improved
further.

## Installation Steps

The application requires PHP 7.0 - PHP 7.4, PHP 8.0 is not currently supported.

clone the repository

```
git clone git@github.com:olaysco/timetable-generator.git
```

switch to the directory

```
cd timetable-generator
```

Install dependencies

```
composer install
```

create env file

```
cp .env.example .env
```

generate application key

```
php artisan key:generate
```

Create a local DB and update the .env file with the DB credentials

migrate the database

```
php artisan migrate
```

run the application seeder

```
php artisan db:seed
```

Navigate to the application URL, if asked for a password: the default password is `admin`
