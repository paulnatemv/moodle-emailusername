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
 * Language strings for local_emailusername.
 *
 * @package    local_emailusername
 * @copyright  2025 BixAgency.com
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// Plugin name.
$string['pluginname'] = 'Email as Username';

// Settings.
$string['enabled'] = 'Enable Email as Username';
$string['enabled_desc'] = 'When enabled, the username field on the registration form will be automatically populated with the email address. Users will then login using their email address.';

$string['hideusername'] = 'Hide username field';
$string['hideusername_desc'] = 'Completely hide the username field instead of showing it as read-only. The username will still be set to the email address.';

$string['showinfo'] = 'Show info message';
$string['showinfo_desc'] = 'Show an informational message on the registration form explaining that the email will be used as the username.';

// Form messages.
$string['infomessage'] = 'Your email address will be used as your username for logging in.';
$string['usernamemustmatchemail'] = 'Username must match your email address.';

// Privacy.
$string['privacy:metadata'] = 'The Email as Username plugin does not store any personal data. It only modifies the registration form behavior.';
