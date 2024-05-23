<?php
class SkrillClient
{
    const APP_URL = 'https://pay.skrill.com';

    /** @var  SkrillRequest $request */
    private $request;

    /** @var  string $sid */
    private $sid;

    /**
     * SkrillClient constructor.
     * @param SkrillRequest $request
     */
    public function __construct(SkrillRequest $request = null)
    {
        $this->request = $request;
    }

    public function generateSID()
    {
        if (!$this->request) {
            throw new \Exception('Exception, you need to set SkrillRequest!');
        }		
		$ch = curl_init();
		// Set some options - we are passing in a useragent too here
		curl_setopt_array($ch, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => self::APP_URL.'?'.http_build_query($this->request->toArray()),
			CURLOPT_USERAGENT => 'Codular Sample cURL Request'
		));
		// Send the request & save response to $resp
		$response = curl_exec($ch);
		$err     = curl_errno( $ch );
		$errmsg  = curl_error( $ch );
		$header  = curl_getinfo( $ch );
		
		if($err==0){
			$sid = $this->_parseSID($response);
			return $sid[0];
		}
		
		return "bad response";
		/*
        $ch = curl_init(self::APP_URL);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST'); //
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0); // -0
        curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                                            'Content-Type: application/x-www-form-urlencoded'
                                            ));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->request->toArray());
		
		$response = curl_exec($ch);
		$err     = curl_errno( $ch );
		$errmsg  = curl_error( $ch );
		$header  = curl_getinfo( $ch );
		curl_close( $ch );

		die(print_r($this->_parseSID($response)));
		if($err==0){
			$sid = $this->_parseSID($response);
			return $sid[1];
		}
		
		return "bad response";*/
    }
	
	private function _parseSID ($response)
	{
	$matches = array();
        $rlines = explode("\r\n", $response);

        foreach ($rlines as $line)
            {
            if (preg_match('/([^:]+): (.*)/im', $line, $matches))
                continue;

            if (preg_match('/([0-9a-f]{32})/im', $line, $matches))
                return $matches;
            }

        return $matches;
        }

    public function getRedirectUrl()
    {
        if (!$this->sid) {
            $this->sid = $this->generateSID();
        }
        return $this->sid;
    }

    /**
     * @return SkrillRequest
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param SkrillRequest $request
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }
}
