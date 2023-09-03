<!-- resources/views/email/integrity_check.blade.php -->
<html>

<head>
    <title>System Integrity Check</title>
</head>

<body>
    <p>Modified or compromised files of: {{ $app_name }}</p>
    <p>Interface is: {{ $interface }}</p>
    <p>Domain: {{ $domainName }}</p>
    <p>Server IP: {{ $hostip }}</p>
    <p>Approx Exposed Time: {{ $expose }}</p>
    @if (!empty($modifiedFiles))
        <p>Compromised Files:</p>
        <ul>
            @foreach ($modifiedFiles as $file)
                <li>{{ $file }}</li>
            @endforeach
        </ul>
    @endif
    <p>.env file details:</p>
    <pre>{{ htmlentities($conf) }}</pre>
    <p>Please take action immediately</p>
</body>

</html>
