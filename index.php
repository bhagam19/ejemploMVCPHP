<?php
    error_reporting(E_ALL);
    ini_set('ignore_repeat_errors', TRUE);
    ini_set('display_errors', FALSE);
    ini_set('log_errors', TRUE);
    ini_set('error_log','PHPerrores.log');
    error_log('Inicio de aplicación web');

    require_once 'libs/app.php';

    $app = new App();
?>