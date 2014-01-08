<?php

require_once 'bootstrap.php';

/**
 * @var array $config
 */

$deploy = new Deploy($config);
$deploy->post_deploy = function() use ($deploy)
{
  // hit the wp-admin page to update any db changes
  // $deploy->exec_and_log('Updating wordpress database... ', 'curl http://www.foobar.com/wp-admin/upgrade.php?step=upgrade_db');
};

$deploy->execute();

echo $deploy->_log_messages;