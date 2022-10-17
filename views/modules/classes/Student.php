<?php
require_once 'connection.php';
class Student {
	private $id;
	private $lname;
	private $fname;
	private $mi;
	private $address;
	private $progcode;

	private function getStudentData(){
			$this->lname = $_POST["txtLname"];
			$this->fname = $_POST["txtFname"];
			$this->mi = $_POST["txtMi"];
			$this->address = $_POST["txtAddress"];
			$this->progcode = $_POST["txtProgcode"];
	}

	public function addStudent(){
		if((isset($_POST["txtLname"]))&&(isset($_POST["txtFname"]))&&(isset($_POST["txtMi"]))){
			$this->getStudentData();
			$stmt = (new Connection)->connect()->prepare("INSERT INTO student(lname, fname, mi, address, progcode) VALUES (:lname, :fname, :mi, :address, :progcode)");

			$stmt->bindParam(":lname", $this->lname, PDO::PARAM_STR);
			$stmt->bindParam(":fname", $this->fname, PDO::PARAM_STR);
			$stmt->bindParam(":mi", $this->mi, PDO::PARAM_STR);
			$stmt->bindParam(":address", $this->address, PDO::PARAM_STR);
			$stmt->bindParam(":progcode", $this->progcode, PDO::PARAM_STR);

			if($stmt->execute()){
				return "ok";
			}else{
				return "error";
			}
			$stmt->close();
		}
	}

	public function showStudentList(){
		$stmt = (new Connection)->connect()->prepare("SELECT * FROM student ORDER BY lname, fname");
		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt -> close();
		$stmt = null;
	}

	public function getStudentInfo($item, $value){
		$stmt = (new Connection)->connect()->prepare("SELECT * FROM student WHERE $item = :$item");
		$stmt -> bindParam(":".$item, $value, PDO::PARAM_INT);
		$stmt -> execute();
			return $stmt -> fetch();
		$stmt -> close();
		$stmt = null;
	}	

	public function editStudent(){
		if(!empty($_POST["student_id"])){
			$this->getStudentData();
			$stmt = (new Connection)->connect()->prepare("UPDATE student SET lname = :lname, fname = :fname, mi = :mi, address = :address, progcode = :progcode WHERE id = :id");

			$stmt->bindParam(":id", $_POST["numId"], PDO::PARAM_INT);
	        $stmt->bindParam(":lname", $this->lname, PDO::PARAM_STR);
			$stmt->bindParam(":fname", $this->fname, PDO::PARAM_STR);
			$stmt->bindParam(":mi", $this->mi, PDO::PARAM_STR);
			$stmt->bindParam(":address", $this->address, PDO::PARAM_STR);
			$stmt->bindParam(":progcode", $this->progcode, PDO::PARAM_STR);

			if($stmt->execute()){
				return "ok";
			}else{
				return "error";
			}
			$stmt->close();
			$stmt = null;
		}
	}

	public function deleteStudent() {
		try {
			$stmt = (new Connection)->connect();
			$deleteId = isset($_POST["numId"]) ? $_POST["numId"]: '';
			$deleteStmt = "DELETE FROM student WHERE id = $deleteId";
			$stmt->exec($deleteStmt);
			return "ok";
		} catch (PDOException $e){
			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

}