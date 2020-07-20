<?php
class database {
    public $connection;
    public function __construct() {
        $this->connection = mysqli_connect("localhost", "root", "", "regdetail");
        if (! $this->connection) {
        die("Connection failed: " . mysqli_connect_error());
        }
    }
}
?>