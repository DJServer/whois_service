<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WHOIS Checker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="text-center mb-4">WHOIS Checker</h2>

    <div class="card shadow p-4">
        <div class="mb-3">
            <label for="domain" class="form-label">Введіть домен:</label>
            <input type="text" id="domain" class="form-control" placeholder="example.com">
        </div>
        <button id="checkWhois" class="btn btn-primary w-100">Перевірити</button>
    </div>

    <div id="loading" class="text-center mt-4 d-none">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Завантаження...</span>
        </div>
        <p class="mt-2">Обробка запросу...</p>
    </div>

    <div id="result" class="mt-4 card p-3 shadow d-none">
        <h5>Результат:</h5>
        <pre id="whoisData" class="p-3 bg-dark text-light rounded"></pre>
    </div>
</div>

<script>
    document.getElementById('checkWhois').addEventListener('click', function () {
        let domain = document.getElementById('domain').value.trim();
        if (!domain) {
            alert('Введіть домен!');
            return;
        }

        document.getElementById('result').classList.add('d-none');
        document.getElementById('loading').classList.remove('d-none');

        fetch(`/api/whois?domain=${encodeURIComponent(domain)}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('loading').classList.add('d-none');

                if (data.error) {
                    document.getElementById('whoisData').textContent = "Помилка: " + data.error;
                } else {
                    document.getElementById('whoisData').textContent = data.whois_data;
                }

                document.getElementById('result').classList.remove('d-none');
            })
            .catch(error => {
                document.getElementById('loading').classList.add('d-none');
                document.getElementById('whoisData').textContent = "Помилка запроса";
                document.getElementById('result').classList.remove('d-none');
            });
    });
</script>

</body>
</html>
