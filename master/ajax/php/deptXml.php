<?php
require_once(__DIR__ . '/../../../config.php');
header("Access-Control-Allow-Origin: *");
header("Content-type: text/xml; charset=utf-8");

$department_code="";
$division_code="";
$section_code="";
$job_code="";

if(isset($_REQUEST["department_code"])){
$department_code=$_REQUEST["department_code"];
}
if(isset($_REQUEST["division_code"])){
$division_code=$_REQUEST["division_code"];
}
if(isset($_REQUEST["section_code"])){
$section_code=$_REQUEST["section_code"];
}
if(isset($_REQUEST["job_code"])){
$job_code=$_REQUEST["job_code"];
}
global $DB, $CFG;
$c_where ="";
//if($mode=="dept"){
if(!is_null($department_code) and !empty($department_code) ){$c_where=$c_where." and d.department_code='".$department_code."'";}
//}else

    if(!is_null($division_code)and !empty($division_code)){$c_where=$c_where." and d.division_code='".$division_code."'";}
//}else if($mode=="sect"){
 
    if(!is_null($section_code)and !empty($section_code)){$c_where=$c_where." and d.section_code='".$section_code."'";}
    

    if(!is_null($job_code)and !empty($job_code)){$c_where=$c_where." and d.job_code='".$job_code."'";}

$sql = "SELECT CONCAT(t.department_code,b.division_code,c.section_code,d.job_code) job_id,t.department_code,department_name,b.division_code,b.division_name,c.section_code,c.section_name,d.job_code,d.job_name
FROM view_users_department t,view_users_division B,view_users_section c,view_users_job d
where b.department_code=t.department_code
and b.department_code=c.department_code
and b.division_code=c.division_code
  and c.department_code=d.department_code
and c.division_code=d.division_code
and c.section_code=d.section_code "
.$c_where.
"  order by t.department_code,b.division_code ,c.section_code,d.job_code" ;

$departmentFilter = $DB->get_records_sql($sql, $params);

$xml = new SimpleXMLElement("<division_table/>");
foreach ($departmentFilter as $departmentFt) {
    $track = $xml->addChild('DIVISION_ROW');
   
    $track->addChild('DEPARTMENT_CODE', $departmentFt->department_code);
    $track->addChild('DEPARTMENT_NAME', $departmentFt->department_name);
    $track->addChild('DIVISION_CODE', $departmentFt->division_code);
    $track->addChild('DIVISION_NAME', $departmentFt->division_name);
    $track->addChild('SECTION_CODE', $departmentFt->section_code);
    $track->addChild('SECTION_NAME', $departmentFt->section_name);
    $track->addChild('JOB_CODE', $departmentFt->job_code);
    $track->addChild('JOB_NAME', $departmentFt->job_name);

}
print($xml->asXML());
//echo $sql;
