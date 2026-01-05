# Email as Username - Moodle Plugin

A simple, free plugin that lets users register and login with their email address instead of a separate username. Features a beautiful password requirements UI with live validation.

![Moodle](https://img.shields.io/badge/Moodle-4.5%2B-orange)
![PHP](https://img.shields.io/badge/PHP-8.1%2B-blue)
![License](https://img.shields.io/badge/License-GPL%20v3-green)

## The Problem

```
❌ BEFORE: Confusing Registration
┌────────────────────────────────────────────────┐
│                                                │
│  Username     [ john123            ]           │  ← Users forget this!
│                                                │
│  Password     [ ************       ]           │
│                                                │
│  "The password must have at least 8            │  ← Ugly wall of text!
│   characters, at least 1 digit(s),             │
│   at least 1 lower case letter(s)..."          │
│                                                │
│  Email        [ john@example.com   ]           │
│                                                │
└────────────────────────────────────────────────┘

Result: 😫 Users forget username → Can't login → Contact support
```

## The Solution

```
✅ AFTER: Clean & Simple Registration
┌────────────────────────────────────────────────┐
│                                                │
│  ℹ️ Your email will be used as your username   │
│                                                │
│  Email        [ john@example.com   ]           │  ← Email FIRST
│  Confirm      [ john@example.com   ]           │
│                                                │
│  Password     [ ************       ]           │
│                                                │
│  ┌──────────────────────────────────────────┐  │
│  │  PASSWORD REQUIREMENTS                   │  │
│  │  ┌─────────────┐  ┌─────────────┐       │  │
│  │  │ ✓ 8+ chars  │  │ ✓ Lowercase │       │  │  ← Beautiful UI!
│  │  └─────────────┘  └─────────────┘       │  │
│  │  ┌─────────────┐  ┌─────────────┐       │  │
│  │  │ ✓ Uppercase │  │ ✓ Number    │       │  │  ← Live validation!
│  │  └─────────────┘  └─────────────┘       │  │
│  │  ┌─────────────┐                        │  │
│  │  │ ○ Special   │                        │  │
│  │  └─────────────┘                        │  │
│  └──────────────────────────────────────────┘  │
│                                                │
│  Username     [ john@example.com   ] 🔒       │  ← Auto-filled (hidden)
│                                                │
└────────────────────────────────────────────────┘

Result: 😊 Users login with email → Never forget!
```

## Features

### Core Features
- **Email as Username** - Username auto-populates from email field
- **Hide Username Field** - Option to completely hide it (cleaner form)
- **Field Reordering** - Email appears first, then password

### Beautiful Password UI
- **Visual Requirements** - Grid layout showing each requirement
- **Live Validation** - Checkmarks appear as user types
- **Replaces Ugly Text** - Removes default Moodle password policy text
- **Mobile Responsive** - Works great on phones

### Technical
- **Server-side Validation** - Ensures username always matches email
- **Zero Configuration** - Works immediately after installation
- **CSS + JavaScript** - Reliable hiding with both methods

## Screenshots

### Password Requirements (Before & After)

**Before (Default Moodle):**
> "The password must have at least 8 characters, at least 1 digit(s), at least 1 lower case letter(s), at least 1 upper case letter(s), at least 1 special character(s) such as *, -, or #"

**After (With Plugin):**
```
┌─────────────────────────────────────────────────────┐
│  PASSWORD REQUIREMENTS                              │
│  ┌──────────────────┐  ┌──────────────────┐        │
│  │ ✓ 8+ characters  │  │ ✓ One lowercase  │        │
│  └──────────────────┘  └──────────────────┘        │
│  ┌──────────────────┐  ┌──────────────────┐        │
│  │ ✓ One uppercase  │  │ ✓ One number     │        │
│  └──────────────────┘  └──────────────────┘        │
│  ┌──────────────────┐                              │
│  │ ○ One special    │  ← Not met yet               │
│  └──────────────────┘                              │
└─────────────────────────────────────────────────────┘
```

## Installation

### Method 1: Upload ZIP (Recommended)
1. Download the latest release ZIP file
2. Go to **Site Administration → Plugins → Install plugins**
3. Upload the ZIP file
4. Follow the installation prompts

### Method 2: Git
```bash
cd /path/to/moodle/local
git clone https://github.com/paulnatemv/moodle-emailusername.git emailusername
```

## Configuration

Go to **Site Administration → Plugins → Local plugins → Email as Username**

| Setting | Description | Default |
|---------|-------------|---------|
| **Enable** | Turn the feature on/off | On |
| **Hide username field** | Completely hide instead of graying out | Off |
| **Show info message** | Display helpful message to users | On |

## How It Works

1. **User visits registration page**
2. **Plugin reorders fields** - Email appears first
3. **Plugin adds password UI** - Beautiful requirements grid
4. **User types email** → Username auto-fills
5. **User types password** → Requirements check live
6. **Form submits** with username = email
7. **User logs in with email** - Never forgets!

## Requirements

- Moodle 4.5 or higher (compatible with Moodle 5)
- PHP 8.1 or higher
- Email-based self-registration enabled
- **Extended username characters enabled** (see below)

### Required: Enable Extended Username Characters

For email addresses to work as usernames (they contain the `@` symbol), you must enable this Moodle setting:

1. Go to **Site Administration → Security → Site security settings**
2. Find **"Allow extended characters in usernames"** (`extendedusernamechars`)
3. Set it to **Yes**
4. Save changes

> **Note:** The plugin will show a warning in its settings page if this is not enabled.

## Changelog

### v1.1.1
- Added: Settings page warning when "Extended username characters" is not enabled
- Added: Direct link to Site Policies settings from plugin
- Added: Success indicator when properly configured
- Improved: Documentation with clear setup requirements

### v1.1.0
- Fixed: Hide username field now works properly
- Added: Beautiful password requirements UI with live validation
- Added: Field reordering (Email first, then Password)
- Added: CSS styling file
- Removed: Ugly default password policy text

### v1.0.0
- Initial release
- Email as username functionality
- Basic show/hide username options

## FAQ

### Will existing users be affected?
No. This plugin only affects the registration form.

### Does this work with LDAP/SSO?
This plugin only affects email-based self-registration.

### Can I customize the password requirements text?
Yes! Edit the language strings in `/lang/en/local_emailusername.php`

## Contributing

Contributions welcome! Please submit a pull request.

## License

GNU GPL v3 - Free and open source!

## Credits

Developed by [BixAgency.com](https://bixagency.com)

**Free for the Moodle community!**
