<?php
require_once(__DIR__ . '/../../../config.php');
header("Access-Control-Allow-Origin: *");
header("Content-type: text/xml; charset=utf-8");

 
 
global $DB, $CFG;
 

$sql = "SELECT mp_cee_code,mp_cee_name,mp_cee_type,mp_cee_position FROM `view_users_mp_cee`;" ;

$wlrs = $DB->get_records_sql($sql, $params);

$xml = new SimpleXMLElement("<mp_cee_table/>");
foreach ($wlrs as $record) {
    $track = $xml->addChild('ROW');
   
    $track->addChild('MP_CEE_CODE', $record->mp_ce_code);
    $track->addChild('MP_CEE_NAME', $record->mp_cee_name);
    $track->addChild('MP_CEE_TYPE', $record->mp_cee_type);
    $track->addChild('MP_CEE_POSITION', $record->mp_cee_position);

}
print($xml->asXML());
//echo $sql;
