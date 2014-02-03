PHP Modules
===========

PHP, file-based modules implementation

Probably one of the craziest things I ever seen in PHP. Have fun :)

Usage
-----

Include path configuration

```
Modules::setIncludePath('path_to_your_main_include_dir');
```

Modules registration (Mapping module names to files)

```
Modules::register('X', 'relative/path/to/module/X.php');
Modules::register('Y', 'relative/path/to/module/Y.php');
```

Importing modules

```
$MyModuleX = Modules::import('X');
$MyModuleY = Modules::import('Y', 'argument 1', 'argument 2');
```

Access to exposed data

```
$MyModuleX->some_exposed_var_name;
$MyModuleX->some_exposed_function_name();
```

Creating modules
----------------

In this implementation module is simple php file which have their own scope but can expose some variables outside. You can use special objects inside your module:

* $exports (shortcut of $this->exports) - contains all data which will be exposed oudside
* $this - contains all private data for module
* $args (shortcut of $this->args) - array of arguments passed on module initialization

To expose data, you have to put return statement at the end of your module file.

Example module

```
list($u, $o) = $args; //mapping passed args to variables;

$a = 66; //local non-shared var
$this->x = 0; //module scope var, shared inside module

$exports->setX = function($x) { //function exposed outside module
	$this->x = $x; //you can access module scope by using $this
};

$exports->getX = function() {
	return $this->x;
};

$exports->z = 55; //variable exposed outside
```

WARNING

Classes and "normal" functions (not closures) doesn't work correctly with modules because they are always global.
