<?php

// Load Moodle
require_once('../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_login();
require_capability('moodle/site:config', context_system::instance());

// Set up page parameters
$context = context_system::instance();
$url = new moodle_url('/admin/tool/bangkok/index.php');
$PAGE->set_context($context);
$PAGE->set_url($url);
$PAGE->set_pagelayout('admin');
$PAGE->set_title(get_string('pluginname', 'tool_bangkok'));
$PAGE->set_heading(get_string('pluginname', 'tool_bangkok'));

// Output header
echo $OUTPUT->header();

// Output content
echo html_writer::tag('h2', get_string('project_tool', 'tool_bangkok'));

// Add links to manage strategic and strategic_sub
echo html_writer::start_tag('ul');
echo html_writer::tag('li', html_writer::link(new moodle_url('/admin/tool/bangkok/manageproject.php'), get_string('manageproject', 'tool_bangkok')));
echo html_writer::tag('li', html_writer::link(new moodle_url('/admin/tool/bangkok/managestrategicsub.php'), get_string('managestrategic', 'tool_bangkok')));
echo html_writer::end_tag('ul');

// Output footer
echo $OUTPUT->footer();
