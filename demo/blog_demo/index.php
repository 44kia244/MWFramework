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
	require_once("core/ClassLoader.php");
	
	if(!isset($_GET["mod"]) || empty($_GET["mod"])) {
		$_GET["mod"] = BaseConfiguration::$DefaultMod;
		$_GET["view"] = "default";
	}
	
	if(!isset($_GET["view"]) || empty($_GET["view"])) {
		$_GET["view"] = "default";
	}
	
	MWF_ViewLoader::Load($_GET["mod"], $_GET["view"], true);
?>