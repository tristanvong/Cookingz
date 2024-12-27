<p align="center">
    <img 
    src="https://raw.githubusercontent.com/tristanvong/Cookingz/4063e606c82e8a38fedf9471a8f44fbe6dc8fff1/public/images/logo.png" 
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
   git clone https://github.com/yourusername/cookingz.git
   ```
   
2. **cd into the project:**

    ```bash
    cd cookingz
    ```
    
3. **download all the packages:**

    ```bash
    composer install
    ```
    
    ```bash
    npm i
    ```
    
3. **Start the project with ./start.sh:**

    ```bash
    ./start.sh
    ```
    
    If this doesn't work, it likely means that the file needs to be executable:
    
    ```bash
    chmod +x start.sh
    ```
    
    If the script still doesn't work please do:
    ```bash
    php artisan serve && npm run dev
    ```
   
## Source Credits:
- [Kanban Trello](https://trello.com/b/zEEBwU9s/kanban-backend-web-cookingz)
