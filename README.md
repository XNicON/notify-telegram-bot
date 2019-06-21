#Usage

Create file src/settings.php


```
<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Monolog settings
        'logger' => [
            'name' => 'tgBot',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],

        'telegram' => [
            'token' => '<Telegram token bot>',
        ],
        'access-token' => '<token for your api>'
    ],
];

```

Requests:
```
/?app=<name>&type=info&token=<token for access>&text=<Text>
```

type - info|warn|danger|success|notify

app - identify from

text - text notification

