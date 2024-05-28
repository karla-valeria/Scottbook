<!-- Karla Rodriguez -->
<?php

class Dbh {
	private $servername;
	private $username;
	private $password;
	private $dbname;

	protected function connect() {
		$this->servername = "localhost";
		$this->username = "root";
		$this->password = "sesame80";
		$this->dbname = "dbphp";

		$conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

		return $conn;
	}

	function query($query) {
		return $this->connect()->query($query);
	}

	function real_escape_string($string) {
		return $this->connect()->real_escape_string($string);
	}
}