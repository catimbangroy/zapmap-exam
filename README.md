
# ZapMap Exam


This is an application to get locations using latitude, longitude and radius. It is housed in Laravel and using MySQL as the database.


## Installation

Requirements:
Docker

Clone the repository

```bash
  git clone git@github.com:catimbangroy/zapmap-exam.git
```

Install the app with your OS based on this tutorial https://laravel.com/docs/10.x/installation#laravel-and-docker

Copy .env.example to .env

Run the migration and seeder inside the project folder.

```bash
  ./vendor/bin/sail artisan migrate
  ./vendor/bin/sail artisan db:seed --class=LocationSeeder
```
You can run tests using 

```bash
  ./vendor/bin/sail artisan test
```

Route is just simple /api/locations like so. Feel free to change the parameters.
Don't forget to add Content-Type and Accept as application/json

```bash
  http://127.0.0.1/api/locations?latitude=51.4720288546056&longitude=-1.80980069169524&radius=20
```
## Author

- [@roycatimbang](https://github.com/catimbangroy)
