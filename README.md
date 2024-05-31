## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- php artisan make:filament-resource Customer

- php artisan make:filament-relation-manager OrderResource address street_address

- php artisan make:filament-widget OrderStats --resource=OrderResource  

- php artisan make:filament-relation-manager UserResource orders id

- php artisan make:filament-widget LatestOrders --table

## Install Tailwind CSS
    npm install -D tailwindcss postcss autoprefixer
    npx tailwindcss init -p

    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
## Install Preline UI
    npm install preline 
        
        // tailwind.config.js
        module.exports = {
            content: [
                'node_modules/preline/dist/*.js',
            ],
            plugins: [
                require('preline/plugin'),
            ],
        }

    Add the Preline UI JavaScript
    Add the Preline UI JavaScript in your app entry point app.js

    // index.js
    import 'preline'Creat

## Install livewire

    composer require livewire/livewire
    
    - php artisan make:livewire successPage

## Deployment
    php artisan view:clear
    php artisan route:clear
    php artisan cache:clear

## MarkDwon Mailable

    php artisan make:mail OrderPlaced --markdown=mail.orders.placed  

## User Role Permission

    --At First update migration table. 
    --Then update model.
    --Then Create Policy.

    #Policy Create Command
    php artisan make:policy UserPolicy --model=User
    php artisan make:policy BrandPolicy --model=Brand
    php artisan make:policy CategoryPolicy --model=Category
    php artisan make:policy OrderPolicy --model=Order
    php artisan make:policy ProductPolicy --model=Product