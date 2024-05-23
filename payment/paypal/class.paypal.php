<?php
class PayPal {

    //these constants you have to obtain from PayPal
    //Step-by-step manual is here: https://cms.paypal.com/us/cgi-bin/?cmd=_render-content&content_ID=developer/e_howto_api_NVPAPIBasics
    const API_USERNAME  = "ezybuy2015_api1.gmail.com";
    const API_PASSWORD  = "CEBKVRMGAPD2UDYY";
    const API_SIGNATURE = "A-EGkwAU5lksme1Om0FHLqfnjyKcAEpxPPcX4UWWHfCzwtA0EASTpMJ1";


    public $PP_RETURN = "http://x1000.aspidanetwork.com/payment/ppreturn.php";
    public $PP_CANCEL = "http://x1000.aspidanetwork.com/payment/ppcancel.php";

    public function setReturn($url) {
        // Success
        $this->PP_RETURN = $url;
    }

    public function setCancel($url) {
        // Failure
        $this->PP_CANCEL = $url;
    }



    private $endpoint;
    private $host;
    private $gate;

    function __construct($real = true) {
        $this->endpoint = '/nvp';
        if ($real) {
            $this->host = "api-3t.paypal.com";
            $this->gate = 'https://www.paypal.com/cgi-bin/webscr?';
        } else {
            //sandbox
            $this->host = "api-3t.sandbox.paypal.com";
            $this->gate = 'https://www.sandbox.paypal.com/cgi-bin/webscr?';
        }
    }

    /**
    @return HTTPRequest
     */
    private function response($data){
        $r = new HTTPRequest($this->host, $this->endpoint, 'POST', true);
        $result = $r->connect($data);
        if ($result<400) return $r;
        return false;
    }

    private function buildQuery($data = array()){
        $data['USER'] = self::API_USERNAME;
        $data['PWD'] = self::API_PASSWORD;
        $data['SIGNATURE'] = self::API_SIGNATURE;
        $data['VERSION'] = '76.0';
        $query = http_build_query($data);
        return $query;
    }


    /**
     * Main payment function
     *
     * If OK, the customer is redirected to PayPal gateway
     * If error, the error info is returned
     *
     * @param float $amount Amount (2 numbers after decimal point)
     * @param string $desc Item description
     * @param string $invoice Invoice number (can be omitted)
     * @param string $currency 3-letter currency code (USD, GBP, CZK etc.)
     *
     * @return array error info
     */
    public function doExpressCheckout($amount, $desc, $invoice='', $currency='EUR'){
        $data = array(
            'PAYMENTACTION' =>'Sale',
            'AMT' =>$amount,
            'RETURNURL' => $this->PP_RETURN,
            'CANCELURL'  => $this->PP_CANCEL,
            'DESC'=>$desc,
            'NOSHIPPING'=>"1",
            'ALLOWNOTE'=>"1",
            'CURRENCYCODE'=>$currency,
            'METHOD' =>'SetExpressCheckout'
        );


        $data['CUSTOM'] = $amount.'|'.$currency.'|'.$invoice;


        if ($invoice) {
            $data['INVNUM'] = $invoice;
        }

        $query = $this->buildQuery($data);

        $result = $this->response($query);

        if (!$result) {
            return false;
        }

        $response = $result->getContent();
        $return = $this->responseParse($response);

        if ($return['ACK'] == 'Success') {
            header('Location: '.$this->gate.'cmd=_express-checkout&useraction=commit&token='.$return['TOKEN'].'');
            die();
        }
        return($return);
    }

    public function getCheckoutDetails($token){
        $data = array(
            'TOKEN' => $token,
            'METHOD' =>'GetExpressCheckoutDetails');
        $query = $this->buildQuery($data);

        $result = $this->response($query);

        if (!$result) return false;
        $response = $result->getContent();
        $return = $this->responseParse($response);
        return($return);
    }
    public function doPayment(){
        $token = $_GET['token'];
        $payer = $_GET['PayerID'];
        $details = $this->getCheckoutDetails($token);
        if (!$details) {
            return false;
        }


        list($amount,$currency,$invoice) = explode('|',$details['CUSTOM']);
        $data = array(
            'PAYMENTACTION' => 'Sale',
            'PAYERID' => $payer,
            'TOKEN' =>$token,
            'AMT' => $amount,
            'CURRENCYCODE'=>$currency,
            'METHOD' =>'DoExpressCheckoutPayment'
        );
        $query = $this->buildQuery($data);

        $result = $this->response($query);

        if (!$result) {
            return false;
        }
        $response = $result->getContent();
        $return = $this->responseParse($response);

        /*
         * [AMT] => 10.00
         * [CURRENCYCODE] => USD
         * [PAYMENTSTATUS] => Completed
         * [PENDINGREASON] => None
         * [REASONCODE] => None
         */

        return($return);
    }

    private function getScheme() {
        $scheme = 'http';
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
            $scheme .= 's';
        }
        return $scheme;
    }

    private function responseParse($resp){
        $a = explode("&", $resp);
        $out = array();
        foreach ($a as $v){
            $k = strpos($v, '=');
            if ($k) {
                $key = trim(substr($v,0,$k));
                $value = trim(substr($v,$k+1));
                if (!$key) {
                    continue;
                }
                $out[$key] = urldecode($value);
            } else {
                $out[] = $v;
            }
        }
        return $out;
    }
}

?>