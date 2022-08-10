# Contributing to this project

## Step 1: Environment setup

## Creating a project like this from scratch
1. Create a project with composer `composer create-project laravel/laravel magicle`
2. Move to project directory `cd magicle/`
3. Install packages from composer.json file `composer install`
4. Add laravel breeze scaffolding to the project `composer require laravel/breeze`
5. Install laravel breeze `php artisan breeze:install`
6. Run database migrations `php artisan migrate`
7. Install node packages `npm install`
8. Start up server `npm run dev`
9. Installing Vue3 `npm install vue@next vue-router@next vue-loader@next @vitejs/plugin-vue` 

### Starting Frontend Locally
1. Navigate to Laravel project directory `cd src/`
2. Install node dependencies `npm i`
3. Restore `vendor/` folder `composer update`
4. Create `.env` file, contents should be based on `.env.example`
5. Create hard links of assets in the storage/ folder `php artisan storage:link`
6. Update the key stored in the application's environment file `php artisan key:generate`
7. Serve laravel app `php artisan serve`

### Development tips
1. Developing with HMR enabled `npm run watch`
2. Ignoring generated changes on specific file `git update-index --assume-unchanged <file>`
3. Resetting command `git update-index --no-assume-unchanged <file>`