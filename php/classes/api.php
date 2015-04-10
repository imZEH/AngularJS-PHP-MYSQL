<?php

	require_once("../conf/REST.php");

	class branch extends REST {

		public $data = "";

		private $db = NULL;
		private $mysqli = NULL;

		public function __construct(){
			parent::__construct();
			$this->dbConnect();
		}

		private function dbConnect(){
			$this->mysqli = $this->conn();
		}

		public function processApi(){
			$func = strtolower(trim(str_replace("/","",$_REQUEST['x'])));
			if((int)method_exists($this,$func) > 0)
				$this->$func();
			else
				$this->response('',404); // If the method not exist with in this class "Page not found".
		}

		private function branchs(){	
			if($this->get_request_method() != "GET"){
				$this->response('',406);
			}
			$query="SELECT * FROM branch order by b_name asc";
			$r = $this->mysqli->query($query) or die($this->mysqli->error.__LINE__);

			if($r->num_rows > 0){
				$result = array();
				while($row = $r->fetch_assoc()){
					$result[] = $row;
				}
				$this->response($this->json($result), 200); // send user details
			}
			$this->response('',204);	// If no records "No Content" status
		}

		private function branch(){	
			if($this->get_request_method() != "GET"){
				$this->response('',406);
			}
			$id = (int)$this->_request['b_id'];
			if($id > 0){	
				$query="SELECT * FROM branch where b_id=$id";
				$r = $this->mysqli->query($query) or die($this->mysqli->error.__LINE__);
				if($r->num_rows > 0) {
					$result = $r->fetch_assoc();	
					$this->response($this->json($result), 200); // send user details
				}
			}
			$this->response('',204);	// If no records "No Content" status
		}

		private function insertBranch(){
			if($this->get_request_method() != "POST"){
				$this->response('',406);
			}

			$branch = json_decode(file_get_contents("php://input"),true);
			$column_names = array('b_name', 'b_desc');
			$keys = array_keys($branch);
			$columns = '';
			$values = '';
			foreach($column_names as $desired_key){
			   if(!in_array($desired_key, $keys)) {
			   		$$desired_key = '';
				}else{
					$$desired_key = $branch[$desired_key];
				}
				$columns = $columns.$desired_key.',';
				$values = $values."'".$$desired_key."',";
			}
			$query = "INSERT INTO branch(".trim($columns,',').") VALUES(".trim($values,',').")";
			if(!empty($branch)){
				$r = $this->mysqli->query($query) or die($this->mysqli->error.__LINE__);
				$success = array('status' => "Success", "msg" => "Branch Successfully Created.", "data" => $branch);
				$this->response($this->json($success),200);
			}else
				$this->response('',204);
		}

		private function updateBranch(){
			if($this->get_request_method() != "POST"){
				$this->response('',406);
			}
			$branch = json_decode(file_get_contents("php://input"),true);
			$id = (int)$branch['b_id'];
			$column_names = array('b_name', 'b_desc');
			$keys = array_keys($branch['branch']);
			$columns = '';
			$values = '';
			foreach($column_names as $desired_key){ // Check the customer received. If key does not exist, insert blank into the array.
			   if(!in_array($desired_key, $keys)) {
			   		$$desired_key = '';
				}else{
					$$desired_key = $branch['branch'][$desired_key];
				}
				$columns = $columns.$desired_key."='".$$desired_key."',";
			}
			$query = "UPDATE branch SET ".trim($columns,',')." WHERE b_id=$id";
			if(!empty($branch)){
				$r = $this->mysqli->query($query) or die($this->mysqli->error.__LINE__);
				$success = array('status' => "Success", "msg" => "Branch ".$id." Updated Successfully.", "data" => $branch);
				$this->response($this->json($success),200);
			}else
				$this->response('',204);	// "No Content" status
		}

		private function deleteBranch(){
			if($this->get_request_method() != "DELETE"){
				$this->response('',406);
			}
			$id = (int)$this->_request['b_id'];
			if($id > 0){				
				$query="DELETE FROM branch WHERE b_id = $id";
				$r = $this->mysqli->query($query) or die($this->mysqli->error.__LINE__);
				$success = array('status' => "Success", "msg" => "Successfully Deleted one record.");
				$this->response($this->json($success),200);
			}else
				$this->response('',204);	// If no records "No Content" status
		}

		private function specifications(){	
			if($this->get_request_method() != "GET"){
				$this->response('',406);
			}
			$query="SELECT * FROM specification order by sp_name asc";
			$r = $this->mysqli->query($query) or die($this->mysqli->error.__LINE__);

			if($r->num_rows > 0){
				$result = array();
				while($row = $r->fetch_assoc()){
					$result[] = $row;
				}
				$this->response($this->json($result), 200); // send user details
			}
			$this->response('',204);	// If no records "No Content" status
		}

		private function specification(){	
			if($this->get_request_method() != "GET"){
				$this->response('',406);
			}
			$id = (int)$this->_request['sp_id'];
			if($id > 0){	
				$query="SELECT * FROM specification where sp_id=$id";
				$r = $this->mysqli->query($query) or die($this->mysqli->error.__LINE__);
				if($r->num_rows > 0) {
					$result = $r->fetch_assoc();	
					$this->response($this->json($result), 200); // send user details
				}
			}
			$this->response('',204);	// If no records "No Content" status
		}

		private function insertSpecification(){
			if($this->get_request_method() != "POST"){
				$this->response('',406);
			}

			$specification = json_decode(file_get_contents("php://input"),true);
			$column_names = array('sp_name', 'sp_desc');
			$keys = array_keys($specification);
			$columns = '';
			$values = '';
			foreach($column_names as $desired_key){
			   if(!in_array($desired_key, $keys)) {
			   		$$desired_key = '';
				}else{
					$$desired_key = $specification[$desired_key];
				}
				$columns = $columns.$desired_key.',';
				$values = $values."'".$$desired_key."',";
			}
			$query = "INSERT INTO specification(".trim($columns,',').") VALUES(".trim($values,',').")";
			if(!empty($specification)){
				$r = $this->mysqli->query($query) or die($this->mysqli->error.__LINE__);
				$success = array('status' => "Success", "msg" => "Specification Created Successfully.", "data" => $specification);
				$this->response($this->json($success),200);
			}else
				$this->response('',204);
		}

		private function updateSpecification(){
			if($this->get_request_method() != "POST"){
				$this->response('',406);
			}
			$specification = json_decode(file_get_contents("php://input"),true);
			$id = (int)$specification['sp_id'];
			$column_names = array('sp_name', 'sp_desc');
			$keys = array_keys($specification['specification']);
			$columns = '';
			$values = '';
			foreach($column_names as $desired_key){ // Check the customer received. If key does not exist, insert blank into the array.
			   if(!in_array($desired_key, $keys)) {
			   		$$desired_key = '';
				}else{
					$$desired_key = $specification['specification'][$desired_key];
				}
				$columns = $columns.$desired_key."='".$$desired_key."',";
			}
			$query = "UPDATE specification SET ".trim($columns,',')." WHERE sp_id=$id";
			if(!empty($specification)){
				$r = $this->mysqli->query($query) or die($this->mysqli->error.__LINE__);
				$success = array('status' => "Success", "msg" => "Specification ".$id." Updated Successfully.", "data" => $specification);
				$this->response($this->json($success),200);
			}else
				$this->response('',204);	// "No Content" status
		}

		private function deleteSpecification(){
			if($this->get_request_method() != "DELETE"){
				$this->response('',406);
			}
			$id = (int)$this->_request['sp_id'];
			if($id > 0){				
				$query="DELETE FROM specification WHERE sp_id = $id";
				$r = $this->mysqli->query($query) or die($this->mysqli->error.__LINE__);
				$success = array('status' => "Success", "msg" => "Successfully deleted one record.");
				$this->response($this->json($success),200);
			}else
				$this->response('',204);	// If no records "No Content" status
		}

		private function doctors(){	
			if($this->get_request_method() != "GET"){
				$this->response('',406);
			}
			$query="SELECT * FROM doctor d JOIN specification s ON s.sp_id = d.sp_id JOIN branch b ON b.b_id = d.b_id order by d.d_fname asc";
			$r = $this->mysqli->query($query) or die($this->mysqli->error.__LINE__);

			if($r->num_rows > 0){
				$result = array();
				while($row = $r->fetch_assoc()){
					$result[] = $row;
				}
				$this->response($this->json($result), 200); // send user details
			}
			$this->response('',204);	// If no records "No Content" status
		}

		private function doctor(){	
			if($this->get_request_method() != "GET"){
				$this->response('',406);
			}
			$id = (int)$this->_request['d_id'];
			if($id > 0){	
				$query="SELECT * FROM doctor where d_id=$id";
				$r = $this->mysqli->query($query) or die($this->mysqli->error.__LINE__);
				if($r->num_rows > 0) {
					$result = $r->fetch_assoc();	
					$this->response($this->json($result), 200); // send user details
				}
			}
			$this->response('',204);	// If no records "No Content" status
		}

		private function insertDoctor(){
			if($this->get_request_method() != "POST"){
				$this->response('',406);
			}

			$doctor = json_decode(file_get_contents("php://input"),true);
			$column_names = array('d_fname', 'd_mname', 'd_lname', 'd_sched', 'sp_id', 'b_id');
			$keys = array_keys($doctor);
			$columns = '';
			$values = '';
			foreach($column_names as $desired_key){
			   if(!in_array($desired_key, $keys)) {
			   		$$desired_key = '';
				}else{
					$$desired_key = $doctor[$desired_key];
				}
				$columns = $columns.$desired_key.',';
				$values = $values."'".$$desired_key."',";
			}
			$query = "INSERT INTO doctor(".trim($columns,',').") VALUES(".trim($values,',').")";
			if(!empty($doctor)){
				$r = $this->mysqli->query($query) or die($this->mysqli->error.__LINE__);
				$success = array('status' => "Success", "msg" => "Doctor Created Successfully.", "data" => $doctor);
				$this->response($this->json($success),200);
			}else
				$this->response('',204);
		}

		private function updateDoctor(){
			if($this->get_request_method() != "POST"){
				$this->response('',406);
			}
			$doctor = json_decode(file_get_contents("php://input"),true);
			$id = (int)$doctor['d_id'];
			$column_names = array('d_fname', 'd_mname', 'd_lname', 'd_sched', 'sp_id', 'b_id');
			$keys = array_keys($doctor['doctor']);
			$columns = '';
			$values = '';
			foreach($column_names as $desired_key){ // Check the customer received. If key does not exist, insert blank into the array.
			   if(!in_array($desired_key, $keys)) {
			   		$$desired_key = '';
				}else{
					$$desired_key = $doctor['doctor'][$desired_key];
				}
				$columns = $columns.$desired_key."='".$$desired_key."',";
			}
			$query = "UPDATE doctor SET ".trim($columns,',')." WHERE d_id=$id";
			if(!empty($doctor)){
				$r = $this->mysqli->query($query) or die($this->mysqli->error.__LINE__);
				$success = array('status' => "Success", "msg" => "Doctor ".$id." Updated Successfully.", "data" => $doctor);
				$this->response($this->json($success),200);
			}else
				$this->response('',204);	// "No Content" status
		}

		private function deleteDoctor(){
			if($this->get_request_method() != "DELETE"){
				$this->response('',406);
			}
			$id = (int)$this->_request['d_id'];
			if($id > 0){				
				$query="DELETE FROM doctor WHERE d_id = $id";
				$r = $this->mysqli->query($query) or die($this->mysqli->error.__LINE__);
				$success = array('status' => "Success", "msg" => "Successfully deleted one record.");
				$this->response($this->json($success),200);
			}else
				$this->response('',204);	// If no records "No Content" status
		}
	}


	
	
$api = new branch;
$api->processApi();