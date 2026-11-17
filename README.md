# Exam environment check

Run this before your exam day to confirm your machine can run the exam app. It uses the same setup as the exam.

## Requirements

- PHP 8.2 or higher
- Git
- VS Code

Composer, Node.js, and internet access are not needed.

## Steps

1. Open this folder in VS Code.
2. Rename `.env.example` to `.env` (in the VS Code Explorer, right-click the file > **Rename**). If `.env` already exists, skip this.
3. Open a terminal (**Terminal > New Terminal**) and run:

   ```
   php artisan serve
   ```

4. Open http://127.0.0.1:8000 in your browser.
5. If the page says **"Your machine is ready for the exam"**, you're done. Let your interviewer know.
6. If any check says **"Fix needed"**, follow the note next to it, restart the server (`Ctrl+C`, then `php artisan serve` again), and reload the page.

Also make sure AI extensions in VS Code (such as GitHub Copilot) can be disabled before the exam.

## Troubleshooting

| Problem | Fix |
|---|---|
| `php` is not recognized | PHP isn't installed or isn't on your PATH. Install PHP 8.2+ and restart VS Code. |
| `No application encryption key has been specified` or config errors | `.env` is missing. Rename `.env.example` to `.env` (step 2), then restart the server. |
| `could not find driver` | Enable `pdo_sqlite` in `php.ini`, then restart the server. Run `php --ini` to find the file. |
| `Failed to open stream: vendor/autoload.php` or `Class "..." not found` | The `vendor` folder is missing or incomplete. Re-download the project as given to you (don't copy only part of the folder) and make sure `vendor` sits next to `artisan`. |
| Autoload errors after moving or copying the folder (`Class ... not found`, `Unable to read ... services.php`) | Delete `bootstrap/cache/packages.php` and `bootstrap/cache/services.php` (they're rebuilt automatically), then restart the server. |
| Autoload errors persist | If Composer is installed, run `composer dump-autoload` in the project folder, then restart the server. |
| `Address already in use` | Run `php artisan serve --port=8080` and open http://127.0.0.1:8080. |
