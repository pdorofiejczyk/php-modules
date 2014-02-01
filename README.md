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
$MyModuleY = Modules::import('Y');
```

Access to exposed data

```
$MyModuleX->some_exposed_var_name;
$MyModuleX->some_exposed_function_name();
```

Creating modules
----------------

In this implementation module is simple php file which have their own scope but can expose some variables outside. You can use special objects inside your module:

* $exports - contains all data which will be exposed oudside
* $private - contains all private data for module

To expose data, you have to put return statement at the end of your module file.

Example module

```
/**
 * this is our private function
 */
$private->x = function() {
	echo 'func x';
};

/**
 * this is public function but we want to have access 
 * to private data so we using "use" statement
 */
$exports->y = function() use ($private) {
	$private->x();
	echo 'func y';
};

return $exports; //exposing data outside
```

WARNING

Classes and "normal" functions (not closures) doesn't work correctly with modules because they are always global.
