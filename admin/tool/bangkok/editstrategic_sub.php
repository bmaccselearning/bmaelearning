<?php
require_once('../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_login();
require_capability('moodle/site:config', context_system::instance());

use \html_writer;

// ตรวจสอบว่าได้รับ id ของยุทธศาสตร์ที่ต้องการแก้ไขหรือไม่
$id = required_param('id', PARAM_INT);

// ตรวจสอบว่ามีการส่งข้อมูลฟอร์มมาหรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับข้อมูลที่ส่งมาจากฟอร์ม
    $name = required_param('name', PARAM_TEXT);
    $strategic_id = required_param('strategic_id', PARAM_INT); // เพิ่มบรรทัดนี้

    // สามารถทำการตรวจสอบความถูกต้องของข้อมูลเพิ่มเติมได้ตามความต้องการ

    // ปรับปรุงข้อมูลในฐานข้อมูลโดยใช้คำสั่ง SQL
    $params = array('name' => $name, 'id' => $id, 'strategic_id' => $strategic_id); // เพิ่ม strategic_id ใน $params
    $sql = "UPDATE {strategic_sub} SET name = :name, strategic_id = :strategic_id WHERE id = :id"; // เพิ่ม strategic_id ใน SQL query
    $DB->execute($sql, $params);

    // Redirect กลับไปที่หน้าจัดการยุทธศาสตร์พร้อมกับแสดงข้อความ
    redirect(new moodle_url('/admin/tool/bangkok/managestrategicsub.php'), get_string('strategicupdated', 'tool_bangkok'), null, \core\output\notification::NOTIFY_SUCCESS);
}

// ดึงข้อมูลยุทธศาสตร์ที่ต้องการแก้ไข
$strategic = $DB->get_record('strategic_sub', array('id' => $id), '*', MUST_EXIST);

// ดึงข้อมูลยุทธศาสตร์จากตาราง strategic เพื่อสร้าง dropdown
$strategics = $DB->get_records_menu('strategic', [], '', 'id, name');

// ตั้งค่าหน้า
$context = context_system::instance();
$url = new moodle_url('/admin/tool/bangkok/editstrategic_sub.php', array('id' => $id));
$PAGE->set_context($context);
$PAGE->set_url($url);
$PAGE->set_pagelayout('admin');
$PAGE->set_title(get_string('editstrategic', 'tool_bangkok'));
$PAGE->set_heading(get_string('editstrategic', 'tool_bangkok'));

// เพิ่ม CSS style สำหรับ bold headings
echo html_writer::start_tag('style');
echo '.button-container {';
echo '    display: flex;';
echo '    justify-content: flex-start;';
echo '    align-items: center;';
echo '    gap: 10px; /* ระยะห่างระหว่างปุ่ม */';
echo '}';
echo html_writer::end_tag('style');

// Output header
echo $OUTPUT->header();

// เริ่มแสดงฟอร์มแก้ไข
echo html_writer::start_tag('form', array('action' => '', 'method' => 'post'));
echo html_writer::start_div('form-group');
echo html_writer::label(get_string('strategic_name', 'tool_bangkok'), 'name');
echo html_writer::end_div();
echo html_writer::start_div('form-group');


// ตรวจสอบว่ามีการส่งข้อมูลฟอร์มมาหรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับข้อมูลที่ส่งมาจากฟอร์ม
    $name = required_param('name', PARAM_TEXT);
    $strategic_id = required_param('strategic_id', PARAM_INT); // เพิ่มบรรทัดนี้

    // สามารถทำการตรวจสอบความถูกต้องของข้อมูลเพิ่มเติมได้ตามความต้องการ

    // ปรับปรุงข้อมูลในฐานข้อมูลโดยใช้คำสั่ง SQL
    $params = array('name' => $name, 'id' => $id, 'strategic_id' => $strategic_id); // เพิ่ม strategic_id ใน $params
    $sql = "UPDATE {strategic_sub} SET name = :name, strategic_id = :strategic_id WHERE id = :id"; // เพิ่ม strategic_id ใน SQL query
    $DB->execute($sql, $params);

    // Redirect กลับไปที่หน้าจัดการยุทธศาสตร์พร้อมกับแสดงข้อความ
    redirect(new moodle_url('/admin/tool/bangkok/managestrategicsub.php'), get_string('strategicupdated', 'tool_bangkok'), null, \core\output\notification::NOTIFY_SUCCESS);
}


// แสดง dropdown ของ strategic_id
echo html_writer::start_div('form-group');
echo html_writer::label(get_string('strategic', 'tool_bangkok'), '-');
echo html_writer::select($strategics, 'strategic_id', $strategic->strategic_id); // ลบ 'class' => 'form-control' ออก
echo html_writer::end_div();

echo html_writer::start_div('form-group');
echo html_writer::label(get_string('strategicsub', 'tool_bangkok'), 'name');
echo html_writer::empty_tag('input', array('type' => 'text', 'name' => 'name', 'class' => 'form-control', 'id' => 'name', 'value' => $strategic->name));
echo html_writer::end_div();


echo html_writer::start_tag('div', array('class' => 'button-container'));
echo html_writer::empty_tag('input', array('type' => 'submit', 'value' => get_string('savechanges'), 'class' => 'btn btn-primary'));
// Back to main page button
echo html_writer::start_tag('div', array('class' => 'back-button'));
echo html_writer::link(new moodle_url('/admin/tool/bangkok/managestrategicsub.php'), get_string('back_to_main_page', 'tool_bangkok'), array('class' => 'btn btn-secondary'));
echo html_writer::end_tag('div');


echo html_writer::end_tag('form');


// Output footer
echo $OUTPUT->footer();

?>

