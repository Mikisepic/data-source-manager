# Data Source Manager

> Team MAG

## Step 1: Environment setup

## Creating a project like this from scratch
1. Create a project with composer `composer create-project laravel/laravel magicle`
2. Move to project directory `cd magicle/`
3. Install packages from composer.json file `composer install`
4. Add laravel breeze scaffolding to the project `composer require laravel/breeze`
5. Install laravel breeze `php artisan breeze:install vue`
6. Run database migrations and execute implemented seeders `php artisan migrate:fresh --seed`
7. Install node packages and start up server `npm install && npm run dev`

### Starting Frontend Locally
1. Navigate to Laravel project directory `cd src/`
2. Install composer dependecies `composer update`
3. Install node dependecies `npm install`
4. Create `.env` file, contents should be based on `.env.example`
5. Create hard links of assets in the storage/ folder `php artisan storage:link`
6. Update the key stored in the application's environment file `php artisan key:generate`
7. Serve Laravel app `php artisan serve`
8. Serve VueJS app `npm run dev`

### API development
1. Create a desired model and automatically make migrations of it `php artisan make:model ModelName -m`
2. Create a controller for the model `php artisan make:controller API/ModelNameController --resource --api --model=ModelName`
3. Create an API resource for data transformation `php artisan make:resource ModelNameResource`
4. Create a FormRequest class for validation `php artisan make:request ModelNameRequest`
5. Create factory file for generating data `php artisan make:factory ModelNameFactory`
6. Create a seeder for data generation `php artisan make:seeder API/ModelNameSeeder`, update the seeding sequence in `DatabaseSeeder.php` and then execute `php artisan migrate:fresh --seed`
7. Add a created API resource to `routes/api.php`
