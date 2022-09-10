# Contributing

When contributing to this repository, please first discuss by email or any other method with the owner of this repository before making a change.

## Prerequisite

### Skill set

- JavaScript
- NodeJS
- Vue3
- PHP
- Laravel
- Tailwind CSS
- PostgreSQL

### Knowledge

- You should have a great understanding of Vue, Laravel, and their internals.
- You should be familiar with and follow best practises of writing single page applications.
- You should be familiar with and follow Vue style guide.

## Setting up the Environment

Before starting, make sure you have installed and configured the following tools:
- node 18.X
- npm 8.X
- php 8.X
- composer 2.X
- psql 14.X

### Installation

1. Navigate to Laravel project directory `cd src/`
2. Install composer dependecies `composer update`
3. Install node dependecies `npm install`

### Starting the Application Locally

1. Create `.env` file, contents should be based on `.env.example`
2. Create hard links of assets in the storage/ folder `php artisan storage:link`
3. Update the key stored in the application's environment file `php artisan key:generate`
4. Run database migrations and execute implemented seeders `php artisan migrate:fresh --seed`
5. Serve Laravel app `php artisan serve`
6. On the other terminal, serve Vue app `npm run dev`
7. Open the [application](http://localhost:8000)

## Pull Request Process

### **Disclaimer**

Your PR will not be reviewed if your code does not pass automatic lint checks and if any of the tests fail.

1. Before raising a PR, please ensure that you are following default branching model.
2. The proposed change must be covered with unit and/or e2e tests, code must be formatted according to the project configuration.
3. You may merge the PR once you have the sign-off of more than half of the developers in the team, or if you do not have a permission to perform such action, you also may request the other reviewer to merge it for you.

Your contributions and suggestions for improvements are always welcome.
