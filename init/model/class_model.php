	<?php

	require 'config/connection.php';

	class class_model {

		public $host = db_host;
		public $user = db_user;
		public $pass = db_pass;
		public $dbname = db_name;
		public $conn;
		public $error;

		public function __construct() {
			$this->connect();
		}

		private function connect() {
			$this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
			if (!$this->conn) {
				$this->error = "Fatal Error: Can't connect to database" . $this->conn->connect_error;
				return false;
			}
		}

		public function login_student($username, $password) {
			$stmt = $this->conn->prepare("SELECT * FROM `tbl_student` WHERE `username` = ?") or die($this->conn->error);
			$stmt->bind_param("s", $username);

			if ($stmt->execute()) {
				$result = $stmt->get_result();
				$valid = $result->num_rows;
				$fetch = $result->fetch_array();

				if ($valid > 0) {

					if ($fetch['account_status'] == 'Inactive') {
						return array(
							'student_id' => htmlentities($fetch['student_id']),
							'count' => $valid,
							'status' => 'inactive'
						);
					} else {

						if ($fetch['password'] == $password) {
							return array(
								'student_id' => htmlentities($fetch['student_id']),
								'count' => $valid,
								'status' => 'active'
							);
						}
					}
				}
			}
			return array('count' => 0);
		}

		public function student_account($student_id) {
			$stmt = $this->conn->prepare("SELECT * FROM `tbl_student` WHERE `student_id` = ?") or die($this->conn->error);
			$stmt->bind_param("i", $student_id);
			if ($stmt->execute()) {
				$result = $stmt->get_result();
				$fetch = $result->fetch_array();
				return array(
					'first_name' => $fetch['first_name'],
					'last_name' => $fetch['last_name'],
					'email_address' => $fetch['email_address'],
				);
			}
		}

		public function student_profile($student_id) {
			$stmt = $this->conn->prepare("SELECT * FROM `tbl_student` WHERE `student_id` = ?") or die($this->conn->error);
			$stmt->bind_param("i", $student_id);
			if ($stmt->execute()) {
				$result = $stmt->get_result();
				$fetch = $result->fetch_array();
				return array(
					'student_id' => $fetch['student_id'],
					'studentID_no' => $fetch['studentID_no'],
					'first_name' => $fetch['first_name'],
					'middle_name' => $fetch['middle_name'],
					'last_name' => $fetch['last_name'],
					'course' => $fetch['course'],
					'gender' => $fetch['gender'],
					'year_level' => $fetch['year_level'],
					'email_address' => $fetch['email_address'],
					'complete_address' => $fetch['complete_address'],
					'mobile_number' => $fetch['mobile_number'],
					'username' => $fetch['username'],
					'password' => $fetch['password'],
					'date_created' => $fetch['date_created']
				);
			}
		}

		public function fetchAll_documentrequest($student_id) {
			$sql = "SELECT * FROM tbl_documentrequest WHERE `student_id` = ?";
			$stmt = $this->conn->prepare($sql);
			$stmt->bind_param("i", $student_id);
			$stmt->execute();
			$result = $stmt->get_result();
			$data = array();
			while ($row = $result->fetch_assoc()) {
				$data[] = $row;
			}
			return $data;
		}

		public function fetchAll_pendingrequest($student_id) {
			$sql = "SELECT * FROM tbl_documentrequest WHERE `student_id` = ? AND status = 'Received'";
			$stmt = $this->conn->prepare($sql);
			$stmt->bind_param("i", $student_id);
			$stmt->execute();
			$result = $stmt->get_result();
			$data = array();
			while ($row = $result->fetch_assoc()) {
				$data[] = $row;
			}
			return $data;
		}

		public function fetchAll_processing($student_id) {
			$sql = "SELECT * FROM tbl_documentrequest WHERE `student_id` = ? AND status = 'Processing'";
			$stmt = $this->conn->prepare($sql);
			$stmt->bind_param("i", $student_id);
			$stmt->execute();
			$result = $stmt->get_result();
			$data = array();
			while ($row = $result->fetch_assoc()) {
				$data[] = $row;
			}
			return $data;
		}

		public function fetchAll_releaseddocument($student_id) {
			$sql = "SELECT * FROM tbl_documentrequest WHERE `student_id` = ? AND status = 'Releasing'";
			$stmt = $this->conn->prepare($sql);
			$stmt->bind_param("i", $student_id);
			$stmt->execute();
			$result = $stmt->get_result();
			$data = array();
			while ($row = $result->fetch_assoc()) {
				$data[] = $row;
			}
			return $data;
		}

		public function count_numberofstudents() {
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

		public function count_numberoftotalrequest() {
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

		public function count_numberoftotalreceived($student_id) {
			$sql = "SELECT COUNT(request_id) as count_received FROM tbl_documentrequest WHERE student_id = ? AND status = 'Received'";
			$stmt = $this->conn->prepare($sql);
			$stmt->bind_param("i", $student_id);
			$stmt->execute();
			$result = $stmt->get_result();
			$data = array();
			while ($row = $result->fetch_assoc()) {
				$data[] = $row;
			}
			return $data;
		}

		public function processing_status($student_id) {
			$sql = "SELECT COUNT(request_id) as count_processing FROM tbl_documentrequest WHERE student_id = ? AND status = 'Processing'";
			$stmt = $this->conn->prepare($sql);
			$stmt->bind_param("i", $student_id);
			$stmt->execute();
			$result = $stmt->get_result();
			$data = array();
			while ($row = $result->fetch_assoc()) {
				$data[] = $row;
			}
			return $data;
		}

		public function count_numberofreleased($student_id) {
			$sql = "SELECT COUNT(request_id) as count_released FROM tbl_documentrequest WHERE student_id = ? AND status = 'Releasing'";
			$stmt = $this->conn->prepare($sql);
			$stmt->bind_param("i", $student_id);
			$stmt->execute();
			$result = $stmt->get_result();
			$data = array();
			while ($row = $result->fetch_assoc()) {
				$data[] = $row;
			}
			return $data;
		}

		public function count_numberofreleased2($student_id) {
			$sql = "SELECT COUNT(request_id) as count_released FROM tbl_documentrequest WHERE student_id = ? AND status = 'Released'";
			$stmt = $this->conn->prepare($sql);
			$stmt->bind_param("i", $student_id);
			$stmt->execute();
			$result = $stmt->get_result();
			$data = array();
			while ($row = $result->fetch_assoc()) {
				$data[] = $row;
			}
			return $data;
		}

		public function change_username($username, $student_id) {
			$sql = "UPDATE `tbl_student` SET `username` = ? WHERE student_id = ?";
			$stmt = $this->conn->prepare($sql);
			$stmt->bind_param("si", $username, $student_id);
			if ($stmt->execute()) {
				$stmt->close();
				$this->conn->close();
				return true;
			}
		}

		public function change_password($password, $student_id) {
			$sql = "UPDATE `tbl_student` SET `password` = ? WHERE student_id = ?";
			$stmt = $this->conn->prepare($sql);
			$stmt->bind_param("si", $password, $student_id);
			if ($stmt->execute()) {
				$stmt->close();
				$this->conn->close();
				return true;
			}
		}

		public function change_email_address($email_address, $student_id) {
			$sql = "UPDATE `tbl_student` SET `email_address` = ? WHERE student_id = ?";
			$stmt = $this->conn->prepare($sql);
			$stmt->bind_param("si", $email_address, $student_id);
			if ($stmt->execute()) {
				$stmt->close();
				$this->conn->close();
				return true;
			}
		}

		public function change_mobile_number($mobile_number, $student_id) {
			$sql = "UPDATE `tbl_student` SET `mobile_number` = ? WHERE student_id = ?";
			$stmt = $this->conn->prepare($sql);
			$stmt->bind_param("si", $mobile_number, $student_id);
			if ($stmt->execute()) {
				$stmt->close();
				$this->conn->close();
				return true;
			}
		}

		public function update_profile($username, $password, $mobile_number, $email_address, $student_id) {
			$sql = "UPDATE `tbl_student` SET `username` = ?, `password` = ?, `mobile_number` = ?, `email_address` = ? WHERE student_id = ?";
			$stmt = $this->conn->prepare($sql);
			$stmt->bind_param("ssssi", $username, $password, $mobile_number, $email_address, $student_id);
			if ($stmt->execute()) {
				$stmt->close();
				$this->conn->close();
				return true;
			}
		}

		public function add_request($control_no, $studentID_no, $email_address, $document_name, $no_ofcopies, $date_request, $received, $student_id) {
			$stmt = $this->conn->prepare("INSERT INTO `tbl_documentrequest` (`control_no`, `studentID_no`, `document_name`, `no_ofcopies`, `date_request`, `status`, `student_id`) VALUES(?, ?, ?, ?, ?, ?, ?)") or die($this->conn->error);
			$stmt->bind_param("sssssss", $control_no, $studentID_no, $document_name, $no_ofcopies, $date_request, $received, $student_id);
			if ($stmt->execute()) {
				$stmt->close();
				$this->conn->close();
				return true;
			}
		}

		public function edit_request($control_no, $studentID_no, $document_name, $no_ofcopies, $date_request, $request_id) {
			$sql = "UPDATE `tbl_documentrequest` SET `control_no` = ?, `studentID_no` = ?, `document_name` = ?, `no_ofcopies` = ?, `date_request` = ? WHERE request_id = ?";
			$stmt = $this->conn->prepare($sql);
			$stmt->bind_param("sssssi", $control_no, $studentID_no, $document_name, $no_ofcopies, $date_request, $request_id);
			if ($stmt->execute()) {
				$stmt->close();
				$this->conn->close();
				return true;
			}
		}

		public function delete_request($request_id) {
			$sql = "DELETE FROM tbl_documentrequest WHERE request_id = ?";
			$stmt = $this->conn->prepare($sql);
			$stmt->bind_param("i", $request_id);
			if ($stmt->execute()) {
				$stmt->close();
				$this->conn->close();
				return true;
			}
		}
	}
	?>
