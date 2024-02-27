<?php

function xmldb_strategic_upgrade($oldversion) {
    global $DB;

    $dbman = $DB->get_manager();

    if ($oldversion < 2022053000) {
        // Define table strategic to be created.
        $table = new xmldb_table('strategic');

        // Adding fields to table strategic.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('name', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null);
        // Continue adding fields as needed.

        // Adding keys to table strategic.
        $table->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));

        // Conditionally launch create table for strategic.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // strategic savepoint reached.
        upgrade_plugin_savepoint(true, 2022053000, 'strategic');
    }

    if ($oldversion < 2022053000) {
        // Define table strategic_sub to be created.
        $table = new xmldb_table('strategic_sub');

        // Adding fields to table strategic_sub.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('strategic_id', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
        $table->add_field('name', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null);
        // Continue adding fields as needed.

        // Adding keys to table strategic_sub.
        $table->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));

        // Conditionally launch create table for strategic_sub.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // strategic_sub savepoint reached.
        upgrade_plugin_savepoint(true, 2022053000, 'strategic');
    }

    return true;
}
