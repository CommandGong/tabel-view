## Preamble

Table View is a simple System which allow user to download published works from CrossRef

## How to set up
  1. Requirement : Apache, MySql and PHP environment
  2. Set up database : go to /resource , import table_view_database.sql to your  local database
  3. go to config.php, adjust hostname, user name, database name and password according to your MySql Setupdatabase
  3. go to config.php, adjust hostname, user name, database name and password according to your MySql Setup
  4. go to your Apache Page to view it. You could add works by entering DOI in the input of the main page to search from CrossRef database, and choose eighter add it to your local system

##API
 - GET {URL}\api\getWorker.php  to get every work data  
 - This api use basic Auth to provide Authenticate to user, which requires username and password where could found and change in config.php in root directory.
 
##
 
