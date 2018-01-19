<?php
/**
 * @description : first file called by the client
 * @author: Quentin Thomasset
 * @package: BlogPro
 * Date: 02/10/2017
 * Time: 14:50
 */

namespace App;
use App\Model\Application;

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../App/Config/config.php';

error_reporting(_ERROR_REPORTING_);
ini_set('display_errors', 1);

$app = new Application;
$app->run();