<?php
// This file is part of Moodle - http://moodle.org/
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
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Plugin settings.
 *
 * @package    local_emailusername
 * @copyright  2025 BixAgency.com
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
    $settings = new admin_settingpage('local_emailusername', get_string('pluginname', 'local_emailusername'));

    // Enable/disable plugin.
    $settings->add(new admin_setting_configcheckbox(
        'local_emailusername/enabled',
        get_string('enabled', 'local_emailusername'),
        get_string('enabled_desc', 'local_emailusername'),
        1
    ));

    // Hide username field completely (alternative to graying out).
    $settings->add(new admin_setting_configcheckbox(
        'local_emailusername/hideusername',
        get_string('hideusername', 'local_emailusername'),
        get_string('hideusername_desc', 'local_emailusername'),
        0
    ));

    // Show info message to users.
    $settings->add(new admin_setting_configcheckbox(
        'local_emailusername/showinfo',
        get_string('showinfo', 'local_emailusername'),
        get_string('showinfo_desc', 'local_emailusername'),
        1
    ));

    $ADMIN->add('localplugins', $settings);
}
