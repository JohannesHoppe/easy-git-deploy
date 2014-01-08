<?php

require_once 'bootstrap.php';

/**
 * @var array $config
 */

$deploy = new Commit($config);

$deploy->execute();

echo $deploy->_log_messages;