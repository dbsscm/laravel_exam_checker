# Exam environment check

Run this before your exam day to confirm your machine can run the exam app. It uses the same setup as the exam.

## Requirements

- PHP 8.2 or higher
- Git
- VS Code

Composer, Node.js, and internet access are not needed.

## Steps

1. Open this folder in VS Code.
2. Open a terminal (**Terminal > New Terminal**) and run:

   ```
   php artisan serve
   ```

3. Open http://127.0.0.1:8000 in your browser.
4. If the page says **"Your machine is ready for the exam"**, you're done. Let your interviewer know.
5. If any check says **"Fix needed"**, follow the note next to it, restart the server (`Ctrl+C`, then `php artisan serve` again), and reload the page.

Also make sure AI extensions in VS Code (such as GitHub Copilot) can be disabled before the exam.

## Troubleshooting

| Problem | Fix |
|---|---|
| `php` is not recognized | PHP isn't installed or isn't on your PATH. Install PHP 8.2+ and restart VS Code. |
| `could not find driver` | Enable `pdo_sqlite` in `php.ini`, then restart the server. Run `php --ini` to find the file. |
| `Address already in use` | Run `php artisan serve --port=8080` and open http://127.0.0.1:8080. |
