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
 * Library functions for local_emailusername.
 *
 * @package    local_emailusername
 * @copyright  2025 BixAgency.com
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Extend the signup form to auto-populate username with email.
 *
 * @param MoodleQuickForm $mform The signup form.
 * @return void
 */
function local_emailusername_extend_signup_form($mform) {
    global $PAGE;

    // Check if plugin is enabled.
    if (!get_config('local_emailusername', 'enabled')) {
        return;
    }

    $hideusername = get_config('local_emailusername', 'hideusername');
    $showinfo = get_config('local_emailusername', 'showinfo');

    // Add info message if enabled - insert it before the username field.
    if ($showinfo && !$hideusername) {
        $infomessage = get_string('infomessage', 'local_emailusername');
        $infoelement = $mform->createElement('static', 'emailusername_info', '',
            '<div class="alert alert-info small mb-3">' . $infomessage . '</div>');
        $mform->insertElementBefore($infoelement, 'username');
    }

    // Load the JavaScript module.
    // Note: js_call_amd passes each array element as a separate argument,
    // so we wrap our config object in another array.
    $PAGE->requires->js_call_amd('local_emailusername/signup', 'init', [
        ['hideusername' => (bool) $hideusername],
    ]);
}

/**
 * Validate the signup form - ensure username matches email.
 *
 * @param array $data The form data.
 * @return array Array of errors.
 */
function local_emailusername_validate_extend_signup_form($data) {
    $errors = [];

    // Check if plugin is enabled.
    if (!get_config('local_emailusername', 'enabled')) {
        return $errors;
    }

    // Username should match email (case-insensitive).
    if (!empty($data['email']) && !empty($data['username'])) {
        $email = core_text::strtolower(trim($data['email']));
        $username = core_text::strtolower(trim($data['username']));

        if ($username !== $email) {
            $errors['username'] = get_string('usernamemustmatchemail', 'local_emailusername');
        }
    }

    return $errors;
}

/**
 * Pre-process signup data to ensure username = email.
 * This is called before the user is created.
 *
 * @param array $data The signup data.
 * @return array Modified data.
 */
function local_emailusername_pre_signup_requests() {
    // Check if plugin is enabled.
    if (!get_config('local_emailusername', 'enabled')) {
        return;
    }

    // This hook is called before signup, we'll handle data in post_signup if needed.
}
