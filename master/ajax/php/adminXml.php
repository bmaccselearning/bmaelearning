<?php
require_once(__DIR__ . '/../../../config.php');
header("Access-Control-Allow-Origin: *");
header("Content-type: text/xml; charset=utf-8");

 
 
global $DB, $CFG;
 

$sql = "SELECT   `ADMIN_CODE`, `ADMIN_NAME`,'' ADMIN_SHORT_NAME FROM `view_users_admin` order by admin_code" ;

$wlrs = $DB->get_records_sql($sql, $params);

$xml = new SimpleXMLElement("<admin_table/>");
foreach ($wlrs as $record) {
    $track = $xml->addChild('ROW');
   
    $track->addChild('ADMIN_CODE', $record->admin_code);
    $track->addChild('ADMIN_NAME', $record->admin_name);
    $track->addChild('ADMIN_SHORT_NAME', $record->admin_short_name);
    

}
print($xml->asXML());
//echo $sql;
