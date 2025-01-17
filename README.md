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
    Make storage folder accessible (images will not show on the website if not done):
    ```bash
    php artisan storage:link
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

### 1. ER-Diagram
![ER-Diagram - Cookingz](https://i.imgur.com/wHLZE0g.png)

### 2. Kanban Trello
- [Trello](https://trello.com/b/zEEBwU9s/kanban-backend-web-cookingz)

### 3. Source Credits
- [Laravel Documentation page](https://laravel.com/docs/11.x/readme)

### 4. Additional Information
- I populate my placeholders for user placeholder profile picture and admin profile picture using imgur in the case of the images not being available please upload your own placeholder images with the name "placeholder.png" and "placeholderAdmin.png" in profile_pictures folder. The same goes for "placeholder.png" from news_images and recipe_images folder. Normally these images are taken from imgur in the seeder and put in the storage folder.

- Icons (SVGs)
    - Star Full Filled  
      	[Link to Star Icon](https://fontawesome.com/icons/star?f=classic&s=solid)  
	- Star Half Filled
		[Link to half filled star](https://fontawesome.com/v6/icons/star-half-stroke?f=classic&s=solid)
	- Star Hollow
		[Link to Star Hollow Icon](https://fontawesome.com/icons/star?f=classic&s=regular)
	- Cookie Icon
		[Link to Cookie Icon](https://commons.wikimedia.org/wiki/File:Oxygen480-apps-preferences-web-browser-cookies.svg)
	- LinkedIn Icon
		[Link to LinkedIn Icon](https://fontawesome.com/icons/linkedin?f=brands&s=solid)
	- Mail Icon
		[Link to Mail Icon](https://fontawesome.com/icons/envelope?f=classic&s=solid)
	- Admin Icon
		[Link to Admin Icon](https://fontawesome.com/v6/icons/user-secret?f=classic&s=solid)
	- Notification Icon
		[Link to Notification Icon](https://fontawesome.com/v6/icons/circle-exclamation?f=classic&s=solid)
	- Pencil Icon
		[Link to Pencil Icon](https://fontawesome.com/v6/icons/pencil?f=classic&s=solid)
	- Trash Icon
		[Link to Trash Icon](https://fontawesome.com/v6/icons/trash-can?f=classic&s=solid)
	- User Icon
		[Link to User Icon](https://fontawesome.com/v6/icons/user?f=classic&s=solid)
	- Eye Icon
		[Link to Eye Icon](https://fontawesome.com/v6/icons/eye?f=classic&s=solid)
	- Eye Slash Icon
		[Link to Eye Slash Icon](https://fontawesome.com/v6/icons/eye-slash?f=classic&s=solid)

- Logo was made by me using [paint.net](https://www.getpaint.net/), the cookie icon I used was the same as the SVG above, I converted it to PNG. The font used is [Brown Cake](https://www.dafont.com/brown-cake-2.font).
- Background
    The background I use comes from [uiverse.io](https://uiverse.io/kennyotsu/short-warthog-33), it is protected under the MIT-license acording to their website (scroll to the bottom of the homepage at the left).
- Technologies: Laravel, TailwindCSS, MySQL
