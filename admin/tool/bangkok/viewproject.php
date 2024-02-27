<?php
require_once('../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_login();
require_capability('moodle/site:config', context_system::instance());

$context = context_system::instance();
$PAGE->set_context($context);
$PAGE->set_pagelayout('admin');
$PAGE->set_title(get_string('viewproject', 'tool_bangkok'));
$PAGE->set_heading(get_string('viewproject', 'tool_bangkok'));

// Add CSS style for bold headings
echo html_writer::start_tag('style');
echo '.bold-heading { font-weight: bold; }';
echo html_writer::end_tag('style');

echo $OUTPUT->header();
echo html_writer::tag('h2', get_string('viewproject', 'tool_bangkok'));

// Check if project ID is provided
$projectid = required_param('id', PARAM_INT);

// Retrieve project data from the database
$project = $DB->get_record('project', array('id' => $projectid), '*', MUST_EXIST);

// Retrieve responsible name from mdl_view_responsible
$sql = "SELECT r.name
        FROM {view_responsible} r
        WHERE " . $DB->sql_compare_text('r.id', '=', 'p.responsible') . "
        AND r.id = :responsibleid";

$params = array('responsibleid' => $project->responsible);
$responsible = $DB->get_record_sql($sql, $params);

// Display project details
echo html_writer::tag('p', '<strong>' . get_string('project_name', 'tool_bangkok') . ':</strong> ' . $project->name);
echo html_writer::tag('p', '<strong>' . get_string('project_responsible', 'tool_bangkok') . ':</strong> ' . $responsible->name);
echo html_writer::tag('p', '<strong>' . get_string('project_fiscal_year', 'tool_bangkok') . ':</strong> ' . $project->fiscal_year );
echo html_writer::tag('p', '<strong>' . get_string('project_principles', 'tool_bangkok') . ':</strong> ' . $project->principles);
echo html_writer::tag('p', '<strong>' . get_string('project_objective', 'tool_bangkok') . ':</strong> ' . $project->objective);
echo html_writer::tag('p', '<strong>' . get_string('project_target', 'tool_bangkok') . ':</strong> ' . $project->target);
echo html_writer::tag('p', '<strong>' . get_string('project_characteristics', 'tool_bangkok') . ':</strong> ' . $project->characteristics);
echo html_writer::tag('p', '<strong>' . get_string('project_duration_location', 'tool_bangkok') . ':</strong> ' . $project->duration_location);
echo html_writer::tag('p', '<strong>' . get_string('project_action_plan', 'tool_bangkok') . ':</strong> ' . $project->action_plan);
echo html_writer::tag('p', '<strong>' . get_string('project_budget', 'tool_bangkok') . ':</strong> ' . $project->budget);
echo html_writer::tag('p', '<strong>' . get_string('project_risk', 'tool_bangkok') . ':</strong> ' . $project->risk);
echo html_writer::tag('p', '<strong>' . get_string('project_benefits', 'tool_bangkok') . ':</strong> ' . $project->benefits);
echo html_writer::tag('p', '<strong>' . get_string('project_evaluation', 'tool_bangkok') . ':</strong> ' . $project->evaluation);

// Button container
echo html_writer::start_tag('div', array('class' => 'button-container'));

// Edit button with icon
echo html_writer::link(new moodle_url('/admin/tool/bangkok/editproject.php', array('id' => $project->id)), '<i class="fas fa-edit"></i> ' . get_string('editproject', 'tool_bangkok'), array('class' => 'btn btn-primary mr-2'));

// Delete button with icon
echo html_writer::link(new moodle_url('/admin/tool/bangkok/deleteproject.php', array('id' => $project->id)), '<i class="fas fa-trash-alt"></i> ' . get_string('deleteproject', 'tool_bangkok'), array('class' => 'btn btn-danger mr-2'));

// Back to manageproject button with icon
echo html_writer::link(new moodle_url('/admin/tool/bangkok/manageproject.php'), '<i class="fas fa-arrow-left"></i> ' . get_string('back_to_main_page', 'tool_bangkok'), array('class' => 'btn btn-secondary'));

echo html_writer::end_tag('div'); // Close button-container

echo $OUTPUT->footer();
?>
