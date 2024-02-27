<?php
require_once('../../../config.php');
require_once($CFG->libdir.'/formslib.php');
require_once($CFG->libdir.'/adminlib.php');
require_login();
require_capability('moodle/site:config', context_system::instance());

class edit_project_form extends moodleform {


    public function definition() {
        global $DB; // ประกาศตัวแปร $DB เป็นตัวแปร global

        $mform = $this->_form;

        $mform->addElement('hidden', 'id');    

        $mform->addElement('text', 'name', get_string('project_name', 'tool_bangkok'), array('size' => '100'));
        $mform->setType('name', PARAM_TEXT);
        $mform->addRule('name', get_string('error_name_required', 'tool_bangkok'), 'required', null, 'client');


/*         $mform->addElement('text', 'responsible', get_string('project_responsible', 'tool_bangkok'), array('size' => '100'));
        $mform->setType('responsible', PARAM_TEXT);
        $mform->addRule('responsible', get_string('error_responsible_required', 'tool_bangkok'), 'required', null, 'client'); */
/*
        $responsibles = $DB->get_records('view_responsible'); // ดึงข้อมูลจากวิวตาราง mdl_view_responsible
        $responsibleOptions = array('0' => get_string('please_select', 'tool_bangkok')); // ตัวเลือกแรกใน dropdown
        foreach ($responsibles as $row) {
            $responsibleOptions[$row->id] = $row->name; // เพิ่มตัวเลือกใน dropdown โดยใช้ id เป็นคีย์และ name เป็นค่า
        }

        $mform->addElement('select', 'responsible', get_string('project_responsible', 'tool_bangkok'), $responsibleOptions); // เพิ่ม dropdown ในฟอร์ม
*/
 /*        $responsible = $DB->get_records_menu('view_responsible', null, '', 'id, concat(id,": ",name)');
        $mform->addElement('select', 'responsible', get_string('project_responsible', 'tool_bangkok'), $responsible);
        $responsibleOptions = array();
        $responsibleOptions[0] = 'กรุณาเลือก'; // เพิ่มตัวเลือกเริ่มต้น

        $mform->addElement('text', 'fiscal_year', get_string('project_fiscal_year', 'tool_bangkok'), array('size' => '4'));
        $mform->setType('fiscal_year', PARAM_TEXT);
        $mform->addRule('fiscal_year', get_string('error_fiscal_year_required', 'tool_bangkok'), 'required', null, 'client');

 */

        $responsible = $DB->get_records_menu('view_responsible', null, '', 'id, concat(id,": ",name)');
        $mform->addElement('autocomplete', 'responsible', get_string('project_responsible', 'tool_bangkok'), $responsible);
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

        // Add submit button
        $this->add_action_buttons(true, get_string('save_changes', 'tool_bangkok'), new moodle_url('/admin/tool/bangkok/manageproject.php'));
    }

    public function validation($data, $files) {
        $errors = parent::validation($data, $files);
    
        if (empty($data['name']) || empty($data['responsible']) || empty($data['fiscal_year'])) {
            $errors['name'] = get_string('error_fields_required', 'tool_bangkok');
        }
    
        if (!empty($data['fiscal_year']) && strlen($data['fiscal_year']) > 4) {
            $errors['fiscal_year'] = get_string('error_fiscal_year_length', 'tool_bangkok');
        }
    
        return $errors;
    }
}

$context = context_system::instance();
$url = new moodle_url('/admin/tool/bangkok/editproject.php');
$PAGE->set_context($context);
$PAGE->set_url($url);
$PAGE->set_pagelayout('admin');
$PAGE->set_title(get_string('editproject', 'tool_bangkok'));
$PAGE->set_heading(get_string('editproject', 'tool_bangkok'));

// Check if project ID is provided
$projectid = optional_param('id', 0, PARAM_INT);
if (empty($projectid)) {
    // Handle error: Project ID is required
    print_error('error_project_id_required', 'tool_bangkok');
}

// Retrieve project data from the database
$project = $DB->get_record('project', array('id' => $projectid), '*', MUST_EXIST);

// Set default values for TinyMCE editor fields
$defaults = array(
    'id' => $project->id,
    'name' => $project->name,
    'responsible' => $project->responsible,
    'fiscal_year' => $project->fiscal_year,
    'principles' => array('text' => $project->principles),
    'objective' => array('text' => $project->objective),
    'target' => array('text' => $project->target),
    'characteristics' => array('text' => $project->characteristics),
    'duration_location' => array('text' => $project->duration_location),
    'action_plan' => array('text' => $project->action_plan),
    'budget' => array('text' => $project->budget),
    'risk' => array('text' => $project->risk),
    'benefits' => array('text' => $project->benefits),
    'evaluation' => array('text' => $project->evaluation),
);

$form = new edit_project_form(null);
$form->set_data($defaults);

if ($form->is_cancelled()) {
    // Handle form cancel operation
    redirect(new moodle_url('/admin/tool/bangkok/manageproject.php'), get_string('cancel', 'core'), null, \core\output\notification::NOTIFY_SUCCESS);

} else if ($fromform = $form->get_data()) {
    // Process form data
    // Update data in the database or perform other actions
    // Assuming your database update logic here
    $project = new stdClass();
    $project->id = $fromform->id;
    $project->name = $fromform->name;
    $project->responsible = $fromform->responsible;
    $project->fiscal_year = $fromform->fiscal_year;
    $project->principles = $fromform->principles['text'];
    $project->objective = $fromform->objective['text'];
    $project->target = $fromform->target['text'];
    $project->characteristics = $fromform->characteristics['text'];
    $project->duration_location = $fromform->duration_location['text'];
    $project->action_plan = $fromform->action_plan['text'];
    $project->budget = $fromform->budget['text'];
    $project->risk = $fromform->risk['text'];
    $project->benefits = $fromform->benefits['text'];
    $project->evaluation = $fromform->evaluation['text'];
    
    $DB->update_record('project', $project);

    redirect(new moodle_url('/admin/tool/bangkok/manageproject.php'), get_string('changes_saved', 'tool_bangkok'), null, \core\output\notification::NOTIFY_SUCCESS);
}


echo $OUTPUT->header();
$form->display();
echo $OUTPUT->footer();


?>
