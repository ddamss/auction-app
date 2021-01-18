# auction-app
real time auction webapp

### Clone the base code
```bash
git clone  https://github.com/ddamss/auction-app.git
```

### Install npm and composer
```bash
composer install
npm install
```

### Name the app in the environement variable
`APP_NAME=Auctions-app`
 
### Generate APP_KEY and env variable is set automatically
`APP_KEY=***************`

```bash
php artisan key:generate
```
 
### Create database “auction-app” + set the environement variables + migrate all
* `DB_CONNECTION=mysql`
* `DB_HOST=127.0.0.1`
* `DB_PORT=3306`
* `DB_DATABASE=auction-app`
* `DB_USERNAME=********`
* `DB_PASSWORD=********`

```bash
php artisan migrate
```
 
### Generate basic scaffolding
```bash
composer require laravel/ui 3.0.0 // no need already installed from git clone
php artisan ui bootstrap
php artisan ui vue
``` 

### Generate login / registration scaffolding
```bash
php artisan ui bootstrap --auth
php artisan ui vue --auth
```
 
### Install laravel passport , no need already installed from git clone
```bash
composer require laravel/passport
php artisan migrate
```
 
### Get the credentials for laravel passport and set env variables
```bash
php artisan passport:install
```

* `PASSPORT_PERSONAL_ACCESS_CLIENT_ID=*`
* `PASSPORT_PERSONAL_ACCESS_CLIENT_SECRET=************`

### Create one public AWS bucket with one folder called “auction-images/” then set the en variables
```bash
composer require league/flysystem-aws-s3-v3 ~1.0
```

* `AWS_ACCESS_KEY_ID=***********`
* `AWS_SECRET_ACCESS_KEY==***********`
* `AWS_DEFAULT_REGION==***********`
* `AWS_BUCKET=auctions-app`

### Create the app on https://dashboard.pusher.com/# and set the env variables
* `BROADCAST_DRIVER=pusher`
* `PUSHER_APP_ID=******`
* `PUSHER_APP_KEY=***********`
* `PUSHER_APP_SECRET=*****`
* `PUSHER_APP_CLUSTER=****`

```bash
php artisan cache:clear
php artisan route:cache
php artisan config:cache
composer dump-autoload -o
```

### Use the below code for the compartiment strategy of the bucket to have it public :
```bash
{
    "Version": "2008-10-17",
    "Statement": [
        {
            "Sid": "AllowPublicRead",
            "Effect": "Allow",
            "Principal": {
                "AWS": "*"
            },
            "Action": "s3:GetObject",
            "Resource": "arn:aws:s3:::auctions-app/*"
        }
    ]
}
```
