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
	class DBengine {
		// 
		private $conn = NULL;
		
		/**
			Class Construct : Connect to MySQL
		*/
		public function __construct() {
			$this->conn = new mysqli(BaseConfiguration::$MySQL["host"], BaseConfiguration::$MySQL["user"], BaseConfiguration::$MySQL["pass"], BaseConfiguration::$MySQL["db"]);
		}
		
		/**
			Class Destruct (End Of Process) : Close Connection
		*/
		public function __destruct() {
			$this->conn->close();
		}
		
		/**
			$SQLquery
				SQL Query String without parameter (use ? to mark parameter)
				Ex. SELECT * FROM `users` WHERE `username` = ? AND `password` = ?
			
			$SQLparam
				SQL Parameter as 2D Array
				Ex. array(
						array("s", "admin"),
						array("s", "P4$sw0rd")
				    )
		*/
		public function query($SQLquery, $SQLparam = array()) {
			if ($this->conn->connect_errno) return FALSE;
			if($stmt = $this->conn->prepare($SQLquery)) {
				$type = "";
				$param = array("Initialize");
				for($i=0;$i<count($SQLparam);$i++) {
					$type .= $SQLparam[$i][0];
					$param[] = &$SQLparam[$i][1];
				}
				$param[0] = $type;
				
				if(count($SQLparam) > 0) call_user_func_array(array($stmt,"bind_param"),$param);
				$exec_res = $stmt->execute();
				$result = $stmt->get_result();
				if($result == FALSE) return $exec_res;
				else {
					$return = array();
					while ($row = $result->fetch_row()) {
						$return[] = $row;
					}
					return $return;
				}
			}
		}
	}
?>
