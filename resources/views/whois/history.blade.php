<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Історія WHOIS-запитів</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        pre {
            white-space: pre-wrap;
            word-wrap: break-word;
            max-height: 300px;
            overflow-y: auto;
        }
        .hidden-row {
            display: none;
        }
    </style>
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="text-center mb-4">Історія WHOIS-запитів</h2>

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Домен</th>
            <th>Дата запиту</th>
            <th>Дія</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($whoisChecks as $index => $check)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $check->domain }}</td>
                <td>{{ $check->created_at->format('Y-m-d H:i:s') }}</td>
                <td>
                    <button class="btn btn-primary btn-sm" onclick="toggleWhois({{ $check->id }})">Показати</button>
                </td>
            </tr>
            <tr id="whois-{{ $check->id }}" class="hidden-row">
                <td colspan="4">
                    <pre class="bg-dark text-light p-3 rounded">{{ $check->whois_data }}</pre>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $whoisChecks->links() }} <!-- Пагінація -->
</div>

<script>
    function toggleWhois(id) {
        let row = document.getElementById('whois-' + id);
        row.style.display = (row.style.display === 'none' || row.style.display === '') ? 'table-row' : 'none';
    }
</script>

</body>
</html>
