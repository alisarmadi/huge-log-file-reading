# huge log file reading
This is a simple project to demonstrate reading a huge log file line by line and inserting them into a mongodb database, and also has an endpoint to return the number of rows that match the filter criteria.

## Installation
For install this project do these steps:
- Clone the project to your directory.
- Copy .env.example to .env in the root directory (by default you don't need to change the contents of the file).
- Copy .env.example to .env in the /src directory (by default you don't need to change the contents of the file).

- Go to the root directory and run this commands:
```shell
$ docker-compose build
$ docker-compose up -d
$ docker exec -it php composer install --ignore-platform-reqs
$ docker exec -it php artisan migrate
```

## Test
We implemented a happy unit test and a happy feature test in this project, of course we can add other tests to increase our test coverage on the project.
- Run this command to execute the tests:
```shell
$ docker exec -it php php vendor/bin/phpunit
```

## Insert log file to the database
Run this command to import the sample log file called logs.txt located in the storage directory into the database (you can replace this file with your real huge log file).
```shell
$ docker exec -it php php artisan parse:log_file
```
This command reads the log file line by line (instead of loading the entire file, which requires a lot of memory) and adds these lines to the database in batches of thousands to increase efficiency.

## Fetch the number of rows
Call following endpoint (maybe with postman) to return the number of rows that match the filter criteria (All query parameters are optional):
```
http://localhost:8080/api/logs/count?serviceNames[]=invoice-service&serviceNames[]=order-service&statusCode=201&startDate=1641028677&endDate=1672564677
```
To increase data fetching performance, we added some indexes on 'huge_file' collection in the database.
