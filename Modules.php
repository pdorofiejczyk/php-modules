<?php
class PropertyContainer {
	private $params = array();

	public function __call($method, $args) {
        if(array_key_exists($method, $this->params)) {
            return call_user_func_array($this->params[$method], $args);
        }
    }

    public function __set($key, $value) {
    	$this->params[$key] = $value;
    }

    public function __get($key) {
    	return $this->params[$key];
    }
}

class Module extends PropertyContainer {
	private $fullPath = null;
	private $exports = null;
	private $args = null;
	
	public function __construct($fullPath, $args) {
		$this->fullPath = $fullPath;
		$this->args = $args;
	}

	public function getExports() {
		if($this->exports === null) {
			$exports = new PropertyContainer();
			$args = $this->args;
			include($this->fullPath);
			$this->exports = &$exports;
		}

		return $this->exports;
	}
}

final class Modules {
	private static $modules = array();
	private static $instances = array();
	private static $includePath = '';

	public static function import($name) {
		if(array_key_exists($name, self::$modules)) {
			if(!array_key_exists($name, self::$instances)) {
				self::$instances[$name] = new Module(self::$includePath . '/' . self::$modules[$name], array_slice(func_get_args(), 1));
			}

			return self::$instances[$name]->getExports();
		} else {
			throw new Exception('No such module!');
		}
	}

	public static function register($name, $path) {
		self::$modules[$name] = $path;
	}

	public static function setIncludePath($includePath) {
		self::$includePath = $includePath;
	}
}
?>