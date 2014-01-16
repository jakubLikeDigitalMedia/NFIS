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
//define('SCRIPTS', APPLICATION_PATH.'/scripts');
define('SCRIPTS', '../../scripts');
define('MODELS', APPLICATION_PATH.'/models');
define('MODELS_DEF', MODELS.'/def');

define('DOMAIN', $_SERVER['SERVER_NAME']);

define('IMAGES', APPLICATION_PATH.'/images');
define('JS', '../../js');
define('CSS', '../../css');

// teplates settings
define('TEMPLATES', APPLICATION_PATH.'/templates');

define('FORMS', TEMPLATES.'/'.'form');
define('FORMS_FRONTEND', FORMS.'/frontend');
define('FORMS_BACKEND', FORMS.'/backend');

/*
 * Suffixes for action scripts
 * ----------------------------
 * create, update and delete scripts for each model will be placed in: scripts/model_name/model_name_action.php
 * path for these scripts will be automatically created when initialize particular model
 */

define('CREATE_SUF', 'create');
define('UPDATE_SUF', 'update');
define('DELETE_SUF', 'delete');
//======================================================

define('DEFAULT_TEMPLATES', TEMPLATES.'/default');
define('_HEAD', DEFAULT_TEMPLATES.'/_head.php');
define('_HEADER', DEFAULT_TEMPLATES.'/_header.php');
define('_FOOTER', DEFAULT_TEMPLATES.'/_footer.php');

define('SEP', '-');
define('PREV_PREFIX', 'prev:');

define('SEO_TITLE', 'Nobel Food Intranet System');


define('PAGES_DIR', 'intranet');

$incs = array(
    MODELS,
    MODELS_DEF,
    LIBS.'/PFBC',
    get_include_path()
);

set_include_path(implode(PATH_SEPARATOR, $incs));




//database connection info
//------------------------
if ($_SERVER['SERVER_NAME'] == 'nfis.com'){
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', 'root');
    define('DB_DBASE', 'nobel_nfis_db');
}
else{
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_DBASE', 'nobel_NFIS_DB');

}

