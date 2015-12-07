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
	class AuthorizationEngine {
		private $DB;
		
		public function __construct() {
			$this->DB = new DBengine();
		}
		
		public function getGroupList() {
			return $this->DB->query("SELECT G_ID, G_NAME FROM GROUPS");
		}
		
		public function getGroupPermList($G_ID) {
			return $this->DB->query("SELECT P_ID, P_DESC FROM GROUPS G JOIN PERMISSIONS P ON (P.P_ID = G.G_ID) WHERE G.G_ID = ?",
				array(
					array("i", $G_ID)
				)
			);
		}
		
		public function getGroupInfo($G_ID) {
			return $this->DB->query("SELECT G_ID, G_NAME FROM GROUPS WHERE G_ID = ?",
				array(
					array("i", $G_ID)
				)
			);
		}
		
		public function getPermissionInfo($P_ID) {
			return $this->DB->query("SELECT P_ID, P_DESC FROM PERMISSIONS WHERE P_ID = ?",
				array(
					array("i", $P_ID)
				)
			);
		}
		
		public function isAuthorized($G_ID, $P_ID) {
			$T = $this->DB->query("SELECT COUNT(*) FROM AUTHORIZATION A JOIN PERMISSIONS P ON (P.P_ID = A.P_ID) WHERE A.G_ID = ? AND G.P_ID = ?",
				array(
					array("i", $G_ID),
					array("i", $P_ID)
				)
			);
			
			return $T[0][0];
		}
		
		public function addGroup($G_NAME) {
			return $this->DB->query("INSERT INTO GROUPS (G_NAME) VALUES (?)",
				array(
					array("s", $G_NAME)
				)
			);
		}
		
		public function addPermission($P_DESC) {
			return $this->DB->query("INSERT INTO PERMISSIONS (P_DESC) VALUES (?)",
				array(
					array("s", $P_DESC)
				)
			);
		}
		
		public function authorize($G_ID, $P_ID) {
			if(!($this->isHasGroup($G_ID) && $this->isHasPermission($P_ID))) return FALSE;
			return $this->DB->query("INSERT INTO AUTHORIZATION (G_ID, P_ID) VALUES (?, ?)",
				array(
					array("i", $G_ID),
					array("i", $P_ID)
				)
			);
		}
	}
?>