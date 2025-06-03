<?php
 $conn = new mysqli("localhost", "root", "", "dzbanyv2db");
 if ($conn->connect_error) {
 exit("Connection failed: " . $conn->connect_error);
 }
?>