<?php
	include_once('database.php');

	class course extends Database{
		function __construct($id) {
			$sql = "SELECT * FROM courses WHERE id = $id;";
			$statement = Database::$db->prepare($sql);
			$statement->execute();
			$data = $statement->fetch(PDO::FETCH_ASSOC);
			if(empty($data)){return;}
			foreach ($data as $key => $value) {
				$this->{$key} = $value;
			}
		}

		public static function add($Name,$max_degree,$study_year) {
			$sql = "INSERT INTO courses (Name , max_degree ,study_year ) VALUES ('Name' , '$max_degree' , '$study_year')";
			Database::$db->prepare($sql)->execute([$Name,$study_year,$study_year]);
			}
		
		public function delete() {
			$sql = "DELETE FROM courses WHERE id = $this->id;";
			Database::$db->query($sql);
		}

		public function save() {
			$sql = "UPDATE courses SET Name = ? WHERE id = ?;";
			Database::$db->prepare($sql)->execute([$this->Name, $this->id]);
			$sql = "UPDATE courses SET max_degree = ? WHERE id = ?;";
			Database::$db->prepare($sql)->execute([$this->max_degree, $this->id]);
			$sql = "UPDATE courses SET study_year = ? WHERE id = ?;";
			Database::$db->prepare($sql)->execute([$this->study_year, $this->id]);
		}

		public static function all($keyword) {
			$keyword = str_replace(" ", "%", $keyword);
			$sql = "SELECT * FROM courses WHERE Name like ('%$keyword%');";
			$statement = Database::$db->prepare($sql);
			$statement->execute();
			$courses = [];
			while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
				$courses[] = new course($row['id']);
			}
			return $courses;
		}
	}
?>