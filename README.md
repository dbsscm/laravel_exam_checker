# Exam Environment Check

Please run this check **before your exam day**. It uses the same setup as the exam, so if it works here, it will work on the day.

It takes about 5 minutes.

---

## What you need

- **PHP 8.2 or higher**
- **Git**
- **VS Code**

You do **not** need Node.js.

You only need **Composer** and an **internet connection** if the `vendor` folder is missing. See [Fixing the missing `vendor` folder](#fixing-the-missing-vendor-folder).

---

## Run the check

1. **Open this folder in VS Code.**

2. **Create your `.env` file.**
   In the VS Code Explorer, right-click `.env.example` > **Rename**, and rename it to `.env`.
   *(If a `.env` file is already there, skip this step.)*

3. **Start the app.**
   Open a terminal (**Terminal > New Terminal**) and run:

   ```
   php artisan serve
   ```

4. **Open the app in your browser:** http://127.0.0.1:8000

5. **Read the result.**
   - ✅ If you see **"Your machine is ready for the exam"**, you're done. Let your interviewer know.
   - ⚠️ If any check says **"Fix needed"**:
     1. Follow the note shown next to that check.
     2. Stop the server with `Ctrl+C`.
     3. Run `php artisan serve` again.
     4. Reload the page.

---

## Before exam day: AI extensions

The exam is done without AI tools. Make sure you know how to **disable AI extensions in VS Code** (such as GitHub Copilot) before the exam starts.

---

## Troubleshooting

Find the message you see, then apply the fix. After any fix, restart the server (`Ctrl+C`, then `php artisan serve`).

| If you see... | What it means | What to do |
|---|---|---|
| `php` is not recognized | PHP isn't installed or isn't on your PATH. | Install PHP 8.2+, then restart VS Code. |
| `No application encryption key has been specified`, or other config errors | The `.env` file is missing. | Rename `.env.example` to `.env` (step 2). |
| `could not find driver` | The SQLite driver is turned off in PHP. | Enable `pdo_sqlite` in `php.ini`. Run `php --ini` to find where that file is. |
| `Failed opening required ... vendor/autoload.php`, or `Failed to open stream: No such file or directory ... artisan on line 10` | The `vendor` folder is missing. It isn't stored in Git, so `git clone` doesn't include it. | Run `composer install`. See [Fixing the missing `vendor` folder](#fixing-the-missing-vendor-folder). |
| `Class "..." not found` | The `vendor` folder is incomplete. | Run `composer install`. See the section below. |
| `Class ... not found` or `Unable to read ... services.php` **after moving or copying the folder** | Cached files still point to the old location. | Delete `bootstrap/cache/packages.php` and `bootstrap/cache/services.php`. They're rebuilt automatically. |
| Autoload errors still appear | The autoloader needs rebuilding. | If Composer is installed, run `composer dump-autoload` in the project folder. |
| `Address already in use` | Port 8000 is already being used. | Run `php artisan serve --port=8080` and open http://127.0.0.1:8080 instead. |

---

## Fixing the missing `vendor` folder

If you see this when running `php artisan serve`:

```
PHP Warning:  require(.../vendor/autoload.php): Failed to open stream: No such file or directory in .../artisan on line 10
Uncaught Error: Failed opening required '.../vendor/autoload.php'
```

the `vendor` folder (the PHP dependencies) is missing. Install it with Composer:

1. **Install Composer** from https://getcomposer.org/download/ (internet needed), then restart VS Code.
   Check that it worked:

   ```
   composer --version
   ```

2. **Install the dependencies.** In the VS Code terminal, make sure you're in the project folder (the one that contains the `artisan` file), then run:

   ```
   composer install
   ```

3. **Check** that a `vendor` folder now appears next to `artisan`.

4. **Start the app again:**

   ```
   php artisan serve
   ```

**Still not working?** Delete `bootstrap/cache/packages.php` and `bootstrap/cache/services.php`, then restart the server.