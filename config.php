<?php

/*********************************************************************
 * fii.sh - url shortener
 *  v0.1.1 - simple url shortener
 * 
 * ---
 * Demo:    https://fii.sh
 * Github:  https://github.com/nickfrosty/url-shortener
 * ---
 * Twitter: https://twitter.com/nickfrosty
 * Website: https://frostbutter.com
 * 
 *********************************************************************/

define("DEBUG", false);

// Define the global variables
define("SITE_NAME", "fii.sh");
define("SITE_LOGO", "./assets/img/logo.png");

define("GOOGLE_ANALYTICS", ""); // G4 codes only

// set the site address for the site
define("SITE_ADDR", "http://localhost/fii.sh");

// define the database connection settings
define("DB_SERVER", "localhost");
define("DB_USER",   "root");
define("DB_PASS",   "");
define("DB_NAME",   "fiish");


/*
    Define your desired URL shortener settings
*/
define("CHARSET", "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ");
define("URL_LENGTH", 7);
define("URL_BASE", SITE_ADDR);

if (DEBUG)
    ini_set("log_errors", true);
else
    ini_set("log_errors", false);

// create a absolute path variable
if (!defined('ABSPATH'))
    define('ABSPATH', dirname(__FILE__) . '');


// load the required custom functions
require_once(ABSPATH . '/functions.php');
