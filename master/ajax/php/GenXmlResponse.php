<?php
require_once(__DIR__ . '/../../../config.php');
header("Access-Control-Allow-Origin: *");
header("Content-type: text/xml; charset=utf-8");



$department_code=$_REQUEST["department_code"];

global $DB, $CFG;

$sql = "SELECT * from view_users_division where department_code='50' order by division_code ";


$departmentFilter = $DB->get_records_sql($sql, $params);

$xml = new SimpleXMLElement("<division_table/>");
foreach ($departmentFilter as $departmentFt) {
    $track = $xml->addChild('DIVISION_ROW');
    $track->addChild('DEPARTMENT_CODE', $departmentFt->department_code);
    $track->addChild('DIVISION_CODE', $departmentFt->division_code);
    $track->addChild('DIVISION_NAME', $departmentFt->division_name);

}
print($xml->asXML());
