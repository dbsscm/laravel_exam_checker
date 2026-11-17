<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exam environment check</title>
    <style>
        body { margin: 0; font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif; color: #1d2733; background: #f5f7f9; line-height: 1.5; }
        main { max-width: 720px; margin: 0 auto; padding: 2rem 1.25rem; }
        h1 { font-size: 1.5rem; margin: 0 0 0.5rem; }
        .result { padding: 1rem 1.1rem; border-radius: 6px; margin: 1rem 0 1.5rem; font-weight: 600; }
        .ready { background: #e6f4ea; color: #1e6b3a; }
        .not-ready { background: #fbe9e7; color: #9b2c1f; }
        table { width: 100%; border-collapse: collapse; background: #fff; border: 1px solid #d9e0e6; }
        td { padding: 0.6rem 0.9rem; border-bottom: 1px solid #d9e0e6; vertical-align: top; }
        .pass { color: #1e6b3a; font-weight: 600; white-space: nowrap; }
        .fail { color: #9b2c1f; font-weight: 600; white-space: nowrap; }
        .detail { color: #5d6b7a; font-size: 0.9rem; }
    </style>
</head>
<body>
<main>
    <h1>Exam environment check</h1>
    @if ($ready)
        <p class="result ready">Your machine is ready for the exam. Let your interviewer know.</p>
    @else
        <p class="result not-ready">Some checks failed. Fix the items marked "Fix needed", restart <code>php artisan serve</code>, and reload this page.</p>
    @endif
    <table>
        @foreach ($checks as [$label, $passed, $detail])
            <tr>
                <td class="{{ $passed ? 'pass' : 'fail' }}">{{ $passed ? 'Passed' : 'Fix needed' }}</td>
                <td>{{ $label }}<br><span class="detail">{{ $detail }}</span></td>
            </tr>
        @endforeach
    </table>
</main>
</body>
</html>
