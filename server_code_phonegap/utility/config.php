<?php
header("Access-Control-Allow-Origin: *");
	define('DBHOST','1.pgsqlserver.com');
	define('DBPORT','5432');
	define('DBNAME','tg04_aryan_intra'); //titusgroup01_grocerydb 
	define('DBUSER','tg04_aryan_intra'); // titusgroup01_grocerydb
	define('DBPASSWORD','aryan#2018'); //   gro2015

define('SCHEMA','dbo');

define('SUCCESS_MSG','successMsg');
define('ERROR_MSG','errorMsg');


define('COMPANY_NAME','Fresh Box Office');

define("URL","http://aryan.ac.in/"); // http://thetitusgroup.us/beta/utkalbazaar/

define("ADMIN_MAIL","info@aryan.ac.in");

date_default_timezone_set('Asia/Kolkata');

?>