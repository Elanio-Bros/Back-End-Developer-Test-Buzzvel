# Back-End-Developer-Test-Buzzvel
## Resume
The idea of ​​this project is to use the Laravel framework to start a plan management project, using system integration tests and authentication via JWT.
The system already comes with a pre-registered user: 
> User: User_1
> Email:user_1@email.com.br
> Password: user_1%123

Below are two ways to run the application :

<details>
<summary>Without Docker</summary>

### Essential
Before activating the project, you must first configure the **.env** file. This file is extremely important for the project because it contains the main system settings. The [.env.example] file will serve as the basis for our system. The variables to be configured in this file are

### Requirements
 - [PHP 8.0](https://www.php.net/)
 - [Composer](https://getcomposer.org/)
 
<details>
<summary>Database settings in .env</summary>

### Settings
`DB_HOST`-> database host<br>
`DB_DATABASE`->The main database<br>
`DB_PORT`->Port used in the database system<br>
`DB_USERNAME`->database user<br>
`DB_PASSWORD`->database password<br>
</details>
<br>

After making the appropriate configurations in the **.env** file, run some terminal commands within the repository:

1. Install all project dependencies with composer
```bash
composer install
```
2. Generate application encryption key
```bash
php artisan key:generate
```
3. Generate JWT encryption and authentication key
```bash
php artisan jwt:secret
```
4. Create databases and initial segments
```bash
php artisan migrate --seed
```
5. Start a local server
```bash
php artisan serve
```

If you want to use it on an independent server, you must redirect to [/public/index.php](public/index.php) for the application to work correctly.

If you want, run the tests to analyze whether the routes in the application are in order:
```bash
php artisan test
```
</details>

<details>
<summary>With Docker</summary>

### Essential
 - [Docker](https://www.docker.com/) 
 - [Docker-Compose](https://docs.docker.com/compose/)

To start, run the commands:

1. Run to build the image and initialize the containers:
```bash
docker-compose -f "docker-compose.yml" up -d --build
```

2. Run this command for a quick application setup:

``` bash
docker exec -it aplication bash -c "cp .env.example .env; php artisan key:generate; php artisan jwt:secret; php artisan migrate --seed"
```
Or run these below to:

3. Create a copy of the **.env** file:
```bash
docker exec -it aplication cp .env.example .env
```
4. Generate the application encryption key:
```bash
docker exec -it aplication php artisan key:generate
```
5. Generate JWT encryption and authentication key:
```bash
docker exec -it aplication php artisan jwt:secret
```
6. Create databases and initial segments
```bash
docker exec -it aplication php artisan migrate --seed
```

Your system will now be configured to run natively on your docker at [localhost](http://localhost/).

If you want, run the tests to analyze whether the routes in the application are in order:
```bash
docker exec -it aplication php artisan test
```
</details>


<br>

### Endpoints
The application has several access routes for using the system, all authenticated routes use the JWT system described in the documentation in the ``/`` system route.

