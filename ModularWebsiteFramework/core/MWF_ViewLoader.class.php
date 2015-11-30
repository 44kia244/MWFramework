<?php
	/***************************************
	* Modular Website Framework ViewLoader *
	*   Input = Module ID, View ID         *
	***************************************/
	
	class MWF_ViewLoader {
		public static function Load($mod_id, $view_id) {
			require(dirname(dirname(__FILE__)) . "/" . $mod_id . "/" . $view_id . ".php");
		}
	}
?>