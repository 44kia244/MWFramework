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
			require(BaseConfiguration::$WebPath . "/" . $mod_id . "/" . $view_id . ".php"); // DUMMY TEMPOLARY CODE
		}
	}
?>