<?php
require_once 'connection.php';
class Location	{
	private $id;
	private $longitude;
	private $latitude;

	private function getCoordinates(){
			$this->longitude = $_POST["coordLong"];
			$this->latitude = $_POST["coordLat"];
	}

	public function addCoordinates(){
		if((isset($_POST["coordLong"]))&&(isset($_POST["coordLat"]))){
			$this->getCoordinates();
			$stmt = (new Connection)->connect()->prepare("INSERT INTO coordinates(coordLong, coordLat) VALUES (:coordLong, :coordLat)");

			$stmt->bindParam(":coordLong", $this->longitude, PDO::PARAM_STR);
			$stmt->bindParam(":coordLat", $this->latitude, PDO::PARAM_STR);

			if($stmt->execute()){
				return "ok";
			}else{
				return "error";
			}
			$stmt->close();
		}
	}

	public function showCoordList(){
		$stmt = (new Connection)->connect()->prepare("SELECT * FROM coordinates ORDER BY coordLong, coordLat");
		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt -> close();
		$stmt = null;
	}

	public function getCoordInfo($item, $value){
		$stmt = (new Connection)->connect()->prepare("SELECT * FROM coordinates WHERE $item = :$item");
		$stmt -> bindParam(":".$item, $value, PDO::PARAM_INT);
		$stmt -> execute();
			return $stmt -> fetch();
		$stmt -> close();
		$stmt = null;
	}	
					
}