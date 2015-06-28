<?php

error_reporting(0);

// Define database connection parameters
define(DB_HOST, 'localhost');
define(DB_USERNAME, 'root');
define(DB_PASSWORD, '');
define(DB_DATABASE, 'logindemo');

// make a connection with database
$con = mysql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD) or die('Failed to connect:'. mysql_error());
$database = mysql_select_db(DB_DATABASE, $con) or die('Failed to connect with database: '. mysql_error());
