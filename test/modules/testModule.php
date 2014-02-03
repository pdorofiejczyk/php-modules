<?php
list($u, $o) = $args; //mapping passed args to variables;

echo $o;

$a = 66; //local non-shared var
$this->x = 0; //module scope var, shared inside module

$exports->setX = function($x) { //function exposed outside module
	$this->x = $x; //you can access module scope by using $this
};

$exports->getX = function() {
	return $this->x;
};

$exports->z = 55; //variable exposed outside

?>