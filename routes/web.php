<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $checks = [];

    $checks[] = [
        'PHP 8.2 or higher',
        version_compare(PHP_VERSION, '8.2.0', '>='),
        'You have PHP '.PHP_VERSION.'.',
    ];

    foreach (['pdo_sqlite', 'mbstring', 'openssl', 'tokenizer', 'xml', 'ctype', 'fileinfo', 'filter'] as $extension) {
        $checks[] = [
            "PHP extension: {$extension}",
            extension_loaded($extension),
            extension_loaded($extension) ? 'Enabled.' : 'Not enabled. Turn it on in php.ini (run php --ini to find the file).',
        ];
    }

    try {
        $name = User::query()->value('name');
        $checks[] = ['Database read', $name === 'Test User', 'Read the sample user from the database.'];
    } catch (\Throwable $e) {
        $checks[] = ['Database read', false, $e->getMessage()];
    }

    try {
        session(['env_check' => 'ok']);
        $checks[] = ['Session storage', session('env_check') === 'ok', 'Sessions can be written.'];
    } catch (\Throwable $e) {
        $checks[] = ['Session storage', false, $e->getMessage()];
    }

    $git = null;
    if (function_exists('exec')) {
        @exec('git --version 2>&1', $output, $code);
        $git = $code === 0 ? trim($output[0] ?? '') : null;
    }
    $checks[] = ['Git installed', $git !== null, $git ?? 'Git was not found. Install it from https://git-scm.com and restart VS Code.'];

    $ready = collect($checks)->every(fn ($check) => $check[1]);

    return view('check', compact('checks', 'ready'));
});
