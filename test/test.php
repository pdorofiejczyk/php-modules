<?php
include(dirname(__FILE__) . '/../Modules.php');

Modules::setIncludePath(dirname(__FILE__));
Modules::registerModule('Test', 'modules/testModule.php');

$MyTestModule = Modules::importModule('Test');

print_r($MyTestModule->y());
?>