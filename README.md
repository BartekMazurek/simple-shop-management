# simpleShopManagement - (Laravel + PHP API + MySQL stored procedures)
simpleShopManagement is a small shop management proof of concept based on Laravel framework & simple raw PHP API.

![Stocks API image](http://bartekblog.prv.pl/simpleshop/sc1.PNG)
![Stocks API image](http://bartekblog.prv.pl/simpleshop/sc2.PNG)
![Stocks API image](http://bartekblog.prv.pl/simpleshop/sc3.PNG)
![Stocks API image](http://bartekblog.prv.pl/simpleshop/sc4.PNG)
![Stocks API image](http://bartekblog.prv.pl/simpleshop/sc5.PNG)

# Requirements
**1** - PHP 7.2+

**2** - MySql 8+

**3** - Composer

# How to set up - Laravel app
**1** - Download Laravel dependencies, run in project root directory terminal command: **composer install**

**2** - Create database called 'simpleShop' & set proper credentials in **.env** file.

**3** - Set proper path to simpleShopApi application **api.php** file in **.env** file. It's required for communication between two applications.

**4** - Create SQL procedures provided in 'procedures' folder in **procedures.sql** file.

**5** - In project root directory run terminal commands: **php artisan migrate** (to build database schema) & **php artisan db:seed** (to fetch random development data into database).

# How to set up - PHP API
**1** - Edit **credentials.php** file and set proper credentials to simpleShop database.
