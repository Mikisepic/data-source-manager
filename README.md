# Data Source Manager

> Team MAG **Without AG**

## About the Project
* The goal is to create a collaborative environment for smart resource management with sources and tracking of data used.

## Starting Project Locally
1. Navigate to Laravel project directory `cd src/`
2. Install composer dependecies `composer update`
3. Install node dependecies `npm install`
4. Create `.env` file, contents should be based on `.env.example`
5. Create hard links of assets in the storage/ folder `php artisan storage:link`
6. Update the key stored in the application's environment file `php artisan key:generate`
7. Serve Laravel app `php artisan serve`
8. Serve VueJS app `npm run dev`
