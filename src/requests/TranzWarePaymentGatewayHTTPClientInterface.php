<?php

namespace num8er\TranzWarePaymentGateway\Requests;

interface TranzWarePaymentGatewayHTTPClientInterface
{
    public function __construct($url, $body = null, $sslCertificate = null);

    public function execute();
}