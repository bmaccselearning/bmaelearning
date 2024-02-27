<?php
require_once('../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_login();
require_capability('moodle/site:config', context_system::instance());

$context = context_system::instance();
$url = new moodle_url('/admin/tool/bangkok/addstrategic_sub.php');

$PAGE->set_context($context);
//$PAGE->set_url($url);
$PAGE->set_pagelayout('admin');
$PAGE->set_title(get_string('addstrategic', 'tool_bangkok'));
$PAGE->set_heading(get_string('addstrategic', 'tool_bangkok'));

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
echo html_writer::tag('h2', get_string('addstrategic', 'tool_bangkok'));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process form submission
    $strategic = new stdClass();
    $strategic->strategic_id = optional_param('strategic_id', 0, PARAM_INT);
    $strategic->name = optional_param('name', '', PARAM_TEXT);

    $errors = array();

    if (empty($strategic->strategic_id)) {
        $errors[] = get_string('error_strategic_required', 'tool_bangkok');
    }

    if (empty($strategic->name)) {
        $errors[] = get_string('error_name_required', 'tool_bangkok');
    }

    if (empty($errors)) {
        // Save the strategic to the database
        $id = $DB->insert_record('strategic_sub', $strategic);
        if ($id) {
            echo html_writer::tag('p', get_string('strategic_added', 'tool_bangkok'));
        } else {
            echo html_writer::tag('p', get_string('error_strategic_not_added', 'tool_bangkok'), array('class' => 'error'));
        }
        redirect(new moodle_url('/admin/tool/bangkok/managestrategicsub.php'), get_string('strategic_added', 'tool_bangkok'), null, \core\output\notification::NOTIFY_SUCCESS);

    } else {
        // Display errors
        foreach ($errors as $error) {
            echo html_writer::tag('p', $error, array('class' => 'error'));
        }
    }
}

// Get strategic options for dropdown
$strategic_options = array();
$strategics = $DB->get_records_menu('strategic', [], '', 'id, name');
foreach ($strategics as $id => $name) {
    $strategic_options[$id] = $name;
}

// Display the form
echo html_writer::start_tag('form', array('method' => 'post'));
echo html_writer::start_tag('div', array('class' => 'form-group'));
echo html_writer::tag('label', get_string('strategic', 'tool_bangkok'), array('for' => 'strategic_id'));
echo html_writer::select($strategic_options, 'strategic_id', '');
echo html_writer::end_tag('div');
echo html_writer::start_tag('div', array('class' => 'form-group'));
echo html_writer::tag('label', get_string('strategicsub', 'tool_bangkok'), array('for' => 'name'));
echo html_writer::empty_tag('input', array('type' => 'text', 'name' => 'name', 'class' => 'form-control', 'id' => 'name'));
echo html_writer::end_tag('div');

echo html_writer::start_tag('div', array('class' => 'button-container'));
echo html_writer::empty_tag('input', array('type' => 'submit', 'value' => get_string('add_strategic', 'tool_bangkok'), 'class' => 'btn btn-primary'));
// Back to main page button
echo html_writer::start_tag('div', array('class' => 'back-button'));
echo html_writer::link(new moodle_url('/admin/tool/bangkok/managestrategicsub.php'), get_string('back_to_main_page', 'tool_bangkok'), array('class' => 'btn btn-secondary'));
echo html_writer::end_tag('div');

echo html_writer::end_tag('form');



echo $OUTPUT->footer();
?>
