<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * My Moodle -- a user's personal dashboard
 *
 * - each user can currently have their own page (cloned from system and then customised)
 * - only the user can see their own dashboard
 * - users can add any blocks they want
 * - the administrators can define a default site dashboard for users who have
 *   not created their own dashboard
 *
 * This script implements the user's view of the dashboard, and allows editing
 * of the dashboard.
 *
 * @package    moodlecore
 * @subpackage my
 * @copyright  2010 Remote-Learner.net
 * @author     Hubert Chathi <hubert@remote-learner.net>
 * @author     Olav Jordan <olav.jordan@remote-learner.net>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


require_once(__DIR__ . '/../config.php');
require_once($CFG->dirroot . '/my/lib.php');


redirect_if_major_upgrade_required();

$department_code=$_REQUEST["department_code"];
$division_code=$_REQUEST["division_code"];
$division_name_new=$_REQUEST["division_name"];
 
$mode=$_REQUEST["mode"];
$returnurl = new moodle_url('/master/EditDivision.php');
// TODO Add sesskey check to edit
global $DB, $CFG;


//$sql = "SELECT * from department_code where department_code='".$department_code."' ";
//$department_record = $DB->get_record("users_department", ['DEPARTMENT_CODE' => $department_code]);



require_login();
$PAGE->set_title('บันทึกส่วนราชการของกรุงเทพมหานคร');
$PAGE->set_heading($site->fullname);
echo $OUTPUT->header();


//echo "sql:".$sql;
 //echo "</br>department_code:".$department_code;
// echo "</br>department_name:".$department_name_new;
 //echo "</br>mode:".$mode;

 //$department_record = new stdclass;

 $int_dept = $department_code;
 if($mode=="save")
 {
  // $department_record = $DB->get_record('users_department', array('DEPARTMENT_CODE' => $int_dept), '*', MUST_EXIST);
  $department_record=new stdClass(); 
 
   //  departmentFilter
    //$department_record->department_name = $department_name_new;
  //  print_r($department_record);
   // print_r($department_record);
  // echo "update department_name_new";
   $sql="update view_users_division set division_name='".$division_name_new."' where department_code='".$department_code."' and division_code='".$division_code."'";
   //echo "</br>sql:".$sql;
   $rs= $DB->execute($sql);
   if(!$rs){
    //echo "</br>error";
   }else{
    //echo "</br>complete";
   }
   

 }

 $sql = "SELECT * from view_users_division where department_code='".$department_code."'  and division_code='".$division_code."'";
// echo "</br>sql:".$sql;
$departmentFilter = $DB->get_records_sql($sql, $params);
//$department_name=$_REQUEST["department_name"];
//if(empty($department_code)){$department_code="";}
//$division_code=$_REQUEST["division_code"];
//if(empty($division_code)){$division_code="";}
////$section_code=$_REQUEST["section_code"];
//if(empty($section_code)){$section_code="";}
//$job_code=$_REQUEST["job_code"];
//if(empty($job_code)){$job_code="";}
//$mode=$_REQUEST["mode"];
//echo "aa</br>";
//echo "dept: ".$departmentFilter->department_code;
echo "<h3>แก้ไขหน่วยงานของกรุงเทพมหานคร</h3>";

echo "<form name='formdep' id='formdep' method='POST' action=''>";

//echo "department_code:".$department_code;
echo "<input type='hidden' id='mode' name='mode' value='".$mode."'/>";
//echo "<div class='row'><div class='column'>หน่วยงาน </div><div class='column'><select name='department_code' class='custom-select' onchange='document.getElementById(\"mode\").value=\"dept\";document.forms[0].submit();'>".$strDept."</select></div></div>";

//document.getElementsByName('division_code').selectedIndex=0;document.getElementsByName('section_code').selectedIndex=0;document.getElementsByName('job_code').selectedIndex=0;
// echo "<div class='form-group row fitem'><div class='col-md-3 col-form-label d-flex pb-0 pr-md-0'>หน่วยงาน </div><div class='column'><select name='department_code' class='custom-select' onchange='document.getElementById(\"mode\").value=\"dept\";document.forms[0].submit();'>".$strDept."</select></div></div>";
// echo "<div class='form-group row fitem'><div class='col-md-3 col-form-label d-flex pb-0 pr-md-0'>สำนักงานเขต/ส่วนราชการ</div> <div class='column'><select id='division_code' name='division_code' class='custom-select'  onchange='document.getElementById(\"mode\").value=\"divi\";document.forms[0].submit();'>".$strDivi."</select></div></div>";
// echo "<div class='form-group row fitem'><div class='col-md-3 col-form-label d-flex pb-0 pr-md-0'>ฝ่าย/กลุ่ม </div><div class='column'><select name='section_code' class='custom-select'  onchange='document.getElementById(\"mode\").value=\"sect\";document.forms[0].submit();'>".$strSect."</select></div></div>";
// echo "<div class='form-group row fitem'><div class='col-md-3 col-form-label d-flex pb-0 pr-md-0'>งาน </div><div class='column'><select name='job_code' class='custom-select'  onchange='document.getElementById(\"mode\").value=\"job\";document.forms[0].submit();'> ".$strJob."</select></div></div>";
// echo "<div class='form-group row fitem'><div class='col-md-3 col-form-label d-flex pb-0 pr-md-0'> </div><div class='column'><input type='button' name='search' value='ค้นหา' class='btn btn-primary'/>";
foreach ($departmentFilter as $departmentFt) {
echo "<div class='form-group row fitem'><div class='col-md-3 col-form-label d-flex pb-0 pr-md-0'>รหัสหน่วยงาน </div><div><input class='form-control' type='text' size='5' name='department_code' value='".$departmentFt->department_code."' readonly=”readonly”/></div></div>";
echo "<div class='form-group row fitem'><div class='col-md-3 col-form-label d-flex pb-0 pr-md-0'>รหัสส่วนราชการ </div><div><input class='form-control' type='text' size='5' name='division_code' value='".$departmentFt->division_code."' readonly=”readonly”/></div></div>";
echo "<div class='form-group row fitem'><div class='col-md-3 col-form-label d-flex pb-0 pr-md-0'>ชื่อส่วนราชการ </div><div><input class='form-control' type='text'size='100'  name='division_name' value='".$departmentFt->division_name."' /></div></div>";
}
echo "<div class='form-group row fitem'><div class='col-md-3 col-form-label d-flex pb-0 pr-md-0'> </div><div><input type='button'  name='submittype' value='บันทึก' class='btn btn-primary' onclick='document.getElementById(\"formdep\").mode.value=\"save\";document.getElementById(\"formdep\").submit();'/></div></div>";
echo "</form>";

echo $OUTPUT->footer();


