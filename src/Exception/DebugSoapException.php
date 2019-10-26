<?php

namespace App\Exception;

final class DebugSoapException extends \SoapFault
{
    private $client;

    public function __construct($e, $client) {
        parent::__construct('Soup request failed!', $e->getCode(), $e);
        $this->client = $client;
    }

    public function getSoapDebug()
    {
        return $this->client->getDebug();
    }

    public function getScript()
    {
        return $this->getFile() .':'. $this->getLine();
    }
}