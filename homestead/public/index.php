<?php
/**
 * Created by PhpStorm.
 * User: quent
 * Date: 02/10/2017
 * Time: 14:50
 */

namespace App;
use App\Model\Application;
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../../vendor/autoload.php';

$app = new Application;
$app->run();