<?php
	/****************************************************************************
	*	This file is part of MWFramework.                                       *
	*	                                                                        *
	*	MWFramework is free software: you can redistribute it and/or modify     *
	*	it under the terms of the GNU General Public License as published by    *
	*	the Free Software Foundation, either version 3 of the License, or       *
	*	(at your option) any later version.                                     *
	*	                                                                        *
	*	MWFramework is distributed in the hope that it will be useful,          *
	*	but WITHOUT ANY WARRANTY; without even the implied warranty of          *
	*	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the           *
	*	GNU General Public License for more details.                            *
	*	                                                                        *
	*	You should have received a copy of the GNU General Public License       *
	*	along with MWFramework.  If not, see <http://www.gnu.org/licenses/>.    *
	****************************************************************************/
?>
<?php
	/***************************************
	* Modular Website Framework ViewLoader *
	*   Input = Module ID, View ID         *
	***************************************/
	
	class MWF_ViewLoader {
		
		/**
			Load View
			
			$mod_id
				module name
				
			$view_id
				view filename
		*/
		public static function Load($mod_id, $view_id) {
			if(!file_exists(BaseConfiguration::$WebPath . "/" . $mod_id . "/module_config.php")) die("Object Not Found");
			require(BaseConfiguration::$WebPath . "/" . $mod_id . "/module_config.php");
			
			if(isset($view_id) && !empty($view_id)) $view_data = $view_index[$view_id];
			else $view_data = $view_index["default"];
			
			$file = BaseConfiguration::$WebPath . "/" . $mod_id . "/" . $view_data[0];
			
			if(file_exists($file)) {
				header("Content-Type: " . $view_data[1]);
				include($file);
			} else die("Object Not Found");
			
		}
	}
?>