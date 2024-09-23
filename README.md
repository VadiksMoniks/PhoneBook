This project was made on php version 8.0.7, laravel 9.5.2, vue js, tailwind css and realise package with phone book.
To install into your project follow the next steps:
1) IF you dont have a project yet create it via command composer create-project laravel/laravel your_project_name
2) change in .env file DB_NAME: laravel to DB_NAME: phone-book
3) add to your composer.json file in require section this line: `vadiksmoniks/phonebook: "dev-main"`
4) add in the end of file this code:
```bash
"repositories": [
  {
    "type": "vcs",
    "url": "https://github.com/VadiksMoniks/PhoneBook"
  }
]
```

6) In terminal run command composer update
7) Copy files "People" and "PhoneNumbers" from /vendor/vadiksmoniks/phonebook/database/seeers to your folder database/seeders in root of project
8) run command php artisan migrate
9) run commands php artisan db:seed --class=People  and php artisan db:seed --class=PhoneNumbers
10) copy files vite.config.js and tailwind.config.js from vendor/vadiksmoniks/phonebook to the root of your project
11) change url from '.../test/public/phonebook/...' to '.../your_project_name/public/phonebook/...' in files /vendor/vadiksmoniks/phonebook/resources/js/components/AddFormComponen.vue (lines 119 and 159)and ListComponent (lines 114, 143, 167)
12)  change url in /vendor/vadiksmoniks/phonebook/resources/js/routes.js from 'test/public/phonebook/' to 'your_project_name/public/phonebook'
13) run commands:
    ```
    npm install
    npm install vue
    npm install vue-router
    npm install --save-dev @vitejs/plugin-vue@4
    npm insta;; -D tailwindcss postcss autoprefix
    npx tailwindcss init -p
    run conmmand npm run dev
    ```
## Features of project:
    + CRUD operations with contacts
    + ability to search by name, page navigation
    + ability to view each contact from search list
      
