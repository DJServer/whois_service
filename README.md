# whois_service
Структура проекту

app/<br>
├── Domain/                     # Доменний слой<br>
│   ├── Entities/             # Сущности (User, WhoisData)<br>
│   ├── Repositories/         # Контракти репозиторіїв<br>
│   ├── ValueObjects/         # Value обьекти (DomainName)<br>
│<br>
├── Infrastructure/           # Інфраструктурний слой<br>
│   ├── Persistence/          # Репозиторії<br>
│   ├── Http/Controllers/     # Контроллери API<br>
│<br>
├── Application/              # Сервисний слой (бизнес-логика)<br>
│   ├── Services/             # Сервиси<br>
│<br>
├── Providers/                # Сервис-провайдери<br>
│   ├── AppServiceProvider.php<br>
│   ├── RepositoryServiceProvider.php<br>
│
config/<br>
├── whois.php                 # Конфиг WHOIS<br>
# Запуск
Для запуску проекту потрібен Docker.<p>
Також потрібно встановити залежності <p>
<code>
composer install

npm install
</code><br>
Після установки Docker, запуск проекту виконується командою 
<code>./vendor/bin/sail up -d</code><br>
<code>./vendor/bin/sail down</code><br>
Після запуску треба виконати міграції<br>
<code>php artisan migrate</code><br>
<br>
🎨 UI

Фронтенд:

    Bootstrap 5
    Чистый JavaScript (AJAX)

URL WHOIS-чека:

http://127.0.0.1/api/whois?domain=

Сторінка історії запросів 

http://127.0.0.1/whois/history
