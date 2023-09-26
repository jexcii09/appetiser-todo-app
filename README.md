## INSTALLATION GUIDE
## Requirements
 - PHP ^8.1
 - Node v18.17.1

## Specifications
 - Laravel 10
 - Vue 3
 - Bootstrap 5
---
### Step 1
Create database using PhpMyAdmin

### Step 2
Setup your env file. In command line type <br/>
`composer install` <br/>
`npm install` 

`cp .env.example .env` <br/>
`php artisan key:generate` <br/>
after this change database name in env `DB_DATABASE=[database_name_you_created]`

### Step 3
Type this in your command line to populate the database <br/>
`php artisan migrate` <br/>
`php artisan db:seed`


### Step 4
Open two command line to connect to server. <br />
CLI 1: `php artisan serve` <br/>
CLI 2: `npm run dev`

### Step 5
You can now access the application by default you can access with this url: http://localhost:8000/

FOR MORE DETAILS LOOK UP TO DOCUMENTATION FOLDER <br />
Files Included: API Doc, User Manual, API json collection

