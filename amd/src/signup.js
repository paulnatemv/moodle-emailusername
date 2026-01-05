/**
 * Email as Username - Signup form handler
 *
 * @module     local_emailusername/signup
 * @copyright  2025 BixAgency.com
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define([], function() {
    'use strict';

    /**
     * Initialize the signup form modifications.
     *
     * @param {Object} config Configuration options.
     * @param {boolean} config.hideusername Whether to completely hide the username field.
     */
    var init = function(config) {
        // Wait for DOM to be ready.
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', function() {
                setupForm(config);
            });
        } else {
            setupForm(config);
        }
    };

    /**
     * Setup the form modifications.
     *
     * @param {Object} config Configuration options.
     */
    var setupForm = function(config) {
        var usernameField = document.getElementById('id_username');
        var emailField = document.getElementById('id_email');

        if (!usernameField || !emailField) {
            return;
        }

        // Find the username form group (parent container).
        var usernameGroup = usernameField.closest('.form-group, .fitem');

        if (config.hideusername) {
            // Completely hide the username field.
            if (usernameGroup) {
                usernameGroup.style.display = 'none';
            }
        } else {
            // Make username field readonly with visual styling.
            usernameField.readOnly = true;
            usernameField.style.backgroundColor = '#e9ecef';
            usernameField.style.cursor = 'not-allowed';
            usernameField.style.color = '#6c757d';
            usernameField.setAttribute('tabindex', '-1');

            // Add a visual indicator.
            usernameField.placeholder = getPlaceholderText();
        }

        // Copy email to username on input.
        emailField.addEventListener('input', function() {
            var email = emailField.value.trim().toLowerCase();
            usernameField.value = email;
        });

        // Also handle paste events.
        emailField.addEventListener('paste', function() {
            setTimeout(function() {
                var email = emailField.value.trim().toLowerCase();
                usernameField.value = email;
            }, 10);
        });

        // Ensure username is set on form submit.
        var form = emailField.closest('form');
        if (form) {
            form.addEventListener('submit', function() {
                var email = emailField.value.trim().toLowerCase();
                usernameField.value = email;
            });
        }

        // If email already has a value, copy it.
        if (emailField.value) {
            usernameField.value = emailField.value.trim().toLowerCase();
        }
    };

    /**
     * Get placeholder text based on browser language.
     *
     * @return {string} Placeholder text.
     */
    var getPlaceholderText = function() {
        // Simple placeholder - will be replaced by email.
        return '← Auto-filled from email';
    };

    return {
        init: init
    };
});
