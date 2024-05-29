<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Library of interface functions and constants.
 *
 * @package     mod_exportgrades
 * @copyright   2024 Your Name <you@example.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Return if the plugin supports $feature.
 *
 * @param string $feature Constant representing the feature.
 * @return true | null True if the feature is supported, null otherwise.
 */

require_once($CFG->libdir . '/excellib.class.php'); 

function exportgrades_supports($feature) {
    switch ($feature) {
        case FEATURE_MOD_INTRO:
            return true;
        default:
            return null;
    }
}

function exportgrades_generate_excel($categoryid) {
    global $DB, $CFG;

    // Crear un nuevo documento Excel
    $filename = 'exported_grades_' . $categoryid . '.xlsx';
    $filepath = $CFG->dataroot . '/temp/' . $filename;
    $workbook = new \MoodleExcelWorkbook($filepath);
    $sheet = $workbook->add_worksheet(get_string('grades'));

    // Encabezados de la hoja de cálculo
    $headers = array('Curso', 'ID Estudiante', 'Nombre Item', 'Calificación Final');
    $rownum = 0;
    $colnum = 0;
    foreach ($headers as $header) {
        $sheet->write_string($rownum, $colnum++, $header);
    }
    $rownum++;

    // Obtener cursos en la categoría
    $courses = $DB->get_records('course', array('category' => $categoryid));
    foreach ($courses as $course) {
        $grades = $DB->get_records_sql("
            SELECT gg.*, gi.itemname, u.firstname, u.lastname
            FROM {grade_grades} gg
            JOIN {grade_items} gi ON gi.id = gg.itemid
            JOIN {user} u ON u.id = gg.userid
            WHERE gi.courseid = ? AND gg.finalgrade IS NOT NULL
        ", array($course->id));

        foreach ($grades as $grade) {
            $sheet->write_string($rownum, 0, $course->fullname);
            $sheet->write_string($rownum, 1, $grade->userid);
            $sheet->write_string($rownum, 2, $grade->itemname);
            $sheet->write_string($rownum, 3, $grade->finalgrade);
            $rownum++;
        }
    }

    // Cerrar el documento Excel y guardar el archivo
    $workbook->close();

    return $filepath;
}


/**
 * Saves a new instance of the mod_exportgrades into the database.
 *
 * Given an object containing all the necessary data, (defined by the form
 * in mod_form.php) this function will create a new instance and return the id
 * number of the instance.
 *
 * @param object $moduleinstance An object from the form.
 * @param mod_exportgrades_mod_form $mform The form.
 * @return int The id of the newly inserted record.
 */
function exportgrades_add_instance($moduleinstance, $mform = null) {
    global $DB;

    $moduleinstance->timecreated = time();

    $id = $DB->insert_record('exportgrades', $moduleinstance);

    return $id;
}

/**
 * Updates an instance of the mod_exportgrades in the database.
 *
 * Given an object containing all the necessary data (defined in mod_form.php),
 * this function will update an existing instance with new data.
 *
 * @param object $moduleinstance An object from the form in mod_form.php.
 * @param mod_exportgrades_mod_form $mform The form.
 * @return bool True if successful, false otherwise.
 */
function exportgrades_update_instance($moduleinstance, $mform = null) {
    global $DB;

    $moduleinstance->timemodified = time();
    $moduleinstance->id = $moduleinstance->instance;

    return $DB->update_record('exportgrades', $moduleinstance);
}

/**
 * Removes an instance of the mod_exportgrades from the database.
 *
 * @param int $id Id of the module instance.
 * @return bool True if successful, false on failure.
 */
function exportgrades_delete_instance($id) {
    global $DB;

    $exists = $DB->get_record('exportgrades', array('id' => $id));
    if (!$exists) {
        return false;
    }

    $DB->delete_records('exportgrades', array('id' => $id));

    return true;
}
