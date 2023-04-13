<?php
namespace Wahyuagung\MonologLoki;

use Itspire\MonologLoki\Handler\LokiHandler as HandlerLokiHandler;
use Monolog\Formatter\FormatterInterface;

class LokiHandler extends HandlerLokiHandler
{
    protected function getDefaultFormatter(): FormatterInterface
    {
        return new LokiFormatter($this->globalLabels, $this->globalContext, $this->systemName);
    }
}
