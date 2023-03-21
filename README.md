# Natek Recruitment
`cd backend`

Open backend/Inc/config.php - configure your SQL Credentials

Run migration

`php migrate.php` 

This will ensure the necessary tables are created as well as put some data in it. 

Now let's go to the front end of the application

`cd frontend`

Run `npm install` to install the dependencies

Open .env file and change the backend base url to the one it is in your PC

Run `npm run dev` to run the application
