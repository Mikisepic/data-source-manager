# Data Source Manager

> Team MAG

## Starting Frontend Locally
1. Navigate to Laravel project directory `cd src/`
2. Install node dependencies `npm i`
3. Restore `vendor/` folder `composer update`
4. Create `.env` file, contents should be based on `.env.example`
5. Update the key stored in the application's environment file `php artisan key:generate`
6. Serve laravel app `php artisan serve`

## Development tips
1. Developing with HMR enabled `npm run watch`
2. Ignoring generated changes on specific file `git update-index --assume-unchanged <file>`
3. Resetting command `git update-index --no-assume-unchanged <file>`
