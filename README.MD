# Login Page POC
Some poc of a login / register setup with php & mysql

## Setup:

### Dependencies:
- webserver (tested with nginx)
- php 7.4
- mysqld/mariad


1. Clone this repo
2. Create a database
3. Create a user and grant access to database
4. Change "login.php" & "register.php"
5. Have fun!

## Features:
### Implemented
- [x] Login
- [x] PHP Session ID
- [x] Password Validation
- [x] Name & Surname
- [x] Menu with different options for logged in users on the /secure.php page
- [x] Reset password
- [x] Profile page (/profile.php) 
  
### Need implementation:
- [ ] Change password
- [ ] Change email
- [ ] Change Names



### Thanks for flying penguin stack overflow stealing! <3

### Database Setup:

`````
# mysql -u root -p
```````
in the mysql shell do the following:

``````
CREATE DATABASE usertable;
CREATE USER 'usertable'@'localhost' IDENTIFIED WITH mysql_native_password BY 'password';
GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, INDEX, DROP, ALTER, CREATE TEMPORARY TABLES, LOCK TABLES ON usertable.* TO 'usertable'@'localhost';
FLUSH PRIVILEGES;
exit
``````
Test if you were successfull with:
`````
# mysql -u usertable -p
```````
Import the empty database like this:
`````
# mysql -u usertable --password=password usertable < usertable.sql
```````
