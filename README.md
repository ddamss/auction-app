# auction-app
real time auction webapp


git clone  https://github.com/ddamss/auction-app.git
composer install
npm install
 
//Name the app in the env variable
APP_NAME=Auctions-app
 
//Generate APP_KEY and env variable is set automatically
APP_KEY=***************
php artisan key:generate
 
//create database “auction-app” + set the env variables + migrate all
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=auction-app
DB_USERNAME=********
DB_PASSWORD=********
php artisan migrate
 
// Generate basic scaffolding...
composer require laravel/ui 3.0.0 // no need already installed from git clone
php artisan ui bootstrap
php artisan ui vue
 
// Generate login / registration scaffolding...
php artisan ui bootstrap --auth
php artisan ui vue --auth
 
// install laravel passport , no need already installed from git clone
composer require laravel/passport
php artisan migrate
 
//Get the credentials for laravel passport and set env variables
php artisan passport:install
PASSPORT_PERSONAL_ACCESS_CLIENT_ID=*
PASSPORT_PERSONAL_ACCESS_CLIENT_SECRET=************
 
// create one public AWS bucket with one folder called “auction-images/” then set the en variables
composer require league/flysystem-aws-s3-v3 ~1.0
AWS_ACCESS_KEY_ID=***********
AWS_SECRET_ACCESS_KEY==***********
AWS_DEFAULT_REGION==***********
AWS_BUCKET=auctions-app
 
//Create the app on https://dashboard.pusher.com/# and set the env variables
BROADCAST_DRIVER=pusher
PUSHER_APP_ID=******
PUSHER_APP_KEY=***********
PUSHER_APP_SECRET=*****
PUSHER_APP_CLUSTER=****
 
php artisan cache:clear
php artisan route:cache // errors when it’s launched
php artisan config:cache
composer dump-autoload -o
