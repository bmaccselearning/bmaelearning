<?php
require_once('../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_login();
require_capability('moodle/site:config', context_system::instance());

// Check if project ID is provided
$projectid = optional_param('id', 0, PARAM_INT);
if (empty($projectid)) {
    // Redirect to manage project page if project ID is missing
    redirect(new moodle_url('/admin/tool/bangkok/manageproject.php'), get_string('invalid_project_id', 'tool_bangkok'), null, \core\output\notification::NOTIFY_ERROR);
}

// Retrieve project data from the database
$project = $DB->get_record('project', array('id' => $projectid), '*', MUST_EXIST);

// Confirm deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $confirmdelete = optional_param('confirmdelete', 0, PARAM_INT);
    if ($confirmdelete) {
        // Perform deletion
        if ($DB->delete_records('project', array('id' => $projectid))) {
            redirect(new moodle_url('/admin/tool/bangkok/manageproject.php'), get_string('project_deleted', 'tool_bangkok'), null, \core\output\notification::NOTIFY_SUCCESS);
        } else {
            redirect(new moodle_url('/admin/tool/bangkok/manageproject.php'), get_string('error_project_not_deleted', 'tool_bangkok'), null, \core\output\notification::NOTIFY_ERROR);
        }
    }
}

// Display confirmation form
$context = context_system::instance();
$url = new moodle_url('/admin/tool/bangkok/deleteproject.php', array('id' => $projectid));
$PAGE->set_context($context);
$PAGE->set_url($url);
$PAGE->set_pagelayout('admin');
$PAGE->set_title(get_string('deleteproject', 'tool_bangkok'));
$PAGE->set_heading(get_string('deleteproject', 'tool_bangkok'));

echo $OUTPUT->header();

echo html_writer::tag('h2', get_string('deleteproject', 'tool_bangkok'));

echo html_writer::start_tag('div', array('class' => 'confirm-delete'));
echo html_writer::tag('p', get_string('confirmdelete', 'tool_bangkok'));
echo html_writer::start_tag('form', array('method' => 'post'));
echo html_writer::empty_tag('input', array('type' => 'hidden', 'name' => 'confirmdelete', 'value' => 1));
echo html_writer::empty_tag('input', array('type' => 'submit', 'value' => get_string('confirmdelete', 'tool_bangkok'), 'class' => 'btn btn-danger'));
echo html_writer::end_tag('form');
echo html_writer::end_tag('div');

echo $OUTPUT->footer();
?>
