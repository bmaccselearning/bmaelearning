<?php
require_once('../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_login();
require_capability('moodle/site:config', context_system::instance());

$context = context_system::instance();
$url = new moodle_url('/admin/tool/bangkok/managestrategicsub.php');
$PAGE->set_context($context);
$PAGE->set_url($url);
$PAGE->set_pagelayout('admin');
$PAGE->set_title(get_string('managestrategic', 'tool_bangkok'));
$PAGE->set_heading(get_string('managestrategic', 'tool_bangkok'));

// เพิ่ม CSS style สำหรับ bold headings
echo html_writer::start_tag('style');
echo '.button-container {';
echo '    display: flex;';
echo '    justify-content: flex-start;';
echo '    align-items: center;';
echo '    gap: 10px; /* ระยะห่างระหว่างปุ่ม */';
echo '}';
echo html_writer::end_tag('style');


echo $OUTPUT->header();
echo html_writer::tag('h2', get_string('managestrategic', 'tool_bangkok'));

global $DB;

// ดึงข้อมูลยุทธศาสตร์ย่อย
$strategics = $DB->get_records_sql("SELECT * FROM {strategic_sub} ORDER BY strategic_id, id");

if (!empty($strategics)) {
    echo html_writer::start_tag('table');
    echo html_writer::start_tag('tr');
    echo html_writer::tag('th', 'ยุทธศาสตร์');
    echo html_writer::tag('th', 'แก้ไข');
    echo html_writer::tag('th', 'ลบ');
    echo html_writer::end_tag('tr');

    $current_strategic_id = null;
    foreach ($strategics as $strategic) {
        if ($strategic->strategic_id != $current_strategic_id) {
            echo html_writer::start_tag('tr');
            echo html_writer::tag('td', $strategic->name, array('style' => 'font-weight: bold;'));
            echo html_writer::start_tag('td');
        echo html_writer::link(new moodle_url('/admin/tool/bangkok/editstrategic.php', array('id' => $strategic->id)), '<i class="fas fa-edit"></i>');
        echo html_writer::end_tag('td');
        echo html_writer::start_tag('td');
        echo html_writer::link(new moodle_url('/admin/tool/bangkok/deletestrategic.php', array('id' => $strategic->id)), '<i class="fas fa-trash-alt"></i>');
        echo html_writer::end_tag('td');
        
            echo html_writer::end_tag('tr');
            $current_strategic_id = $strategic->strategic_id;
        }

        echo html_writer::start_tag('tr');
        echo html_writer::tag('td', $strategic->name);
        echo html_writer::start_tag('td');
        echo html_writer::link(new moodle_url('/admin/tool/bangkok/editstrategic_sub.php', array('id' => $strategic->id)), '<i class="fas fa-edit"></i>');
        echo html_writer::end_tag('td');
        echo html_writer::start_tag('td');
        echo html_writer::link(new moodle_url('/admin/tool/bangkok/deletestrategic_sub.php', array('id' => $strategic->id)), '<i class="fas fa-trash-alt"></i>');
        echo html_writer::end_tag('td');
        echo html_writer::end_tag('tr');
    }
    echo html_writer::end_tag('table');
} else {
    echo html_writer::tag('p', 'No strategic data available.');
}
/* echo html_writer::start_tag('div', array('class' => 'add-button'));
echo html_writer::link(new moodle_url('/admin/tool/bangkok/addstrategic_sub.php'), 'เพิ่มยุทธศาสตร์');
echo html_writer::end_tag('div'); */

echo html_writer::start_tag('div', array('class' => 'button-container'));
// Add strategic button
echo html_writer::start_tag('div', array('class' => 'add-button'));
echo html_writer::link(new moodle_url('/admin/tool/bangkok/addstrategic.php'), get_string('addstrategic', 'tool_bangkok'), array('class' => 'btn btn-primary'));
echo html_writer::end_tag('div');

// Add strategic button
echo html_writer::start_tag('div', array('class' => 'add-button'));
echo html_writer::link(new moodle_url('/admin/tool/bangkok/addstrategic_sub.php'), get_string('addstrategicsub', 'tool_bangkok'), array('class' => 'btn btn-primary'));
echo html_writer::end_tag('div');

// Back to main page button
echo html_writer::start_tag('div', array('class' => 'back-button'));
echo html_writer::link(new moodle_url('/admin/tool/bangkok/'), get_string('back_to_main_page', 'tool_bangkok'), array('class' => 'btn btn-secondary'));
echo html_writer::end_tag('div');





echo $OUTPUT->footer();
?>
