# Job App

### How to install App ? 

1. run : composer install 
2. run : php artisan migrate
3. run : php artisan db:seed 

### to Run Unit Test 

run : php artisan test 

## The app has 2 types of user : 

###  Manger (Mgr): 
Has access to read all positions(jobs) in system

credentials to login : 

email : manger@example.com

password : Password!

### Regular (Reg):
Has access to store and show and update and delete his positions(jobs) only 

credentials to login :

email : regular@example.com

password : Password!

each user has specific routes 

