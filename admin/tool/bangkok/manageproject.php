<?php
require_once('../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_login();
require_capability('moodle/site:config', context_system::instance());

$context = context_system::instance();
$url = new moodle_url('/admin/tool/bangkok/manageproject.php');
$PAGE->set_context($context);
$PAGE->set_url($url);
$PAGE->set_pagelayout('admin');
$PAGE->set_title(get_string('manageproject', 'tool_bangkok'));
$PAGE->set_heading(get_string('manageproject', 'tool_bangkok'));

// เพิ่ม CSS style สำหรับ bold headings
echo html_writer::start_tag('style');
echo '.bold-heading { font-weight: bold; }';
echo 'ul {';
echo '    list-style-type: disc; /* เลือกประเภทของ Bullet ที่ต้องการ */';
echo '    padding-left: 20px; /* ปรับระยะห่างของ Bullets จากด้านซ้าย */';
echo '}';
echo 'input[type="text"] { width: 50%; }'; // ปรับความยาวของช่องค้นหาให้ยาวขึ้น 
echo 'input[type="submit"] { margin-left: 10px; }'; // เพิ่มระยะห่างระหว่างช่องค้นหาและปุ่มค้นหา
echo html_writer::end_tag('style');

echo $OUTPUT->header();
echo html_writer::tag('h2', get_string('manageproject', 'tool_bangkok'));

// เพิ่มฟอร์มค้นหา
echo html_writer::start_tag('form', array('method' => 'GET', 'action' => new moodle_url('/admin/tool/bangkok/manageproject.php')));
echo html_writer::empty_tag('input', array('type' => 'text', 'name' => 'search', 'placeholder' => get_string('search', 'tool_bangkok')));
echo html_writer::empty_tag('input', array('type' => 'submit', 'value' => get_string('search', 'tool_bangkok')));
echo html_writer::end_tag('form');

// ตรวจสอบว่ามีการส่งคำค้นหามาหรือไม่
$searchquery = optional_param('search', '', PARAM_TEXT);
$page = optional_param('page', 0, PARAM_INT); // รับค่าหน้าปัจจุบัน

$records_per_page = 3; // จำนวนรายการต่อหน้า
$offset = $page * $records_per_page;



if (!empty($searchquery)) {
    // ทำการค้นหาและแสดงผลลัพธ์
    $searchquery = '%' . $searchquery . '%';
    $sql = "SELECT p.*, r.name AS responsible_name
            FROM {project} p
            LEFT JOIN {view_responsible} r ON p.responsible = r.id
            WHERE p.name LIKE ? OR p.fiscal_year LIKE ? OR r.name LIKE ?
            ORDER BY p.fiscal_year DESC, p.responsible ASC , p.name ASC
            LIMIT $offset, $records_per_page";
    $projects = $DB->get_records_sql($sql, array($searchquery, $searchquery, $searchquery));
} else {
    // หากไม่มีการส่งคำค้นหามา ให้ดึงข้อมูลโปรเจกต์ทั้งหมด
    $sql = "SELECT p.*, r.name AS responsible_name
            FROM {project} p
            LEFT JOIN {view_responsible} r ON p.responsible = r.id
            ORDER BY p.fiscal_year DESC, p.responsible ASC , p.name ASC
            LIMIT $offset, $records_per_page";
    $projects = $DB->get_records_sql($sql);
}

// หาจำนวนรายการทั้งหมด
$total_projects = $DB->count_records_sql("SELECT COUNT(*) FROM {project}");

// หาจำนวนหน้าทั้งหมด
$total_pages = ceil($total_projects / $records_per_page);



// แสดงลิงก์ไปยังหน้าถัดไป
if ($total_pages > 1) {
    if (($page + 1) < $total_pages) {
        $next_page_url = new moodle_url('/admin/tool/bangkok/manageproject.php', array('search' => $searchquery, 'page' => $page + 1));
        echo $OUTPUT->paging_bar($total_projects, $page, $records_per_page, $next_page_url);
    } elseif ($page > 0) { // เพิ่มเงื่อนไขนี้เพื่อให้แสดงเครื่องมือเมื่ออยู่ที่หน้าที่ไม่ใช่หน้าแรก
        $prev_page_url = new moodle_url('/admin/tool/bangkok/manageproject.php', array('search' => $searchquery, 'page' => $page - 1));
        echo $OUTPUT->paging_bar($total_projects, $page, $records_per_page, $prev_page_url);
    }
}

if (!empty($projects)) {
    echo html_writer::start_tag('table', array('style' => 'border-collapse: collapse;'));
    echo html_writer::start_tag('thead', array('style' => 'text-align: center;'));
    echo html_writer::start_tag('tr');
    echo html_writer::tag('th', get_string('project_name', 'tool_bangkok'));
    echo html_writer::tag('th', get_string('project_fiscal_year', 'tool_bangkok'));
    echo html_writer::tag('th', get_string('project_responsible', 'tool_bangkok'));
    echo html_writer::tag('th', 'แก้ไข');
    echo html_writer::tag('th', 'ลบ');
    echo html_writer::end_tag('tr');
    echo html_writer::end_tag('thead');

    foreach ($projects as $project) {
        echo html_writer::start_tag('tr');
        // ลิงค์ชื่อโปรเจกต์ไปยัง viewproject.php โดยมี ID โปรเจกต์เป็นพารามิเตอร์
        echo html_writer::start_tag('td');
        echo html_writer::start_tag('ul'); // เริ่ม unordered list เพื่อใส่ bullets
        echo html_writer::start_tag('li'); // เริ่ม list item สำหรับ bullets
        echo html_writer::link(new moodle_url('/admin/tool/bangkok/viewproject.php', array('id' => $project->id)), $project->name);
        echo html_writer::end_tag('td');
        echo html_writer::start_tag('td');
        echo $project->fiscal_year;
        echo html_writer::end_tag('td');
        echo html_writer::start_tag('td');
        echo $project->responsible_name; // แสดงชื่อผู้รับผิดชอบ
        echo html_writer::end_tag('li'); // จบ list item
        echo html_writer::end_tag('ul'); // จบ unordered list
        echo html_writer::end_tag('td');
        echo html_writer::start_tag('td');
        echo html_writer::link(new moodle_url('/admin/tool/bangkok/editproject.php', array('id' => $project->id)), '<i class="fas fa-edit"></i>');
        echo html_writer::end_tag('td');
        echo html_writer::start_tag('td');
        echo html_writer::link(new moodle_url('/admin/tool/bangkok/deleteproject.php', array('id' => $project->id)), '<i class="fas fa-trash-alt"></i>');
        echo html_writer::end_tag('td');
        echo html_writer::end_tag('tr');
    }
    
    echo html_writer::end_tag('table');
    
} else {
    echo html_writer::tag('p', 'ไม่มีโครงการใดๆ');
}

// ส่วนปุ่ม
echo html_writer::start_tag('div', array('class' => 'button-container'));

// ปุ่มเพิ่มโปรเจกต์พร้อมไอคอน
echo html_writer::link(new moodle_url('/admin/tool/bangkok/addproject.php'), '<i class="fas fa-add"></i> ' .get_string('addproject', 'tool_bangkok'), array('class' => 'btn btn-primary'));

// ปุ่มกลับไปที่หน้าหลักของโมดูลพร้อมไอคอน
echo html_writer::link(new moodle_url('/admin/tool/bangkok/'), '<i class="fas fa-arrow-left"></i> ' . get_string('back_to_main_page', 'tool_bangkok'), array('class' => 'btn btn-secondary'));

echo html_writer::end_tag('div');

echo $OUTPUT->footer();
?>
