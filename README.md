# ![Bevatel Ticket System App](bevatel.png)

> ### Example Laravel codebase containing real world examples (CRUD, Mail Tracking, APIs, Advanced Patterns and more) Usin Gmail and IMAP that adheres to the [RealWorld](https://github.com/gothinkster/realworld-example-apps) spec.

This repo is functionality complete — For Bevatel Task.

----------

# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/5.4/installation#installation)

Clone the repository

    git clone https://github.com/Fadi-ibrahem/bevatel-tickets-using-gmail.git

Switch to the repo folder

    cd bevatel-tickets-using-gmail

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

**TL;DR command list**

    git clone https://github.com/Fadi-ibrahem/bevatel-tickets-using-gmail.git
    cd bevatel-tickets-using-gmail
    composer install
    cp .env.example .env
    php artisan key:generate
    
**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate
    php artisan serve

## Database seeding

**Populate the database with seed data with relationships which includes tickets, replies. This can help you to quickly start testing the app or couple a frontend and start using it with ready content.**

Run the database seeder and you're done

    php artisan db:seed

***Note*** : It's recommended to have a clean database before seeding. You can refresh your migrations at any point to clean the database by running the following command

    php artisan migrate:refresh
    
## Docker

To install with [Docker](https://www.docker.com), run following commands:

```
git clone https://github.com/Fadi-ibrahem/bevatel-tickets-using-gmail.git
cd bevatel-tickets-using-gmail
cp .env.example.docker .env
docker run -v $(pwd):/app composer install
cd ./docker
docker-compose up -d
docker-compose exec php php artisan key:generate
docker-compose exec php php artisan migrate
docker-compose exec php php artisan db:seed
docker-compose exec php php artisan serve --host=0.0.0.0
```

## API Specification

This application adheres to the api specifications set by the [PHP-IMAP](https://www.php-imap.com/) team. This helps to fetch and retrieve messages from any Mail messages inbox which use an IMAP Service.

> [Full API Spec](https://mailtrap.docs.apiary.io/#)

----------

# Code overview

## Dependencies

- [Webklex/laravel-imap](https://github.com/Webklex/laravel-imap) - To Use Google IMAP Service Easly

## Folders

- `app` - Contains the core code of the application
- `app/Console/Commands` - Contains all commands which used to perform the task scheduling using cron job
- `app/Event` - Contains all events
- `app/Http/Controllers/Front` - Contains all the front controllers
- `app/Http/Controllers/Requests` - Contains all the front form requests
- `app/Http/Interfaces` - Contains all app interfaces
- `app/Http/Jobs` - Contains all app background jobs
- `app/Http/Listeners` - Contains all app event listeners
- `app/Http/Models` - Contains all database models
- `app/Http/Repositories` - Contains all application repositories classes
- `app/Http/Services` - Contains all services
- `config` - Contains all the application configuration files
- `database/factories` - Contains the model factory for all the models
- `database/migrations` - Contains all the database migrations
- `database/seeds` - Contains the database seeder

# Environment variables

- `.env` - Environment variables can be set in this file

***Note*** : You can quickly set the database information and other variables in this file and have the application fully working.

## New Constants

- `IMAP_HOST` - The IMAP host such as 'imap.gmail.com'
- `IMAP_PORT` - The IMAP port is 993
- `IMAP_ENCRYPTION` - The encryption is preferable to 'ssl'
- `IMAP_VALIDATE_CERT` - The validation certificate set to 'true'
- `IMAP_USERNAME` - The full email address such as 'name@gmail.com'
- `IMAP_PASSWORD` - The password
- `IMAP_DEFAULT_ACCOUNT` - set it as 'default'
- `IMAP_PROTOCOL` - The IMAP protocol must be 'imap'


----------

# Authentication
 
This applications uses Internet Message Access Protocoln (IMAP) to handle authentication. is a standard email retrieval (incoming) protocol. It stores email messages on a mail server and enables the recipient to view and manipulate them as though they were stored locally on their device(s).

----------
 
# Technicalities
 
This applications provides a ticket management system and mail tracking with a CRUD operations for tickets and replies in which every ticket has many replies, and there is a cabability to perform a cron job to submit a new ticket with a new fetched random message from an email inbox every one hour. system respectively send an acknowledge email message to the ticket email when ticket created, and sending a reply message within an email once new reply created on the ticket from the system.

This reached by performing:
 
- `Models` Represinting database talbes
- `Views` for displaying the html and the front-end on the browser
- `Controllers` to process the data and communicate between models and views
- `Repository` Design Pattern to separate between data source layer and business logic layer
- `Task Scheduling` to perform process every interval of time
- `events` to uppon do some actions
- `listeners` to listen to events and perform methods
- `jobs` to execute something in the background
- `Mails` to send emails
- `Services` to avoid huge code from controllers
- `factoreis` to generate data in database
- `seeders` to seed dummy data
