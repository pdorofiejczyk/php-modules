<?php
class CallableStdClass {
	public function __call($method, $args) {
        if(is_callable(array($this, $method))) {
            return call_user_func_array($this->$method, $args);
        }
    }
}

final class Modules {
	private static $modules = array();
	private static $instances = array();
	private static $includePath = '';

	public static function importModule($name) {
		if(array_key_exists($name, self::$instances)) {
			return self::$instances[$name];
		} else if(array_key_exists($name, self::$modules)) {
			$exports = new CallableStdClass();
			$private = new CallableStdClass();

			self::$instances[$name] = include(self::$includePath . '/' . self::$modules[$name]);

			return self::$instances[$name];
		} else {
			throw new Exception('No such module!');
		}
	}

	public static function registerModule($name, $path) {
		self::$modules[$name] = $path;
	}

	public static function setIncludePath($includePath) {
		self::$includePath = $includePath;
	}
}
?>