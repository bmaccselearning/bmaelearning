<?php
require_once('../../../config.php');
require_once($CFG->libdir.'/formslib.php');
require_once($CFG->libdir.'/adminlib.php');
require_login();
require_capability('moodle/site:config', context_system::instance());

class add_project_form extends moodleform {
    public function definition() {
        global $DB; // ประกาศตัวแปร $DB เป็นตัวแปร global
        $mform = $this->_form;

        $mform->addElement('text', 'name', get_string('project_name', 'tool_bangkok'), array('size' => '100'));
        $mform->setType('name', PARAM_TEXT);
        $mform->addRule('name', get_string('error_name_required', 'tool_bangkok'), 'required', null, 'client');


/*         $mform->addElement('text', 'responsible', get_string('project_responsible', 'tool_bangkok'), array('size' => '100'));
        $mform->setType('responsible', PARAM_TEXT);
        $mform->addRule('responsible', get_string('error_responsible_required', 'tool_bangkok'), 'required', null, 'client'); */

        $responsible = $DB->get_records_menu('view_responsible', null, '', 'id, concat(id,": ",name)');
        $mform->addElement('autocomplete', 'responsible', get_string('project_responsible', 'tool_bangkok'), $responsible);
        $mform->addRule('responsible', get_string('error_responsible_required', 'tool_bangkok'), 'required', null, 'client');
        $responsibleOptions = array();
        $responsibleOptions[0] = 'กรุณาเลือก'; // เพิ่มตัวเลือกเริ่มต้น

        $mform->addElement('text', 'fiscal_year', get_string('project_fiscal_year', 'tool_bangkok'), array('size' => '4'));
        $mform->setType('fiscal_year', PARAM_TEXT);
        $mform->addRule('fiscal_year', get_string('error_fiscal_year_required', 'tool_bangkok'), 'required', null, 'client');

        // Add TinyMCE editor for text fields
        $editoroptions = array('maxfiles' => EDITOR_UNLIMITED_FILES, 'noclean' => true, 'context' => context_system::instance());
        $mform->addElement('editor', 'principles', get_string('project_principles', 'tool_bangkok'), null, $editoroptions);
        $mform->setType('principles', PARAM_RAW);
        
        $mform->addElement('editor', 'objective', get_string('project_objective', 'tool_bangkok'), null, $editoroptions);
        $mform->setType('objective', PARAM_RAW);
        
        $mform->addElement('editor', 'target', get_string('project_target', 'tool_bangkok'), null, $editoroptions);
        $mform->setType('target', PARAM_RAW);
        
        $mform->addElement('editor', 'characteristics', get_string('project_characteristics', 'tool_bangkok'), null, $editoroptions);
        $mform->setType('characteristics', PARAM_RAW);
        
        $mform->addElement('editor', 'duration_location', get_string('project_duration_location', 'tool_bangkok'), null, $editoroptions);
        $mform->setType('duration_location', PARAM_RAW);

        $mform->addElement('editor', 'action_plan', get_string('project_action_plan', 'tool_bangkok'), null, $editoroptions);
        $mform->setType('action_plan', PARAM_RAW);

        $mform->addElement('editor', 'budget', get_string('project_budget', 'tool_bangkok'), null, $editoroptions);
        $mform->setType('budget', PARAM_RAW);

        $mform->addElement('editor', 'risk', get_string('project_risk', 'tool_bangkok'), null, $editoroptions);
        $mform->setType('risk', PARAM_RAW);
        
        $mform->addElement('editor', 'benefits', get_string('project_benefits', 'tool_bangkok'), null, $editoroptions);
        $mform->setType('benefits', PARAM_RAW);
        
        $mform->addElement('editor', 'evaluation', get_string('project_evaluation', 'tool_bangkok'), null, $editoroptions);
        $mform->setType('evaluation', PARAM_RAW);   
        
        // Add submit and cancel buttons
        $this->add_action_buttons(
            true,
            get_string('addproject', 'tool_bangkok', '<i class="fas fa-plus"></i>'),
            array('cancel' => get_string('cancel', 'core', '<i class="fas fa-times"></i>'))
        );

    }
}

$context = context_system::instance();
$url = new moodle_url('/admin/tool/bangkok/addproject.php');
$PAGE->set_context($context);
$PAGE->set_url($url);
$PAGE->set_pagelayout('admin');
$PAGE->set_title(get_string('addproject', 'tool_bangkok'));
$PAGE->set_heading(get_string('addproject', 'tool_bangkok'));

$form = new add_project_form(null);
if ($form->is_cancelled()) {
    // Handle form cancel operation
    redirect(new moodle_url('/admin/tool/bangkok/manageproject.php'), get_string('cancel', 'core'), null, \core\output\notification::NOTIFY_SUCCESS);

} else if ($fromform = $form->get_data()) {
    // Process form data
    global $DB; // เพิ่มบรรทัดนี้เพื่อเรียกใช้ตัวแปร $DB
    // Prepare data for insertion
    $new_project = new stdClass();
    $new_project->name = $fromform->name;
    $new_project->responsible = $fromform->responsible;
    $new_project->fiscal_year = $fromform->fiscal_year;
    $new_project->principles = $fromform->principles['text'];
    $new_project->objective = $fromform->objective['text'];
    $new_project->target = $fromform->target['text'];
    $new_project->characteristics = $fromform->characteristics['text'];
    $new_project->duration_location = $fromform->duration_location['text'];
    $new_project->action_plan = $fromform->action_plan['text'];
    $new_project->budget = $fromform->budget['text'];
    $new_project->risk = $fromform->risk['text'];
    $new_project->benefits = $fromform->benefits['text'];
    $new_project->evaluation = $fromform->evaluation['text'];
    // Add more fields as needed
    // Insert the new project into the database
    $DB->insert_record('project', $new_project);
    // Redirect to the project management page
    redirect(new moodle_url('/admin/tool/bangkok/manageproject.php'), get_string('project_added', 'tool_bangkok'), null, \core\output\notification::NOTIFY_SUCCESS);
}

echo $OUTPUT->header();
$form->display();
echo $OUTPUT->footer();
?>
