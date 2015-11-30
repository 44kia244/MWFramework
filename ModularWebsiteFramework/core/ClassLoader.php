<?php
	class ClassFinder {
		private static $cache = NULL;
		
		public static function readDirectory($dirname = ".", $isOuter = TRUE) {
			if(self::$cache != NULL && $isOuter) return self::$cache;
			
			$ret = array();
			
			$dir = opendir($dirname);
			while(($row = readdir($dir)) !== FALSE) {
				if($row != "." && $row != "..") {
					if(is_dir($dirname."/".$row)) $ret = array_merge($ret, self::readDirectory($dirname."/".$row, FALSE));
					else {
						if(preg_match("/.+\\.class\\.php/", $row)) $ret[$row] = $dirname."/".$row;
					}
				}
			} closedir($dir);
			
			if($isOuter) self::$cache = $ret;
			return $ret;
		}
	}
	
	function __autoload($classname) {
		$dirname = dirname(dirname(__FILE__));
		$allowed_class = ClassFinder::readDirectory($dirname);
		
		$classname .= ".class.php";
		if(array_key_exists($classname, $allowed_class)) {
			require_once($allowed_class[$classname]);
		} else die("Error Loading Resource " . $allowed_class[$classname]);
	}
?>