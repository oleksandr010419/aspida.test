<?php
class PayGol {

    //these constants you have to obtain from PayGol
    //Step-by-step manual is here: https://cms.paygol.com/us/cgi-bin/?cmd=_render-content&content_ID=developer/e_howto_api_NVPAPIBasics
    //const API_USERNAME  = "ezybuy2015_api1.gmail.com";
    //const API_PASSWORD  = "CEBKVRMGAPD2UDYY";
    //const API_SIGNATURE = "A-EGkwAU5lksme1Om0FHLqfnjyKcAEpxPPcX4UWWHfCzwtA0EASTpMJ1";
	const API_SERVICEID = "396968";


    public $PP_RETURN = "";
    public $PP_CANCEL = "";
	private $endpoint = '/pay';
    private $gate  = 'www.paygol.com';
	private $checkout_gate  = 'https://www.paygol.com/pay-now/';

    public function setReturn($url) {
        // Success
        $this->PP_RETURN = $url;
    }

    public function setCancel($url) {
        // Failure
        $this->PP_CANCEL = $url;
    }

    /**
    @return HTTPRequest
     */
    private function response($data){
		$r = new HTTPRequest($this->gate, $this->endpoint, 'POST', true);
        $result = $r->connect($data);
        if ($result<400) return $r;
        return false;
    }

    private function buildQuery($data = array()){  
        $query = http_build_query($data);
        return $query;
    }
		
    public function doExpressCheckout($serv_id, $amount, $desc, $invoice='', $currency='EUR'){        
        /*$r = new HTTPRequest($this->gate, $this->endpoint, 'GET', true);
		$data = array(
			'pg_serviceid' => self::API_SERVICEID,
            'pg_currency' => $currency,
			'pg_price' => $amount,
			'pg_name' => $desc,
			'pg_custom' => $serv_id,
			'pg_return_url' => $this->PP_RETURN,
			'pg_cancel_url' => $this->PP_CANCEL,
			'pg_button.x' => 155,
			'pg_button.y' => 152,
        );
        $query = $this->buildQuery($data);
		//die(print_r($query));
        $result = $this->response($query);
        if (!$result) {
            return false;
        }
        $response = $result->getContent();
        $return = $this->responseParse($response);

		$headers = $result->getHeader();
		header('Location: '.$headers['location']);
		die();
        /*if ($return['ACK'] == 'Success') {
            header('Location: '.$this->checkout_gate);
            die();
        }
        return($return);*/
		
		echo '
		<form  name="pg_frm" method="post" action="https://www.paygol.com/pay" >
		   <input type="hidden" name="pg_serviceid" value="'.self::API_SERVICEID.'">
		   <input type="hidden" name="pg_currency" value="'.$currency.'">
		   <input type="hidden" name="pg_name" value="'.$desc.'">
		   <input type="hidden" name="pg_custom" value="'.$serv_id.'">

		 <!-- With Dropdown -->
		 <input type="hidden" name="pg_price" value="'.$amount.'">

		   <input type="hidden" name="pg_return_url" value="'.$this->PP_RETURN.'">
		   <input type="hidden" name="pg_cancel_url" value="'.$this->PP_CANCEL.'">
		   <input type="image" id="pg_frm" name="pg_button" src="https://www.paygol.com/webapps/buttons/en/red.png" border="0" alt="Make payments with PayGol: the easiest way!" title="Make payments with PayGol: the easiest way!" >     
	</form>
	<script type="text/javascript">
		window.onload = function() {
				document.getElementById("pg_frm").click();
		};
	</script>
	';

		
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