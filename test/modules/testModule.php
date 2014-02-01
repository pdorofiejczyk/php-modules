<?php
$private->x = function() {
	echo 'func x';
};

$exports->y = function() use ($private) {
	$private->x();
	echo 'func y';
};

return $exports;
?>