<?php
require_once('../config.php');
require_login();

// รับค่า strategic_id จาก AJAX request
$strategic_id = $_GET['strategic_id'];

// สร้างการเชื่อมต่อ
$conn = new mysqli($CFG->dbhost, $CFG->dbuser, $CFG->dbpass, $CFG->dbname);
$conn->set_charset("utf8");
// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}


//$strategic_id = 2;
// คิวรี่ข้อมูล strategic_sub ตาม strategic_id ที่รับมา
$sql = "SELECT id, name FROM mdl_strategic_sub WHERE strategic_id = $strategic_id";
$result = $conn->query($sql);

// ส่งข้อมูล strategic_sub กลับเป็น JSON
$subplans = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $subplans[] = array("id" => $row["id"], "name" => $row["name"]);
    }
}
echo json_encode($subplans, JSON_UNESCAPED_UNICODE);


$conn->close(); 



?>
