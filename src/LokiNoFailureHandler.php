<?php
namespace Wahyuagung\MonologLoki;

use Monolog\Logger;
use Monolog\Handler\WhatFailureGroupHandler;
use Wahyuagung\MonologLoki\LokiFormatter;
use Wahyuagung\MonologLoki\LokiHandler;

/**
 * Source : https://github.com/itspire/monolog-loki
 */
class LokiNoFailureHandler
{
    public function __invoke(array $config)
    {
        return new Logger('loki-no-failure', [
            new WhatFailureGroupHandler([
                (new LokiHandler($config['handler_with']['apiConfig'], $config['level']))
                    ->setFormatter(new LokiFormatter(...array_values($config['formatter_with'])))
            ])
        ]);
    }
}