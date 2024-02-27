<?php
require_once('../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_login();
require_capability('moodle/site:config', context_system::instance());

use \html_writer;

// เพิ่ม CSS style สำหรับ bold headings
echo html_writer::start_tag('style');
echo '.button-container {';
echo '    display: flex;';
echo '    justify-content: flex-start;';
echo '    align-items: center;';
echo '    gap: 10px; /* ระยะห่างระหว่างปุ่ม */';
echo '}';
echo html_writer::end_tag('style');

// ตรวจสอบว่าได้รับ id ของยุทธศาสตร์ที่ต้องการแก้ไขหรือไม่
$id = required_param('id', PARAM_INT);

// ตรวจสอบว่ามีการส่งข้อมูลฟอร์มมาหรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับข้อมูลที่ส่งมาจากฟอร์ม
    $name = required_param('name', PARAM_TEXT);

    // สามารถทำการตรวจสอบความถูกต้องของข้อมูลเพิ่มเติมได้ตามความต้องการ

    // ปรับปรุงข้อมูลในฐานข้อมูลโดยใช้คำสั่ง SQL
    $params = array('name' => $name, 'id' => $id);
    $sql = "UPDATE {strategic} SET name = :name WHERE id = :id";
    $DB->execute($sql, $params);

    // Redirect กลับไปที่หน้าจัดการยุทธศาสตร์พร้อมกับแสดงข้อความ
    redirect(new moodle_url('/admin/tool/bangkok/managestrategic.php'), get_string('strategicupdated', 'tool_bangkok'), null, \core\output\notification::NOTIFY_SUCCESS);
}

// ดึงข้อมูลยุทธศาสตร์ที่ต้องการแก้ไข
$strategic = $DB->get_record('strategic', array('id' => $id), '*', MUST_EXIST);

// ตั้งค่าหน้า
$context = context_system::instance();
$url = new moodle_url('/admin/tool/bangkok/editstrategic.php', array('id' => $id));
$PAGE->set_context($context);
$PAGE->set_url($url);
$PAGE->set_pagelayout('admin');
$PAGE->set_title(get_string('editstrategic', 'tool_bangkok'));
$PAGE->set_heading(get_string('editstrategic', 'tool_bangkok'));

// Output header
echo $OUTPUT->header();

// เริ่มแสดงฟอร์มแก้ไข
echo html_writer::start_tag('form', array('action' => '', 'method' => 'post'));
echo html_writer::start_div('form-group');
echo html_writer::label(get_string('strategic_name', 'tool_bangkok'), 'name');
echo html_writer::empty_tag('input', array('type' => 'text', 'class' => 'form-control', 'id' => 'name', 'name' => 'name', 'value' => $strategic->name));
echo html_writer::end_div();


echo html_writer::start_tag('div', array('class' => 'button-container'));
echo html_writer::empty_tag('input', array('type' => 'submit', 'class' => 'btn btn-primary', 'value' => get_string('savechanges')));;
// Back to main page button
echo html_writer::start_tag('div', array('class' => 'back-button'));
echo html_writer::link(new moodle_url('/admin/tool/bangkok/managestrategicsub.php'), get_string('back_to_main_page', 'tool_bangkok'), array('class' => 'btn btn-secondary'));
echo html_writer::end_tag('div');

echo html_writer::end_tag('form');

// Output footer
echo $OUTPUT->footer();
?>
