<?php
require_once('../../../config.php');
require_login();

$term = optional_param('term', '', PARAM_TEXT);

$conn = new mysqli($CFG->dbhost, $CFG->dbuser, $CFG->dbpass, $CFG->dbname);
$conn->set_charset("utf8");

if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}

$sql = "SELECT id,CONCAT(id, ' : ', name) AS name FROM mdl_view_responsible WHERE name LIKE ? OR id LIKE ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $likeTerm, $likeTerm);
$likeTerm = '%' . $term . '%';
$stmt->execute();
$result = $stmt->get_result();

 $responsible = array();
while ($row = $result->fetch_assoc()) {
    $responsible[] = array("id" => $row["id"], "name" => $row["name"]);
} 

echo json_encode($responsible, JSON_UNESCAPED_UNICODE);

$stmt->close();
$conn->close(); 
?>
