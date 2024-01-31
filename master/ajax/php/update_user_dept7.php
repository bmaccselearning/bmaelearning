<?php
require_once(__DIR__ . '/../../../config.php');
global $DB, $CFG;
for ($i=50001; $i<=50936; $i++) {
    $sql="update mdl_user t
    inner join view_users B on b.ID_CARD=t.username
    set t.department =b.DEPARTMENT_CODE ,
    t.division_code= b.DIVISION_CODE ,
    t.section_code=  b.section_code ,
    t.job_code = b.job_code 
     where id ='".$i."'";
    $ok = $DB->execute($sql, $params);
    if($ok){echo "ok".$i;}else{echo "non".$i;}
  
    
}