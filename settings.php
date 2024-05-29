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
 * Plugin administration pages are defined here.
 *
 * @package     mod_exportgrades
 * @category    admin
 * @copyright   2024 Your Name <you@example.com>
 * @license     https://www.gnu.org/copyleft/gpl.moodle.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($ADMIN->fulltree) {
    $settings = new admin_settingpage('mod_exportgrades_settings', get_string('pluginname', 'mod_exportgrades'));

    $settings->add(new admin_setting_configselect(
        'mod_exportgrades/frequency',
        get_string('frequency', 'mod_exportgrades'),
        get_string('frequency_desc', 'mod_exportgrades'),
        'daily',
        array(
            'daily' => get_string('daily', 'mod_exportgrades'),
            'weekly' => get_string('weekly', 'mod_exportgrades'),
            'monthly' => get_string('monthly', 'mod_exportgrades')
        )
    ));

    $settings->add(new admin_setting_configtext(
        'mod_exportgrades/drive_folder_id',
        get_string('drivefolderid', 'mod_exportgrades'),
        get_string('drivefolderid_desc', 'mod_exportgrades'),
        ''
    ));

    $settings->add(new admin_setting_configtextarea(
        'mod_exportgrades/drive_service_account_credentials',
        get_string('drivecredentials', 'mod_exportgrades'),
        get_string('drivecredentials_desc', 'mod_exportgrades'),
        ''
    ));

    $settings->add(new admin_setting_heading(
        'headerconfig',
        get_string('headerconfig', 'mod_exportgrades'),
        get_string('descconfig', 'mod_exportgrades')
    ));
    
    $current_language = current_language();  // Obtiene el idioma actual de Moodle
    $settings->add(new admin_setting_configselect(
        'mod_exportgrades/language',
        get_string('language', 'mod_exportgrades'),
        get_string('languagedesc', 'mod_exportgrades'),
        $current_language, $langoptions
    ));

    $ADMIN->add('modules', $settings);
}
