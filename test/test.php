<?php
include(dirname(__FILE__) . '/../Modules.php');

Modules::setIncludePath(dirname(__FILE__));
Modules::register('Test', 'modules/testModule.php');

$MyTestModule = Modules::import('Test', 666, 'test arg');

echo $MyTestModule->getX() . "\n";
$MyTestModule->setX(11);
echo $MyTestModule->getX() . "\n";

?>