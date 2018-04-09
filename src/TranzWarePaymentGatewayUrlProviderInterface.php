<?php

namespace num8er\TranzWarePaymentGateway;

interface TranzWarePaymentGatewayUrlProviderInterface
{
    public function setGatewayUrl($url);

    public function getGatewayUrl();

    public function setOnOrderApprovedUrl($url);

    public function getOnOrderApprovedUrl();

    public function setOnOrderDeclinedUrl($url);

    public function getOnOrderDeclinedUrl();

    public function setOnOrderCanceledUrl($url);

    public function getOnOrderCanceledUrl();
}