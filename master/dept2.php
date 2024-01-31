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



$delete       = optional_param('delete', 0, PARAM_INT);
$confirm      = optional_param('confirm', '', PARAM_ALPHANUM);   //md5 confirmation hash
$confirmuser  = optional_param('confirmuser', 0, PARAM_INT);
$sort         = optional_param('sort', 'name', PARAM_ALPHANUMEXT);
$dir          = optional_param('dir', 'ASC', PARAM_ALPHA);
$page         = optional_param('page', 0, PARAM_INT);
$perpage      = optional_param('perpage', 30, PARAM_INT);        // how many per page
$ru           = optional_param('ru', '2', PARAM_INT);            // show remote users
$lu           = optional_param('lu', '2', PARAM_INT);            // show local users
$acl          = optional_param('acl', '0', PARAM_INT);           // id of user to tweak mnet ACL (requires $access)
$suspend      = optional_param('suspend', 0, PARAM_INT);
$unsuspend    = optional_param('unsuspend', 0, PARAM_INT);
$unlock       = optional_param('unlock', 0, PARAM_INT);
$resendemail  = optional_param('resendemail', 0, PARAM_INT);


// TODO Add sesskey check to edit
$edit   = optional_param('edit', null, PARAM_BOOL);    // Turn editing on and off
$reset  = optional_param('reset', null, PARAM_BOOL);
$returnurl = new moodle_url('/master/dept.php');
//require_login();
/////////////////////////
$PAGE->set_title(get_string('บันทึกหน่วยงานของกรุงเทพมหานคร'));
$PAGE->set_heading($site->fullname);
echo $OUTPUT->header();
//echo $OUTPUT->heading(get_string('departmentcode'));
//echo $OUTPUT->box(get_string('departmentcode'), 'generalbox boxaligncenter');
require_once('deptForm.php'); // Use our "supplanter" login_forgot_password_form. MDL-20846


global $DB, $CFG;
if (!empty($username)) {
    // Username has been specified - load the user record based on that.
    $username = core_text::strtolower($username); // Mimic the login page process.
    $userparams = array('username' => $username, 'mnethostid' => $CFG->mnet_localhost_id, 'deleted' => 0, 'suspended' => 0);
    $user = $DB->get_record('user', $userparams);
} else {
    // Try to load the user record based on email address.
    // This is tricky because:
    // 1/ the email is not guaranteed to be unique - TODO: send email with all usernames to select the account for pw reset
    // 2/ mailbox may be case sensitive, the email domain is case insensitive - let's pretend it is all case-insensitive.
    //
    // The case-insensitive + accent-sensitive search may be expensive as some DBs such as MySQL cannot use the
    // index in that case. For that reason, we first perform accent-insensitive search in a subselect for potential
    // candidates (which can use the index) and only then perform the additional accent-sensitive search on this
    // limited set of records in the outer select.
    $sql = "SELECT t.department_code,department_name,b.division_code,b.division_name,c.section_code,c.section_name,d.job_code,d.job_name
    FROM view_users_department t,view_users_division B,view_users_section c,view_users_job d
    where b.department_code=t.department_code
    and b.department_code=c.department_code
    and b.division_code=c.division_code
      and c.department_code=d.department_code
    and c.division_code=d.division_code
    and c.section_code=d.section_code
    order by t.department_code,b.division_code ,c.section_code,d.job_code" ;

    // $params = array(
    //     'department_code' => "50",
       
    // );

    $departmentList = $DB->get_records_sql($sql, $params, IGNORE_MULTIPLE);
}
//print_r($departmentList);
//echo $sql;
//echo "department_name:".$departmentList->department_name;
echo "<h3>โครงสร้างองค์กรของกรุงเทพมหานคร</h3>";


$table = new html_table();
$table->head = array ();
$table->colclasses = array();
$table->head[] = $fullnamedisplay;
$table->attributes['class'] = 'admintable generaltable table-sm';
foreach ($extracolumns as $field) {
    $table->head[] = ${$field};
}
$table->head[] = "รหัสหน่วยงาน";
$table->head[] = "ชื่อหน่วยงาน";
$table->head[] = "รหัสสำนักงานเขต/ส่วนราชการ";
$table->head[] = "สำนักงานเขต/ส่วนราชการ";
$table->head[] = "รหัสฝ่ายกลุ่ม";
$table->head[] = "ฝ่ายกลุ่ม";
$table->head[] = "รหัสงาน";
$table->head[] = "งาน";
// $table->head[] = "สร้างเมื่อ";
// $table->head[] = "แก้ไขล่าสุด";
$table->colclasses[] = 'centeralign';
$table->head[] = "";
$table->colclasses[] = 'centeralign';

$table->id = "department_table";
$i =0;
foreach ($departmentList as $departmentid) {
    $i=$i+1;
    $buttons = array();
    $lastcolumn = '';

    //delete button
     
      /*  if (is_mnet_remote_user($user) or $user->id == $USER->id or is_siteadmin($user)) {
            // no deleting of self, mnet accounts or admins allowed
        } else {
            $url = new moodle_url($returnurl, array('delete'=>$departmentList->departmentcode, 'sesskey'=>sesskey()));
            $buttons[] = html_writer::link($url, $OUTPUT->pix_icon('t/delete', $strdelete));
        }*/
      

    // suspend button
    // if (has_capability('moodle/user:update', $sitecontext)) {
    //     if (is_mnet_remote_user($user)) {
    //         // mnet users have special access control, they can not be deleted the standard way or suspended
    //         $accessctrl = 'allow';
    //         if ($acl = $DB->get_record('mnet_sso_access_control', array('username'=>$user->username, 'mnet_host_id'=>$user->mnethostid))) {
    //             $accessctrl = $acl->accessctrl;
    //         }
    //         $changeaccessto = ($accessctrl == 'deny' ? 'allow' : 'deny');
    //         $buttons[] = " (<a href=\"?acl={$user->id}&amp;accessctrl=$changeaccessto&amp;sesskey=".sesskey()."\">".get_string($changeaccessto, 'mnet') . " access</a>)";

    //     } else {
    //         if ($user->suspended) {
    //             $url = new moodle_url($returnurl, array('unsuspend'=>$user->id, 'sesskey'=>sesskey()));
    //             $buttons[] = html_writer::link($url, $OUTPUT->pix_icon('t/show', $strunsuspend));
    //         } else {
    //             if ($user->id == $USER->id or is_siteadmin($user)) {
    //                 // no suspending of admins or self!
    //             } else {
    //                 $url = new moodle_url($returnurl, array('suspend'=>$user->id, 'sesskey'=>sesskey()));
    //                 $buttons[] = html_writer::link($url, $OUTPUT->pix_icon('t/hide', $strsuspend));
    //             }
    //         }

    //         if (login_is_lockedout($user)) {
    //             $url = new moodle_url($returnurl, array('unlock'=>$user->id, 'sesskey'=>sesskey()));
    //             $buttons[] = html_writer::link($url, $OUTPUT->pix_icon('t/unlock', $strunlock));
    //         }
    //     }
    // }

    // edit button
 
        // prevent editing of admins by non-admins

        $returnurl="deptDelete.php";
        $url = new moodle_url($returnurl, array('delete'=>$departmentid->department_code, 'sesskey'=>sesskey()));
        $buttons[] = html_writer::link($url, $OUTPUT->pix_icon('t/delete', $strdelete));

        if (is_siteadmin($USER) or !is_siteadmin($user)) {
            $url = new moodle_url('/master/EditDept.php', array('deparmentID'=>$departmentid->department_code));
            $buttons[] = html_writer::link($url, $OUTPUT->pix_icon('t/edit', $stredit));
        }
    

    // // the last column - confirm or mnet info
    // if (is_mnet_remote_user($user)) {
    //     // all mnet users are confirmed, let's print just the name of the host there
    //     if (isset($mnethosts[$user->mnethostid])) {
    //         $lastcolumn = get_string($accessctrl, 'mnet').': '.$mnethosts[$user->mnethostid]->name;
    //     } else {
    //         $lastcolumn = get_string($accessctrl, 'mnet');
    //     }

    // } else if ($user->confirmed == 0) {
    //     if (has_capability('moodle/user:update', $sitecontext)) {
    //         $lastcolumn = html_writer::link(new moodle_url($returnurl, array('confirmuser'=>$user->id, 'sesskey'=>sesskey())), $strconfirm);
    //     } else {
    //         $lastcolumn = "<span class=\"dimmed_text\">".get_string('confirm')."</span>";
    //     }

    //     $lastcolumn .= ' | ' . html_writer::link(new moodle_url($returnurl,
    //         [
    //             'resendemail' => $user->id,
    //             'sesskey' => sesskey()
    //         ]
    //     ), $strresendemail);
    // }

    // if ($user->lastaccess) {
    //     $strlastaccess = format_time(time() - $user->lastaccess);
    // } else {
    //     $strlastaccess = get_string('never');
    // }
    // $fullname = fullname($user, true);

    $row = array ();
    foreach ($extracolumns as $field) {
        //p($user->{$field});
        $row[] = s($user->{$field});
    }
    //$row[] = $user->city;
    //$row[] = $user->country;
    //$row[] = $strlastaccess;
    // if ($user->suspended) {
    //     foreach ($row as $k=>$v) {
    //         $row[$k] = html_writer::tag('span', $v, array('class'=>'usersuspended'));
    //     }
    // }
   
    $row[] = $lastcolumn;
   // $row[] = "สวัสดีตาราง".$i;
    $row[] = $departmentid->department_code;
    $row[] = "<a href=\"../master/division.php?department_code=$departmentid->department_code\">$departmentid->department_name</a>"; 
    $row[] = $departmentid->division_code;
    $row[] = $departmentid->division_name;
    $row[] = $departmentid->section_code;
    $row[] = $departmentid->section_name;
    $row[] = $departmentid->job_code;
    $row[] = $departmentid->job_name;
    // $row[] = date("d/m/Y H:i:s",$departmentid->createdAt);
    // $row[] = date("d/m/Y H:i:s",$departmentid->updatedAt);
     $row[] = implode(' ', $buttons);
    $table->data[] = $row;
}
 
if (!empty($table)) {
    echo html_writer::start_tag('div', array('class'=>'no-overflow'));
    echo html_writer::table($table);
    echo html_writer::end_tag('div');
   // echo $OUTPUT->paging_bar($usercount, $page, $perpage, $baseurl);
}
//if (has_capability('moodle/master:create', $sitecontext)) {
    $url = new moodle_url('/master/addDept.php', array('id' => -1));
    echo $OUTPUT->single_button($url, "สร้างหน่วยงาน", 'get');
//}
// $form = new department_Form('deptDetail.php', array('username' => $frm->username));
// $form->display();
echo $OUTPUT->footer();
//////////////////////
// Trigger dashboard has been viewed event.
//$eventparams = array('context' => $context);
//$event = \core\event\dashboard_viewed::create($eventparams);
//$event->trigger();
