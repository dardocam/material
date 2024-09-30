<?php
//punto de entrada de la aplicacion
require 'private/app/Config.php';
//autoload de composer
require 'vendor/autoload.php';


Router::start();
Router::loadController();
