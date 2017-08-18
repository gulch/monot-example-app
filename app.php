<?php

require __DIR__ . '/vendor/autoload.php';

// setup logger
$logger = new \Monolog\Logger('Monot App', [
    new \Monolog\Handler\StreamHandler(__DIR__ . '/storage/logs/' . date('Ymd') . '.log'),
]);

// register exceptions handler
\Monolog\ErrorHandler::register($logger);

// setup Dotenv
(new \Dotenv\Dotenv(__DIR__))->load();

// setup notifier
$notifier = new \Monot\Notification\TelegramNotification(
    getenv('TELEGRAM_BOT_TOKEN'),
    getenv('TELEGRAM_CHAT_ID')
);

// check availability
(new \Monot\Point\HttpsServer($notifier, 'gulchuk.com'))->check();