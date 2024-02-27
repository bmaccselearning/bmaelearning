<?php
require_once('../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_login();
require_capability('moodle/site:config', context_system::instance());

// ตรวจสอบว่าได้รับ id ของยุทธศาสตร์ที่ต้องการลบหรือไม่
$id = optional_param('id', 0, PARAM_INT);

if ($id <= 0) {
    redirect(new moodle_url('/admin/tool/bangkok/managestrategicsub.php'), get_string('invalidstrategicid', 'tool_bangkok'), null, \core\output\notification::NOTIFY_ERROR);
}

// ตรวจสอบว่ายืนยันการลบหรือไม่
if (optional_param('confirm', false, PARAM_BOOL)) {
    global $DB;
    
    // ดึงข้อมูลยุทธศาสตร์
    if (!$strategic = $DB->get_record('strategic_sub', array('id' => $id))) {
        redirect(new moodle_url('/admin/tool/bangkok/managestrategicsub.php'), get_string('strategicnotfound', 'tool_bangkok'), null, \core\output\notification::NOTIFY_ERROR);
    }

    // ลบยุทธศาสตร์
    $DB->delete_records('strategic_sub', array('id' => $id));

    // Redirect กลับไปที่หน้าจัดการยุทธศาสตร์พร้อมกับแสดงข้อความ
    redirect(new moodle_url('/admin/tool/bangkok/managestrategicsub.php'), get_string('strategicdeleted', 'tool_bangkok'), null, \core\output\notification::NOTIFY_SUCCESS);
}

// ถ้าไม่ได้ยืนยันการลบ ให้แสดงฟอร์มยืนยันการลบ
$confirmurl = new moodle_url('/admin/tool/bangkok/deletestrategic_sub.php', array('id' => $id, 'confirm' => true));
$cancelurl = new moodle_url('/admin/tool/bangkok/managestrategicsub.php');
$strategic = $DB->get_record('strategic_sub', array('id' => $id));
$confirmdelete = get_string('confirmdelete', 'tool_bangkok', $strategic->name);

echo $OUTPUT->header();
echo html_writer::start_tag('div', array('class' => 'confirm-delete'));

// แสดงข้อมูลเรคคอร์ดที่กำลังจะลบ
echo html_writer::tag('p', $confirmdelete);

echo html_writer::start_tag('form', array('action' => $confirmurl, 'method' => 'post'));
echo html_writer::empty_tag('input', array('type' => 'submit', 'class' => 'btn btn-danger', 'value' => get_string('delete')));
// แสดงลิงก์ยกเลิก
echo html_writer::link($cancelurl, get_string('cancel'), array('class' => 'btn btn-info'));
echo html_writer::end_tag('form');

echo html_writer::end_tag('div');

echo $OUTPUT->footer();
?>
