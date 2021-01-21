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

### Generate APP_KEY and environement variable is set automatically

```bash
php artisan key:generate
```

`APP_KEY=***************`

### Create database “auction-app” + set the environement variables + migrate all

-   `DB_CONNECTION=mysql`
-   `DB_HOST=127.0.0.1`
-   `DB_PORT=3306`
-   `DB_DATABASE=auction-app`
-   `DB_USERNAME=********`
-   `DB_PASSWORD=********`

```bash
php artisan migrate
```

### Generate basic scaffolding

```bash
php artisan ui bootstrap
php artisan ui vue
```

### Generate authentication scaffolding

```bash
php artisan ui bootstrap --auth
php artisan ui vue --auth
```

### Get the credentials for laravel passport and set environement variables

```bash
php artisan passport:install
```

-   `PASSPORT_PERSONAL_ACCESS_CLIENT_ID=*`
-   `PASSPORT_PERSONAL_ACCESS_CLIENT_SECRET=************`

### Install Amazon S3 driver package

```bash
composer require league/flysystem-aws-s3-v3 ~1.0
```

### Create one public AWS bucket with one folder called “auction-images/” then set the environement variables

-   `AWS_ACCESS_KEY_ID=***********`
-   `AWS_SECRET_ACCESS_KEY==***********`
-   `AWS_DEFAULT_REGION==***********`
-   `AWS_BUCKET=auctions-app`

### On S3, use the below code for the compartiment strategy of the bucket to have it public :

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

### Pusher configuration

Create the app on https://dashboard.pusher.com/# and set the environement variables below :

-   `BROADCAST_DRIVER=pusher`
-   `PUSHER_APP_ID=******`
-   `PUSHER_APP_KEY=***********`
-   `PUSHER_APP_SECRET=*****`
-   `PUSHER_APP_CLUSTER=****`

### Run below commands before launching the app

```bash
php artisan cache:clear
php artisan route:cache
php artisan config:cache
composer dump-autoload -o
```
