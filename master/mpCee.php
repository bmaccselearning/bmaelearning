<?php
require_once(__DIR__ . '/../config.php');
require_login();
require_once($CFG->dirroot . '/my/lib.php');
$PAGE->set_title('โครงสร้างองค์กร แยกเป็นผู้บริหารและระดับปฏิบัติงาน');
$PAGE->set_heading($site->fullname);
echo $OUTPUT->header();
echo "<script type=\"text/javascript\" src=\"https://code.jquery.com/jquery-3.7.0.js\"></script>";
echo "<script type=\"text/javascript\" src=\"https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js\"></script>";
echo "<script type=\"text/javascript\" src=\"ajax/js/dep.js\"></script>";
echo "<script> window.onload = function() {showMpCee();}; </script>";
echo "<h3>ประเภทระดับ</h3>";
echo "<span id='mainTable'></span>";
echo $OUTPUT->footer();