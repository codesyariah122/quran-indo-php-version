<?php
/**
 * @author Puji Ermanto <pujiermanto@gmail.com>
 * @return callback
 * */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../app/core/Router.php';

Router::route();

