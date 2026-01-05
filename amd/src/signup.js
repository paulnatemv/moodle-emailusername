/**
 * Email as Username - Signup form handler
 *
 * @module     local_emailusername/signup
 * @copyright  2025 BixAgency.com
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define([], function() {
    'use strict';

    /** @type {number} Minimum password length */
    var minLength = 8;

    /**
     * Initialize the signup form modifications.
     *
     * @param {Object} config Configuration options.
     * @param {boolean} config.hideusername Whether to completely hide the username field.
     * @param {number} config.minlength Minimum password length.
     */
    var init = function(config) {
        minLength = config.minlength || 8;

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
        var passwordField = document.getElementById('id_password');

        // Setup username field.
        if (usernameField && emailField) {
            setupUsernameField(usernameField, emailField, config);
        }

        // Setup password requirements.
        if (passwordField) {
            setupPasswordRequirements(passwordField);
        }

        // Reorder fields: Email first, then password.
        reorderFields();
    };

    /**
     * Setup username field behavior.
     *
     * @param {HTMLElement} usernameField Username input.
     * @param {HTMLElement} emailField Email input.
     * @param {Object} config Configuration.
     */
    var setupUsernameField = function(usernameField, emailField, config) {
        if (config.hideusername) {
            // Add body class to trigger CSS hiding (more reliable).
            document.body.classList.add('emailusername-hide-username');

            // Also hide via JS as backup.
            var usernameGroup = usernameField.closest('.form-group, .fitem, [data-groupname="username"]');
            if (usernameGroup) {
                usernameGroup.style.display = 'none';
            }
            usernameField.style.display = 'none';

            // Hide label if separate.
            var label = document.querySelector('label[for="id_username"]');
            if (label) {
                var labelGroup = label.closest('.form-group, .fitem');
                if (labelGroup) {
                    labelGroup.style.display = 'none';
                }
            }
        } else {
            // Make username field readonly with visual styling.
            usernameField.readOnly = true;
            usernameField.style.backgroundColor = '#e9ecef';
            usernameField.style.cursor = 'not-allowed';
            usernameField.style.color = '#6c757d';
            usernameField.setAttribute('tabindex', '-1');
            usernameField.placeholder = '← Auto-filled from email';
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
     * Setup password requirements live validation.
     *
     * @param {HTMLElement} passwordField Password input.
     */
    var setupPasswordRequirements = function(passwordField) {
        var requirements = {
            'req-length': function(pwd) {
                return pwd.length >= minLength;
            },
            'req-lowercase': function(pwd) {
                return /[a-z]/.test(pwd);
            },
            'req-uppercase': function(pwd) {
                return /[A-Z]/.test(pwd);
            },
            'req-number': function(pwd) {
                return /[0-9]/.test(pwd);
            },
            'req-special': function(pwd) {
                return /[^a-zA-Z0-9]/.test(pwd);
            }
        };

        /**
         * Check all requirements and update UI.
         */
        var checkRequirements = function() {
            var password = passwordField.value;

            for (var reqId in requirements) {
                if (requirements.hasOwnProperty(reqId)) {
                    var badge = document.getElementById(reqId);
                    if (badge) {
                        var met = requirements[reqId](password);
                        if (met) {
                            badge.classList.add('met');
                        } else {
                            badge.classList.remove('met');
                        }
                    }
                }
            }
        };

        // Check on input.
        passwordField.addEventListener('input', checkRequirements);
        passwordField.addEventListener('paste', function() {
            setTimeout(checkRequirements, 10);
        });

        // Initial check.
        if (passwordField.value) {
            checkRequirements();
        }
    };

    /**
     * Reorder form fields to put email first.
     */
    var reorderFields = function() {
        var form = document.querySelector('form.mform');
        if (!form) {
            return;
        }

        // Get the field groups.
        var usernameGroup = document.getElementById('id_username');
        var emailGroup = document.getElementById('id_email');
        var email2Group = document.getElementById('id_email2');

        if (!usernameGroup || !emailGroup) {
            return;
        }

        // Get the form row containers.
        usernameGroup = usernameGroup.closest('.form-group, .fitem, [data-groupname]');
        emailGroup = emailGroup.closest('.form-group, .fitem, [data-groupname]');

        if (email2Group) {
            email2Group = email2Group.closest('.form-group, .fitem, [data-groupname]');
        }

        // Move email fields before username.
        if (usernameGroup && emailGroup && usernameGroup.parentNode === emailGroup.parentNode) {
            var parent = usernameGroup.parentNode;

            // Move email before username.
            parent.insertBefore(emailGroup, usernameGroup);

            // Move email2 after email.
            if (email2Group) {
                emailGroup.parentNode.insertBefore(email2Group, usernameGroup);
            }
        }
    };

    return {
        init: init
    };
});
