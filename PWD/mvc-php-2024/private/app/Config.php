<?php

//var_dump(dirname(__DIR__));
define('HOME_URL', "http://localhost/mvc-php-2024/");
define("LOAD_PATH", "private/core/");
define("MODELS_PATH", "private/models/");
define("VIEWS_PATH", "private/views/");
define("CONTROLLERS_PATH", "private/controllers/");
define("HELPERS_PATH", "private/helpers/");
define("ASSETS_PATH", "../assets/");
const APP_NAME = 'mvc-php-2024';

// //datos de conexion a base de Datos POSTGRES
// const DBP_POSTGRES = 'pgsql'; //'mysql'
// const DBP_NAME='dbname';
// const DBP_HOST='localhost';
// const DBP_USER='postgres';
// const DBP_PASSWORD='postgres';
// const DBP_CHARSET='charset-utf8';

//datos de conexion a base de Datos MYSQL
// const DBM_MYSQL = 'mysql'; //'mysql'
// const DBM_NAME = '';
// const DBM_HOST = '127.0.0.1';
// const DBM_USER = 'root';
// const DBM_PASSWORD = '';
// const DBM_CHARSET = 'charset-utf8';



//Apis registradas
// const APP_DART = HOME_URL . '/assets';
// const REGISTER_KEY_APP_DART = 'MH9inmL0Ef2yRVFCvEYS';

//
//delimitadores decimal y millar Ej 24.251,00
const SPD = ',';
const SPM = '.';

//simbolo de moneda
const S = '$';

//zona horaria
date_default_timezone_set("America/Argentina/Buenos_Aires");
