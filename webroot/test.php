<?php

require dirname(__DIR__) . '/vendor/autoload.php';

use Cake\Core\Configure;

require dirname(__DIR__) . '/config/bootstrap.php';

echo "<pre>";
print_r(Configure::read('Datasources'));
echo "</pre>";