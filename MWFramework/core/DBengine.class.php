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
	class DBengine extends MySQLi {
		
		/**
			Class Construct : Connect to MySQL
		*/
		public function __construct() {
			parent::__construct(BaseConfiguration::$MySQL["host"], BaseConfiguration::$MySQL["user"], BaseConfiguration::$MySQL["pass"], BaseConfiguration::$MySQL["db"]);
		}
		
		/**
			Class Destruct (End Of Process) : Close Connection
		*/
		public function __destruct() {
			$this->close();
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
			if ($this->connect_errno) return FALSE;
			if($stmt = $this->prepare($SQLquery)) {
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
				if($result == FALSE) return array(array($exec_res));
				else {
					$return = array();
					while ($row = $result->fetch_assoc()) {
						$return[] = $row;
					}
					return $return;
				}
			} else return FALSE;
		}
	}
?>
