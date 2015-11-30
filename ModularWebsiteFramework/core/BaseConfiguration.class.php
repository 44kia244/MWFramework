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
	class BaseConfiguration {
		public static $WebPath = "";
		public static $WebName = "TEST WEBSITE";
	}
	
	BaseConfiguration::$WebPath = dirname(dirname(__FILE__));
?>