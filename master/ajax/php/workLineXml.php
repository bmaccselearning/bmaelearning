<?php
require_once(__DIR__ . '/../../../config.php');
header("Access-Control-Allow-Origin: *");
header("Content-type: text/xml; charset=utf-8");

$work_line_code="";
 
if(isset($_REQUEST["work_line_code"])){
$work_line_code=$_REQUEST["work_line_code"];
}
 
global $DB, $CFG;
 

$sql = "SELECT work_line_code,work_line_name FROM `view_users_work_line` order by work_line_code;" ;

$wlrs = $DB->get_records_sql($sql, $params);

$xml = new SimpleXMLElement("<work_line_table/>");
foreach ($wlrs as $record) {
    $track = $xml->addChild('WORK_LINE_ROW');
   
    $track->addChild('WORK_LINE_CODE', $record->work_line_code);
    $track->addChild('WORK_LINE_NAME', $record->work_line_name);


}
print($xml->asXML());
//echo $sql;
