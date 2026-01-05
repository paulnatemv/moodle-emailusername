# Email as Username - Moodle Plugin

A simple, free plugin that lets users register and login with their email address instead of a separate username.

![Moodle](https://img.shields.io/badge/Moodle-4.5%2B-orange)
![PHP](https://img.shields.io/badge/PHP-8.1%2B-blue)
![License](https://img.shields.io/badge/License-GPL%20v3-green)

## The Problem

When users register for Moodle, they must create a username AND provide an email:

```
Username: [ john123        ]  ← Users forget this!
Email:    [ john@email.com ]
Password: [ ************** ]
```

**Result:** Users forget their username and can't login. They contact support or create duplicate accounts.

## The Solution

This plugin automatically uses the email address as the username:

```
Username: [ john@email.com ]  ← Auto-filled (grayed out)
Email:    [ john@email.com ]
Password: [ ************** ]
```

**Result:** Users login with their email - something they never forget!

## Features

- **Auto-populate username** - Email is copied to username field automatically
- **Read-only username field** - Users can't accidentally change it
- **Option to hide username** - Completely remove the username field from view
- **Info message** - Optional message explaining the login process
- **Server-side validation** - Ensures username always matches email
- **Zero configuration** - Works immediately after installation

## Screenshots

### Before (Standard Moodle)
```
┌────────────────────────────────────────┐
│           Create new account           │
├────────────────────────────────────────┤
│ Username    [                    ]     │
│ Password    [                    ]     │
│ Email       [                    ]     │
│ Email again [                    ]     │
│ First name  [                    ]     │
│ Last name   [                    ]     │
└────────────────────────────────────────┘
```

### After (With Plugin)
```
┌────────────────────────────────────────┐
│           Create new account           │
├────────────────────────────────────────┤
│ ℹ️ Your email will be your username    │
│                                        │
│ Username    [ user@example.com   ] 🔒  │  ← Grayed out, auto-filled
│ Password    [                    ]     │
│ Email       [ user@example.com   ]     │  ← User types here
│ Email again [                    ]     │
│ First name  [                    ]     │
│ Last name   [                    ]     │
└────────────────────────────────────────┘
```

## Installation

### Method 1: Upload ZIP
1. Download the latest release ZIP file
2. Go to **Site Administration → Plugins → Install plugins**
3. Upload the ZIP file
4. Follow the installation prompts

### Method 2: Manual Installation
1. Download and extract the plugin
2. Copy the `emailusername` folder to `/path/to/moodle/local/`
3. Go to **Site Administration → Notifications**
4. Follow the upgrade prompts

### Method 3: Git
```bash
cd /path/to/moodle/local
git clone https://github.com/YOUR_REPO/moodle-emailusername.git emailusername
```

## Configuration

Go to **Site Administration → Plugins → Local plugins → Email as Username**

| Setting | Description | Default |
|---------|-------------|---------|
| **Enable Email as Username** | Turn the feature on/off | On |
| **Hide username field** | Completely hide instead of graying out | Off |
| **Show info message** | Display helpful message to users | On |

## How It Works

1. **User visits registration page**
2. **Plugin loads JavaScript** that modifies the form
3. **Username field becomes read-only** (or hidden)
4. **User types their email** in the email field
5. **Email is automatically copied** to username field
6. **Form submits** with username = email
7. **Server validates** that username matches email
8. **User can now login** using their email address!

## FAQ

### Will existing users be affected?
No. This plugin only affects the registration form. Existing users can still login with their original username.

### Can users still login with username?
Yes! The login form accepts both username and email by default in Moodle.

### What if I disable the plugin?
New users will see the normal registration form again. Existing users registered with email-as-username will still work fine.

### Does this work with LDAP/SSO?
This plugin only affects the standard email-based registration form. It doesn't interfere with LDAP, OAuth, or other authentication methods.

### Is it compatible with other registration plugins?
It should work with most plugins. It uses Moodle's official `extend_signup_form` hook.

## Requirements

- Moodle 4.5 or higher (compatible with Moodle 5)
- PHP 8.1 or higher
- Email-based self-registration enabled

## Troubleshooting

### Username field not grayed out
1. Check that the plugin is enabled in settings
2. Purge all caches: **Site Administration → Development → Purge all caches**
3. Check browser console for JavaScript errors

### Form validation error
If users see "Username must match your email address":
- This means someone tried to tamper with the form
- The server-side validation is working correctly

## Contributing

Contributions are welcome! Please:
1. Fork the repository
2. Create a feature branch
3. Submit a pull request

## License

This plugin is licensed under the [GNU GPL v3](https://www.gnu.org/licenses/gpl-3.0.html).

## Credits

Developed by [BixAgency.com](https://bixagency.com)

**Free and open source** for the Moodle community!

---

**No more forgotten usernames!**
