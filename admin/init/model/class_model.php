<?php

	require 'config/connection.php';

	class class_model{

		public $host = db_host;
		public $user = db_user;
		public $pass = db_pass;
		public $dbname = db_name;
		public $conn;
		public $error;
 
		public function __construct(){
			$this->connect();
		}
 
		private function connect(){
			$this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
			if(!$this->conn){
				$this->error = "Fatal Error: Can't connect to database".$this->conn->connect_error;
				return false;
			}
		}

		public function login($username, $password, $status){
			$stmt = $this->conn->prepare("SELECT * FROM `tbl_usermanagement` WHERE `username` = ? AND `password` = ? AND `status` = ? AND `desgination` = 'MIS'") or die($this->conn->error);
			$stmt->bind_param("sss", $username, $password, $status);
			if($stmt->execute()){
				$result = $stmt->get_result();
				$valid = $result->num_rows;
				$fetch = $result->fetch_array();
				return array(
					'user_id'=> htmlentities($fetch['user_id']),
					'count'=>$valid
				);
			}
		}

		public function user_account($user_id){
			$stmt = $this->conn->prepare("SELECT * FROM `tbl_usermanagement` WHERE `user_id` = ?") or die($this->conn->error);
		    $stmt->bind_param("i", $user_id);
			if($stmt->execute()){
				$result = $stmt->get_result();
				$fetch = $result->fetch_array();
				return array(
					'complete_name'=> $fetch['complete_name']
					
				);
			}	
		}

		public function add_student( $first_name, $middle_name, $last_name, $course, $year_level, $date_ofbirth, $gender, $complete_address, $email_address, $mobile_number, $username, $password, $status){
			$stmt = $this->conn->prepare("INSERT INTO `tbl_student` (`first_name`, `middle_name`, `last_name`, `course`, `year_level`, `date_ofbirth`, `gender`, `complete_address`, `email_address`, `mobile_number`, `username`, `password`, `account_status`) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)") or die($this->conn->error);
			$stmt->bind_param("sssssssssssss", $first_name, $middle_name, $last_name, $course, $year_level, $date_ofbirth, $gender, $complete_address, $email_address, $mobile_number, $username, $password, $status);
			if($stmt->execute()){
				$stmt->close();
				$this->conn->close();
				return true;
			}
		}
 
	    public function fetchAll_student(){ 
            $sql = "SELECT * FROM  tbl_student";
				$stmt = $this->conn->prepare($sql); 
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;

		  }

		public function edit_student($studentID_no, $first_name, $middle_name, $last_name, $course, $year_level, $date_ofbirth, $gender, $complete_address, $email_address, $mobile_number, $username, $password, $account_status, $student_id){
			$sql = "UPDATE `tbl_student` SET   `studentID_no` = ?,   `first_name` = ?, `middle_name` = ?, `last_name` = ?, `course` = ?, `year_level` = ?, `date_ofbirth` = ?, `gender` = ?, `complete_address` = ?, `email_address` = ?, `mobile_number` = ?, `username` = ?, `password` = ?, `account_status` = ?  WHERE student_id = ?";
			 $stmt = $this->conn->prepare($sql);
			$stmt->bind_param("ssssssssssssssi", $studentID_no, $first_name, $middle_name, $last_name, $course, $year_level, $date_ofbirth, $gender, $complete_address, $email_address, $mobile_number, $username, $password, $account_status, $student_id);
			if($stmt->execute()){
				$stmt->close();
				$this->conn->close();
				return true;
			}
		}

		public function delete_student($student_id){
				$sql = "DELETE FROM tbl_student WHERE student_id = ?";
				 $stmt = $this->conn->prepare($sql);
				$stmt->bind_param("i", $student_id);
				if($stmt->execute()){
					$stmt->close();
					$this->conn->close();
					return true;
				}
			}

	    public function fetchAll_documentrequest(){ 
            $sql = "SELECT * FROM  tbl_documentrequest";
				$stmt = $this->conn->prepare($sql); 
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;

		  }

		  public function fetchAll_newrequest(){ 
            $sql = "SELECT * FROM  tbl_documentrequest WHERE status = 'Received' ORDER BY date_request DESC";
				$stmt = $this->conn->prepare($sql); 
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;

		  }

		  public function fetchAll_releasing(){ 
            $sql = "SELECT * FROM  tbl_documentrequest WHERE status = 'Releasing' ORDER BY date_request DESC";
				$stmt = $this->conn->prepare($sql); 
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;

		  }

		  public function fetchAll_released(){ 
            $sql = "SELECT * FROM  tbl_documentrequest WHERE status = 'Released' ORDER BY date_request DESC";
				$stmt = $this->conn->prepare($sql); 
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;

		  }

		public function edit_request($control_no, $studentID_no, $document_name, $no_ofcopies, $date_request, $date_releasing, $processing_officer, $status, $request_id){
			$sql = "UPDATE `tbl_documentrequest` SET  `control_no` = ?, `studentID_no` = ?, `document_name` = ?, `no_ofcopies` = ?, `date_request` = ?, `date_releasing` = ?, `processing_officer` = ?, `status` = ?  WHERE request_id = ?";
			 $stmt = $this->conn->prepare($sql);
			$stmt->bind_param("ssssssssi", $control_no, $studentID_no, $document_name, $no_ofcopies, $date_request, $date_releasing, $processing_officer, $status, $request_id);
			if($stmt->execute()){
				$stmt->close();
				$this->conn->close();
				return true;
			}
		}

		public function delete_request($request_id){
				$sql = "DELETE FROM tbl_documentrequest WHERE request_id = ?";
				 $stmt = $this->conn->prepare($sql);
				$stmt->bind_param("i", $request_id);
				if($stmt->execute()){
					$stmt->close();
					$this->conn->close();
					return true;
				}
			}

	    public function add_user($complete_name, $desgination, $email_address, $phone_number, $username, $password, $status){
	       $stmt = $this->conn->prepare("INSERT INTO `tbl_usermanagement` (`complete_name`, `desgination`, `email_address`, `phone_number`, `username`, `password`, `status`) VALUES(?, ?, ?, ?, ?, ?, ?)") or die($this->conn->error);
			$stmt->bind_param("sssssss", $complete_name, $desgination, $email_address, $phone_number, $username, $password, $status);
			if($stmt->execute()){
				$stmt->close();
				$this->conn->close();
				return true;
			}
		}

		public function insert_student($studentID_no, $first_name, $middle_name, $last_name, $course, $year_level, $date_ofbirth, $gender, $complete_address, $email_address, $mobile_number, $username, $password) {
			$sql = "INSERT INTO tbl_students (studentID_no, first_name, middle_name, last_name, course, year_level, date_ofbirth, gender, complete_address, email_address, mobile_number, username, password,)
					VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
			$stmt = $this->conn->prepare($sql);
			$stmt->bind_param("sssssssssssss", $studentID_no, $first_name, $middle_name, $last_name, $course, $year_level, $date_ofbirth, $gender, $complete_address, $email_address, $mobile_number, $username, $password);
			return $stmt->execute();
		}
		
		public function fetchAll_user() { 
			$sql = "SELECT * FROM tbl_usermanagement WHERE user_id != ?"; 
			$stmt = $this->conn->prepare($sql); 
			$excluded_user_id = 16; 
			$stmt->bind_param("i", $excluded_user_id); 
			$stmt->execute();
			$result = $stmt->get_result();
			$data = array();
			while ($row = $result->fetch_assoc()) {
				$data[] = $row;
			}
			return $data;
		}
		
		public function fetchAll_allstudent() { 
			$sql = "SELECT * FROM tbl_student"; 
			$stmt = $this->conn->prepare($sql); 
			$stmt->execute();
			$result = $stmt->get_result();
			$data = array();
			while ($row = $result->fetch_assoc()) {
				$data[] = $row;
			}
			return $data;
		}

	    public function edit_user($complete_name, $desgination, $email_address, $phone_number, $username, $password, $status, $user_id){
			$sql = "UPDATE `tbl_usermanagement` SET  `complete_name` = ?, `desgination` = ?, `email_address` = ?, `phone_number` = ?, `username` = ?, `password` = ?, `status` = ?  WHERE user_id = ?";
			 $stmt = $this->conn->prepare($sql);
			$stmt->bind_param("sssssssi", $complete_name, $desgination, $email_address, $phone_number, $username, $password, $status, $user_id);
			if($stmt->execute()){
				$stmt->close();
				$this->conn->close();
				return true;
			}
		}

	   public function delete_user($user_id){
				$sql = "DELETE FROM tbl_usermanagement WHERE user_id = ?";
				 $stmt = $this->conn->prepare($sql);
				$stmt->bind_param("i", $user_id);
				if($stmt->execute()){
					$stmt->close();
					$this->conn->close();
					return true;
				}
			}

	    public function count_numberofstudents(){ 
            $sql = "SELECT COUNT(student_id) as count_students FROM tbl_student";
				$stmt = $this->conn->prepare($sql); 
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;

		  }


		  public function count_allstudents(){ 
            $sql = "SELECT (SELECT COUNT(student_id)  FROM tbl_student) as count_students";
				$stmt = $this->conn->prepare($sql); 
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;

		  }

		  public function count_allregistrar(){ 
            $sql = "SELECT (SELECT COUNT(user_id)  FROM tbl_usermanagement) as count_users";
				$stmt = $this->conn->prepare($sql); 
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;

		  }

	    public function count_numberoftotalrequest(){ 
            $sql = "SELECT COUNT(request_id) as count_request FROM tbl_documentrequest";
				$stmt = $this->conn->prepare($sql); 
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;

		  }

		 public function count_numberoftotalreceived(){ 
            $sql = "SELECT COUNT(request_id) as count_received FROM tbl_documentrequest WHERE status = 'Received'";
				$stmt = $this->conn->prepare($sql); 
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;

		  }

		  public function count_numberofreleased(){ 
            $sql = "SELECT COUNT(request_id) as count_released FROM tbl_documentrequest WHERE status = 'Releasing'";
				$stmt = $this->conn->prepare($sql); 
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;

		  }

		  public function count_released(){ 
            $sql = "SELECT COUNT(request_id) as count_released FROM tbl_documentrequest WHERE status = 'Released'";
				$stmt = $this->conn->prepare($sql); 
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;

		  }
	}	
?>