<p align="center">
    <img 
    src="https://raw.githubusercontent.com/tristanvong/Cookingz/2a156fdf57c506183c6be77a254c8353ef003d3b/public/images/logo-white-stroke.png"
    alt="Cookingz Logo">
</p>

Cookingz is a community-driven project where users can discover new recipes and share their favorite recipes. This project aims to diversify people's taste buds!

## Features

- Discover a wide variety of recipes
- Share your own recipes with the community
- Usability was my number one priority
- Search functionality to find recipes quickly

## Installation

Follow these steps to set up Cookingz locally:

1. **Clone the repository:**

   ```bash
   git clone https://github.com/tristanvong/Cookingz.git
   ```
   
2. **cd into the project:**

    ```bash
    cd Cookingz
    ```
    
3. **Download all the packages:**

    ```bash
    composer install
    npm i
    ```
4. **Create .env file in root of project:**

    ```bash
    touch .env
    ```
    **Paste the following text in the .env file:**
    ```bash
    APP_NAME=Cookingz
    APP_ENV=local
    APP_KEY=
    APP_DEBUG=true
    APP_TIMEZONE=Europe/Brussels
    APP_URL=http://localhost

    APP_LOCALE=en
    APP_FALLBACK_LOCALE=en
    APP_FAKER_LOCALE=en_US

    APP_MAINTENANCE_DRIVER=file
    PHP_CLI_SERVER_WORKERS=4
    BCRYPT_ROUNDS= # I recommend 12

    LOG_CHANNEL=stack
    LOG_STACK=single
    LOG_DEPRECATIONS_CHANNEL=null
    LOG_LEVEL=debug

    DB_CONNECTION=
    DB_HOST=
    DB_PORT=
    DB_DATABASE=
    DB_USERNAME=
    DB_PASSWORD=

    SESSION_DRIVER=database
    SESSION_LIFETIME=120
    SESSION_ENCRYPT=false
    SESSION_PATH=/
    SESSION_DOMAIN=null

    BROADCAST_CONNECTION=log
    FILESYSTEM_DISK=local
    QUEUE_CONNECTION=database

    CACHE_STORE=database
    CACHE_PREFIX=

    MEMCACHED_HOST=127.0.0.1

    REDIS_CLIENT=phpredis
    REDIS_HOST=127.0.0.1
    REDIS_PASSWORD=null
    REDIS_PORT=6379

    MAIL_MAILER=
    MAIL_HOST=
    MAIL_PORT=
    MAIL_USERNAME=
    MAIL_PASSWORD=
    MAIL_FROM_ADDRESS=contact@cookingz.be
    MAIL_FROM_NAME="${APP_NAME}"
    MAIL_TO_ADDRESS= # your email address here

    VITE_APP_NAME="${APP_NAME}"
    ```
5. **Generate application key and run migrations:**

    ```bash
    php artisan key:generate
    php artisan migrate:fresh --seed
    ```
    
6. **Start the project with ./start.sh:**

    ```bash
    chmod +x start.sh #make start script executable
    ./start.sh
    ```

    If the script doesn't work please do (in separate terminals):
    ```bash
    php artisan serve
    npm run dev
    ```
   
## Information (ER-Diagram, Kanban Trello and source credits)
- [rentry.co/cookingz](https://rentry.co/cookingz)

### 1. ER-Diagram
![ER-Diagram - 1tool1]()

### 2. Kanban Trello
- [Trello](https://trello.com/b/zEEBwU9s/kanban-backend-web-cookingz)

### 3. Source Credits
- [Laravel Documentation page](https://laravel.com/docs/11.x/readme)

### 4. Additional Information
- placeholder