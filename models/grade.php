<?php
	include_once('database.php');

	class grade extends Database{
		function __construct($id) {
			$sql = "SELECT * FROM grades WHERE id = $id;";
			$statement = Database::$db->prepare($sql);
			$statement->execute();
			$data = $statement->fetch(PDO::FETCH_ASSOC);
			if(empty($data)){return;}
			foreach ($data as $key => $value) {
				$this->{$key} = $value;
			}
		}

		public static function add($student_id, $course_id, $degree, $examined_at) {
			$sql = "INSERT INTO grades (student_id, course_id, degree, examined_at) VALUES ('$student_id', '$course_id', '$degree', '$examined_at')";
			Database::$db->prepare($sql)->execute([$student_id, $course_id, $degree, $examined_at]);
		}

		public function delete() {
			$sql = "DELETE FROM grades WHERE id = $this->id;";
			Database::$db->query($sql);
		}

		public function save() {
			$sql = "UPDATE grades SET student_id = ? WHERE id = ?;";
			Database::$db->prepare($sql)->execute([$this->student_id, $this->id]);
			$sql = "UPDATE grades SET course_id = ? WHERE id = ?;";
			Database::$db->prepare($sql)->execute([$this->course_id, $this->id]);
			$sql = "UPDATE grades SET degree = ? WHERE id = ?;";
			Database::$db->prepare($sql)->execute([$this->degree, $this->id]);
			$sql = "UPDATE grades SET examined_at = ? WHERE id = ?;";
			Database::$db->prepare($sql)->execute([$this->examined_at, $this->id]);
		}

		public static function all($keyword) {
			$keyword = str_replace(" ", "%", $keyword);
			$sql = "SELECT * FROM grades WHERE degree like ('%$keyword%');";
			//$sql = "SELECT grades.degree ,courses.name,students.name FROM `grades` INNER JOIN courses ON grades.course_id = courses.id INNER JOIN students ON grades.student_id = students.id";
			
			$statement = Database::$db->prepare($sql);
			$statement->execute();
			$grades = [];
			while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
				$grades[] = new grade($row['id']);
			}
			return $grades;
		}
		public static function all_all($keyword) {
			$keyword = str_replace(" ", "%", $keyword);
			$sql = "SELECT grades.degree ,grades.id,courses.name,students.name FROM `grades` INNER JOIN 
			courses ON grades.course_id = courses.id INNER JOIN students ON grades.student_id = students.id 
			where students.name like or courses.name('%$keyword%')";
			$statement = Database::$db->prepare($sql);
			$statement->execute();	
			$grades = [];
			while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
				$grades[] = new grade($row['id']);
			}
			return $grades;
			}
	}
?>
