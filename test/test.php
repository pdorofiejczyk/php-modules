<?php
include(dirname(__FILE__) . '/../Modules.php');

Modules::setIncludePath(dirname(__FILE__));
Modules::register('Test', 'modules/testModule.php');

$MyTestModule = Modules::import('Test');

print_r($MyTestModule->y());
?>