<?php
	/****************************************************************************************
	*	This file is part of ModularWebsiteFramework.                                       *
	*	                                                                         			*
	*	ModularWebsiteFramework is free software: you can redistribute it and/or modify     *
	*	it under the terms of the GNU General Public License as published by                *
	*	the Free Software Foundation, either version 3 of the License, or                   *
	*	(at your option) any later version.                                                 *
	*	                                                                                    *
	*	ModularWebsiteFramework is distributed in the hope that it will be useful,          *
	*	but WITHOUT ANY WARRANTY; without even the implied warranty of                      *
	*	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the                       *
	*	GNU General Public License for more details.                                        *
	*	                                                                                    *
	*	You should have received a copy of the GNU General Public License                   *
	*	along with ModularWebsiteFramework.  If not, see <http://www.gnu.org/licenses/>.    *
	****************************************************************************************/
?>
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