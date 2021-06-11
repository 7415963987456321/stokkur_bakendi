# Backend using the Lumen framework

Should be able to get it up and running with minimal trouble.

# Requirements
 - Lumen framework
 - php and composer
 - mySQL or MariaDB database

# Env
The .env file needs to be customized to connect to a database.
In this case I used MariaDB/mySQL for the database

# Running

Run:
    php artisan migrate:fresh && php -S localhost:8000 -t public

That should migrate the DB tables and run the server, unless some further
configuration is required.

# About
The backend fetches company data from the apis.is API, it does some minor
filtering of the data and then saves it to a database, thus the data is "cached" (not really)
and could be retreived even if the original API is down, (given that the search
term has been searched before).

# Routes
There are two routes:
    - "api/debug", This route throws all the data from the database to JSON
    - "api/name/{search term}", this is the main request route, it returns what
      is searched for

