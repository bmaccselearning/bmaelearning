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
if(!is_null($department_code) and !empty($department_code) ){$c_where=$c_where." and u.department='".$department_code."'";}
//}else

    if(!is_null($division_code)and !empty($division_code)){$c_where=$c_where." and u.division_code='".$division_code."'";}
//}else if($mode=="sect"){
 
    if(!is_null($section_code)and !empty($section_code)){$c_where=$c_where." and u.section_code='".$section_code."'";}
    

    if(!is_null($job_code)and !empty($job_code)){$c_where=$c_where." and u.job_code='".$job_code."'";}

/*$sql = "SELECT u.id,u.username,u.firstname,u.lastname,
(select work_line_name from view_users_work_line w where w.work_line_code=v.work_line_code)work_line_code,
(select admin_name from view_users_admins a where a.admin_code=v.admin_code)admin_code,
(select mp_cee_name from view_users_mp_cee m where m.mp_ce_code=v.mp_cee)mp_cee,
concat(v.pos_num_name,' ',v.pos_num_code) pos_num_code,
t.department_code,department_name,b.division_code,b.division_name,c.section_code,c.section_name,d.job_code,d.job_name
FROM view_users_department t,view_users_division B,view_users_section c,view_users_job d,mdl_user u,view_users v
where b.department_code=t.department_code
and b.department_code=c.department_code
and b.division_code=c.division_code
  and c.department_code=d.department_code
and c.division_code=d.division_code
and c.section_code=d.section_code 
and t.department_code=v.department_code
and b.department_code=v.department_code
and b.division_code=v.division_code
and c.department_code=v.department_code
and c.division_code=v.division_code
and c.section_code=v.section_code
and d.department_code=v.department_code
and d.division_code=v.division_code
and d.section_code=v.section_code
and d.job_code=v.job_code
and v.ID_CARD=U.USERNAME  "
.$c_where.
"  order by t.department_code,b.division_code ,c.section_code,d.job_code" ;
*/
$sql = "SELECT u.id,u.username,u.firstname,u.lastname,
(select work_line_name from view_users_work_line w where w.work_line_code=u.work_line_code)work_line_code,
(select admin_name from view_users_admin a where a.admin_code=u.admin_code)admin_code,
(select mp_cee_name from view_users_mp_cee m where m.mp_cee_code=u.mp_cee_code)mp_cee
,
 u.pos_num_name pos_num_code,
t.department_code,department_name,b.division_code,b.division_name,c.section_code,c.section_name,d.job_code,d.job_name
FROM view_users_department t,view_users_division B,view_users_section c,view_users_job d,mdl_user u
where b.department_code=t.department_code
and b.department_code=c.department_code
and b.division_code=c.division_code
and c.department_code=d.department_code
and c.division_code=d.division_code
and c.section_code=d.section_code
and t.department_code=u.department
and b.department_code=u.department
and b.division_code=u.division_code
and c.department_code=u.department
and c.division_code=u.division_code
and c.section_code=u.section_code
and d.department_code=u.department
and d.division_code=u.division_code
and d.section_code=u.section_code
and d.job_code=u.job_code "
.$c_where.
"   order by t.department_code,b.division_code";
$departmentFilter = $DB->get_records_sql($sql, $params);
//echo $sql;
$xml = new SimpleXMLElement("<user_table/>");
foreach ($departmentFilter as $departmentFt) {
    $track = $xml->addChild('USER_ROW');
    $track->addChild('USERNAME', $departmentFt->username);
    $track->addChild('FIRSTNAME', $departmentFt->firstname);
    $track->addChild('LASTNAME', $departmentFt->lastname);
    $track->addChild('WORK_LINE_CODE', $departmentFt->work_line_code);
    $track->addChild('DEPARTMENT_CODE', $departmentFt->department_code);
    $track->addChild('DEPARTMENT_NAME', $departmentFt->department_name);
    $track->addChild('DIVISION_CODE', $departmentFt->division_code);
    $track->addChild('DIVISION_NAME', $departmentFt->division_name);
    $track->addChild('SECTION_CODE', $departmentFt->section_code);
    $track->addChild('SECTION_NAME', $departmentFt->section_name);
    $track->addChild('JOB_CODE', $departmentFt->job_code);
    $track->addChild('JOB_NAME', $departmentFt->job_name);
    $track->addChild('ADMIN_CODE', $departmentFt->admin_code);
    $track->addChild('MP_CEE', $departmentFt->mp_cee);
    $track->addChild('POS_NUM_CODE', $departmentFt->pos_num_code);
    $track->addChild('ID', $departmentFt->id);

}
print($xml->asXML());
//echo $sql;
