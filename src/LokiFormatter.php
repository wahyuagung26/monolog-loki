<?php
namespace Wahyuagung\MonologLoki;

use Itspire\MonologLoki\Formatter\LokiFormatter as FormatterLokiFormatter;
use Symfony\Component\HttpFoundation\Request;

class LokiFormatter extends FormatterLokiFormatter
{
    public function prepareRecord(array $record): array
    {
        $customContext = $record['context'];
        if (isset($record['context']) && !empty($record['context'])) {
            unset($record['context']);
            $response = $customContext;
        }

        $record['request']   = $this->getRequestDetail();
        $record['response']  = $response ?? [];

        return @parent::prepareRecord($record);
    }

    private function getRequestDetail()
    {
        $request = Request::createFromGlobals();

        return [
            'uri'       => $request->getRequestUri(),
            'method'    => $request->getMethod(),
            'headers'   => $request->server->getHeaders(),
            'payload'   => array_merge($request->query->all(), $request->request->all())
        ];
    }
}
