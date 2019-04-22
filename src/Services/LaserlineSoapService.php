<?php

namespace App\Services;

class LaserlineSoapService
{
    private $mailer;
    private $soapClient;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function getClient($url)
    {
        $context = stream_context_create([
            'ssl' => [
                // set some SSL/TLS specific options
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ]
        ]);


        $this->soapClient = new \SoapClient($url, array(
            'soap_version'=>SOAP_1_2, 
            // 'password' => 'llnivasapp123',
            // 'login' => 'NIVAS_APP',
            'exceptions'=>false, 
            'location' => 'http://194.152.247.109:1111/llsoap.php',
            'trace' => 1,
            'cache_wsdl'=>WSDL_CACHE_NONE,
            'stream_context' => $context
        ));

        $auth = array(
            'Username' => 'nivas_app',
            'Password' => 'llnivasapp123',
            'Database' => 'matis1.world'
        );
        $header = new \SoapHeader('LLSoapNamespace','ZaglavljeHIS',$auth,false);
        $this->soapClient->__setSoapHeaders($header);

        return $this->soapClient;
    }

    public function getDebug()
    {
        $arr = array();
        $arr['RequestHeaders'] = $this->soapClient->__getLastRequestHeaders();
        $arr['Request'] = $this->soapClient->__getLastRequest();
        $arr['ResponseHeaders'] = $this->soapClient->__getLastResponseHeaders();
        $arr['Response'] = $this->soapClient->__getLastResponse();

        return $arr;
    }

    public function callMethod($method, $req)
    {
        try
        {
            return $this->soapClient->{$method}($req);
        }
        catch (\Exception $e)
        {
            throw new \Exception('Soap error! ' . $e->getMessage());
        }
    }

    public function hello($name)
    {
        $message = new \Swift_Message('Hello Service');
        $message->setTo('luka@nivas.hr');
        $message->setBody($name.' says hi!');

        $this->mailer->send($message);

        return 'Hello, '.$name;
    }
}