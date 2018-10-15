# php-monolog-wrapper
A PHP wrapper for monolog 

## Install

```bash
composer require websvc/php-monolog-wrapper 1.0.0
```

Requires Monolog - https://packagist.org/packages/monolog/monolog     


## Usage

```php

$log = new websvc/php-monolog-wrapper('logger-name', [
            'logFile' => '/tmp/mylog.log',
            'loggerLevel'=> 'DEBUG',    // Set logging level
            'toStderr'=> true           // Log output to stderr
        ]);

$log->addLog('INFO', "My info message ", ["a call identifier"]);
$log->addLog('DEBUG', "My debug message ", ["a call identifier"]);
$log->addLog('ERROR', "My error message ", ["a call identifier"]);


function myFunction(){

    global $log;

    echo "Hello World!";

    $log->addLog('DEBUG', "Function was called! ", [__FUNCTION__]);

}


```
