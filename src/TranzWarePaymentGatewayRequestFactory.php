<?php

namespace num8er\TranzWarePaymentGateway;

use num8er\TranzWarePaymentGateway\Requests\TranzWarePaymentGatewayOrderRequest;
use num8er\TranzWarePaymentGateway\Requests\TranzWarePaymentGatewayOrderStatusRequest;

/**
 * Factory class for creation of request objects
 *
 * Example:
 *  $requestFactory = new TranzWarePaymentGatewayRequestFactory(
 *   'https://tranz-ware-payment-gateway/url',
 *   'E1000010',
 *   'https://your-site-address-here/samples/order_approved.php',
 *   'https://your-site-address-here/samples/order_declined.php',
 *   'https://your-site-address-here/samples/order_canceled.php',
 *   'EN'
 *  );
 *  $keyFile = __DIR__.'/../certificates/your-private-key.pem';
 *  $keyPass = file_get_contents(__DIR__.'/../certificates/your-private-key-pass.txt');
 *  $certFile = __DIR__.'/../certificates/cert-signed-by-payment-gateway-part.crt';
 *  $requestFactory->setCertificate($certFile, $keyFile, $keyPass);
 *
 *  $orderRequest = $requestFactory->createOrderRequest(1, 'USD', 'TEST PAYMENT #1'); // --> instance of TranzWarePaymentGatewayRequestInterface
 *
 * Class TranzWarePaymentGatewayRequestFactory
 * @package num8er\TranzWarePaymentGateway
 */
class TranzWarePaymentGatewayRequestFactory implements TranzWarePaymentGatewayRequestFactoryInterface
{
    /**
     * TranzWarePaymentGatewayRequestFactory constructor.
     *
     * @param string $GATEWAY_URL
     * @param string $MERCHANT_ID
     * @param string $ON_ORDER_APPROVED_URL
     * @param string $ON_ORDER_DECLINED_URL
     * @param string $ON_ORDER_CANCELED_URL
     * @param string $LANG
     */
    public function __construct($GATEWAY_URL, $MERCHANT_ID, $ON_ORDER_APPROVED_URL, $ON_ORDER_DECLINED_URL, $ON_ORDER_CANCELED_URL, $LANG = 'EN')
    {
        $this->MERCHANT_ID = $MERCHANT_ID;
        $this->LANG = $LANG;
        $urlProvider = new TranzWarePaymentGatewayUrls();
        $urlProvider
            ->setGatewayUrl($GATEWAY_URL)
            ->setOnOrderApprovedUrl($ON_ORDER_APPROVED_URL)
            ->setOnOrderDeclinedUrl($ON_ORDER_DECLINED_URL)
            ->setOnOrderCanceledUrl($ON_ORDER_CANCELED_URL);
        $this->setUrlProvider($urlProvider);
    }

    private $sslCertificate, $sslKey, $sslKeyPass;

    /**
     * @param string $certFile  Path to certificate
     * @param string $keyFile   Path to private key
     * @param string $keyPass   Password provided in creation of private key
     */
    final public function setCertificate($certFile, $keyFile, $keyPass = '')
    {
        $this->sslKey = $keyFile;
        $this->sslKeyPass = $keyPass;
        $this->sslCertificate = $certFile;
    }

    protected $MERCHANT_ID;
    protected $LANG;

    /**
     * @var TranzWarePaymentGatewayUrlProviderInterface
     *
     * Instance of TranzWarePaymentGatewayUrlProviderInterface
     * that returns set of urls required by request instances
     */
    protected $urlProvider;

    /**
     * @param TranzWarePaymentGatewayUrlProviderInterface $urlProvider
     */
    final private function setUrlProvider(TranzWarePaymentGatewayUrlProviderInterface $urlProvider)
    {
        $this->urlProvider = $urlProvider;
    }

    /**
     * @return TranzWarePaymentGatewayUrlProviderInterface
     */
    final private function getUrlProvider()
    {
        return $this->urlProvider;
    }

    /**
     * @param float  $amount
     * @param string $currency
     * @param string $description
     *
     * @return TranzWarePaymentGatewayOrderRequest
     */
    final public function createOrderRequest($amount, $currency, $description = '')
    {
        $request = new TranzWarePaymentGatewayOrderRequest(
            $this->getUrlProvider()->getGatewayUrl(),
            $this->getUrlProvider()->getOnOrderApprovedUrl(),
            $this->getUrlProvider()->getOnOrderDeclinedUrl(),
            $this->getUrlProvider()->getOnOrderCanceledUrl(),
            $this->MERCHANT_ID,
            $amount,
            $currency,
            $description,
            $this->LANG
        );
        $request->setSslCertificate($this->sslCertificate, $this->sslKey, $this->sslKeyPass);
        return $request;
    }

    /**
     * @param string $orderId
     * @param string $sessionId
     *
     * @return TranzWarePaymentGatewayOrderStatusRequest
     */
    final public function createOrderStatusRequest($orderId, $sessionId)
    {
        $request = new TranzWarePaymentGatewayOrderStatusRequest(
            $this->getUrlProvider()->getGatewayUrl(),
            $this->MERCHANT_ID,
            $orderId,
            $sessionId,
            $this->LANG
        );
        $request->setSslCertificate($this->sslCertificate, $this->sslKey, $this->sslKeyPass);
        return $request;
    }
}