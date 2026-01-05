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
    global $PAGE, $CFG;

    // Check if plugin is enabled.
    if (!get_config('local_emailusername', 'enabled')) {
        return;
    }

    $hideusername = get_config('local_emailusername', 'hideusername');
    $showinfo = get_config('local_emailusername', 'showinfo');

    // Add info message if enabled.
    if ($showinfo && !$hideusername) {
        $infomessage = get_string('infomessage', 'local_emailusername');
        $infoelement = $mform->createElement('static', 'emailusername_info', '',
            '<div class="alert alert-info small mb-3">
                <i class="fa fa-info-circle mr-2"></i>' . $infomessage . '
            </div>');
        $mform->insertElementBefore($infoelement, 'username');
    }

    // Add compact password requirements UI - simple one-liner with inline badges.
    $passwordhtml = '
    <div class="pwd-req" id="password-requirements">
        <span class="pwd-badge" id="req-length" title="' . get_string('req_length', 'local_emailusername') . '">8+</span>
        <span class="pwd-badge" id="req-lowercase" title="' . get_string('req_lowercase', 'local_emailusername') . '">az</span>
        <span class="pwd-badge" id="req-uppercase" title="' . get_string('req_uppercase', 'local_emailusername') . '">AZ</span>
        <span class="pwd-badge" id="req-number" title="' . get_string('req_number', 'local_emailusername') . '">123</span>
        <span class="pwd-badge" id="req-special" title="' . get_string('req_special', 'local_emailusername') . '">#@!</span>
    </div>';

    // Try to insert after password field.
    $passwordelement = $mform->createElement('static', 'password_requirements_ui', '', $passwordhtml);

    // Check if passwordpolicyinfo exists and insert after it, otherwise after password.
    if ($mform->elementExists('passwordpolicyinfo')) {
        // Hide the ugly default password policy text.
        $mform->removeElement('passwordpolicyinfo');
    }

    // Insert our beautiful password UI after the password field.
    if ($mform->elementExists('password')) {
        $mform->insertElementBefore($passwordelement, 'email');
    }

    // Load the JavaScript module with config.
    $PAGE->requires->js_call_amd('local_emailusername/signup', 'init', [
        [
            'hideusername' => (bool) $hideusername,
            'minlength' => !empty($CFG->minpasswordlength) ? (int) $CFG->minpasswordlength : 8,
        ],
    ]);

    // Add custom CSS for the form.
    $PAGE->requires->css('/local/emailusername/styles.css');
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
 *
 * @param array $data The signup data.
 * @return void
 */
function local_emailusername_pre_signup_requests() {
    // Check if plugin is enabled.
    if (!get_config('local_emailusername', 'enabled')) {
        return;
    }
}
