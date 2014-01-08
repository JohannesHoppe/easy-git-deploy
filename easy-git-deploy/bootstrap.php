<?php

header("Content-Type:text/plain");

ini_set('display_errors', 1);
error_reporting(E_ALL + E_STRICT + E_DEPRECATED);

require_once './inc/config.php';
require_once './inc/VcsInterface.php';
require_once './inc/VcsAbstract.php';
require_once './inc/Deploy.php';
require_once './inc/Commit.php';