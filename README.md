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
    cd cookingz
    ```
    
3. **download all the packages:**

    ```bash
    composer install
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
    
    If the script still doesn't work please do (in separate terminals):
    ```bash
    php artisan serve
    npm run dev
    ```
   
## Information (ER-Diagram, Kanban Trello and source credits)
- [rentry.co/cookingz](https://rentry.co/cookingz)