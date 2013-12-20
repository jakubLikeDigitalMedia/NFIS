<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 13/12/2013
 * Time: 12:18
 */

// Define application environment
defined('APPLICATION_ENV') || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));
//echo APPLICATION_ENV;

// set error displaying
error_reporting(E_ALL);
if (APPLICATION_ENV === 'development'){
    ini_set('display_errors', 1);
}

define('APPLICATION_PATH', realpath(dirname(__FILE__)));
define('LIBS', APPLICATION_PATH.'/libs');
define('SCRIPTS', APPLICATION_PATH.'/scripts');
define('MODELS', APPLICATION_PATH.'/models');
define('MODELS_DEF', MODELS.'/def');

define('DOMAIN', $_SERVER['SERVER_NAME']);

define('IMAGES', APPLICATION_PATH.'/images');
define('JS', APPLICATION_PATH.'/js');
define('CSS', '../css');

// teplates settings
define('TEMPLATES', APPLICATION_PATH.'/templates');
define('FORMS', TEMPLATES.'/'.'form');
define('DEFAULT_TEMPLATES', TEMPLATES.'/default');
define('_HEAD', DEFAULT_TEMPLATES.'/_head.php');
define('_HEADER', DEFAULT_TEMPLATES.'/_header.php');
define('_FOOTER', DEFAULT_TEMPLATES.'/_footer.php');

define('SEP', '-');

define('SEO_TITLE', 'Nobel Food Intranet System');


define('PAGES_DIR', 'intranet');

//database connection info
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_DBASE', 'nobel_nfis_db');
