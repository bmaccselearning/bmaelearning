<?php

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) { // เมื่อผู้ดูแลระบบเข้ามาที่หน้าเว็บไซต์
    $ADMIN->add('root', new admin_category('categoryname', get_string('categoryname', 'pluginname')));
    
    $ADMIN->add('root', new admin_externalpage('pagename', get_string('pagetitle', 'pluginname'), 
        "$CFG->wwwroot/admin/tool/bangkok/index.php", array('moodle/site:config')));
}
/**
 * Library of functions and constants for module strategic
 */

/**
 * Standard function for returning the instance of the module.
 *
 * @param int $id
 * @return stdClass|null
 */
function strategic_get_instance($id) {
    return get_record('strategic', 'id', $id);
}

/**
 * Add/update a strategic instance
 *
 * @param stdClass $strategic
 * @return int|false
 */
function strategic_add_instance($strategic) {
    $strategic->timemodified = time();
    if ($strategic->id) {
        return update_record('strategic', $strategic);
    } else {
        $strategic->timecreated = $strategic->timemodified;
        return insert_record('strategic', $strategic);
    }
}

/**
 * Delete a strategic instance
 *
 * @param int $id
 * @return bool
 */
function strategic_delete_instance($id) {
    return delete_records('strategic', 'id', $id);
}

/**
 * Add/update a strategic sub instance
 *
 * @param stdClass $strategic_sub
 * @return int|false
 */
function strategic_add_sub_instance($strategic_sub) {
    return insert_record('strategic_sub', $strategic_sub);
}

/**
 * Delete a strategic sub instance
 *
 * @param int $id
 * @return bool
 */
function strategic_delete_sub_instance($id) {
    return delete_records('strategic_sub', 'id', $id);
}
