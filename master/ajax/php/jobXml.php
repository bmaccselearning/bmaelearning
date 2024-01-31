<?php
require_once(__DIR__ . '/../../../config.php');
header("Access-Control-Allow-Origin: *");
header("Content-type: text/xml; charset=utf-8");



$department_code=$_REQUEST["department_code"];
$division_code=$_REQUEST["division_code"];
$section_code=$_REQUEST["section_code"];

global $DB, $CFG;

$sql = "SELECT * from view_users_job where department_code='".$department_code."' and division_code='".$division_code."' and section_code='".$section_code."'  order by division_code ";


$departmentFilter = $DB->get_records_sql($sql, $params);

$xml = new SimpleXMLElement("<division_table/>");
foreach ($departmentFilter as $departmentFt) {
    $track = $xml->addChild('DIVISION_ROW');
    $track->addChild('JOB_CODE', $departmentFt->job_code);
    $track->addChild('JOB_NAME', $departmentFt->job_name);
    $track->addChild('DEPARTMENT_CODE', $departmentFt->department_code);
    $track->addChild('DIVISION_CODE', $departmentFt->division_code);
    $track->addChild('SECTION_CODE', $departmentFt->section_code);

}
print($xml->asXML());
