<?php namespace Abhi\Tangocard;
 
use Config;


class TangocardCurl {
    private $response = null;               // Contains the cURL responce for debug
    private $info = array();                // Returned after request (elapsed time, etc)
    private $error_code;                    // Error code returned as an int
    private $error_string;                  // Error message returned as a string
    private $mode;                          // config mode of request
    private $url;                           // URL of the session
    private $platformName;                  // platform name
    private $platformKey;                   // platform key
    private $pem;                           // public key file

    function __construct() {
        $this->mode = Config::get('tangocard.mode');
        $this->host = Config::get('tangocard.' . $this->mode . '.host');
        $this->platformName = Config::get('tangocard.' . $this->mode . '.platform_name');
        $this->platformKey = Config::get('tangocard.' . $this->mode . '.platform_key');
        $this->pem = __DIR__ . '/../../ssl/tangocard_digicert_chain.pem';
    }

    /**
     *  process post requests
     */
    public function postRequest($url, $params = array()) {
        $this->url = $this->host . $url;
        return $this->execute($params, 'post');
    }

    /**
     *  process get requests
     */
    public function getRequest($url, $params = array()) {
        $this->url = $this->host . $url;
        foreach ($params as $key => $value) {
            # code...
            $this->url = str_replace('<' . $key . '>', $value, $this->url);
        }
        return $this->execute($params, 'get');
    }

    /**
     *
     * Process repest
     *
     */
    private function execute($params, $type = 'get') {
        $process = curl_init($this->url);
        curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($process, CURLOPT_ENCODING, 1);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, TRUE);
        curl_setopt($process, CURLOPT_CAINFO, $this->pem);
        
        curl_setopt($process, CURLOPT_HTTPHEADER, array (
                    "Authorization: Basic " . base64_encode($this->platformName . ":" . $this->platformKey),
                ));
        
        if('post' == $type) {
            curl_setopt($process, CURLOPT_POST, true);
            curl_setopt($process, CURLOPT_POSTFIELDS, json_encode($params));
        }

        $this->response = curl_exec($process);

        // Request failed
        if($this->response === FALSE) {
            if(Config::get('tangocard.' . $this->mode . '.deployment_type') == 'development') {
                $this->error_code = curl_errno($process);
                echo '<br/>';
                $this->error_string = curl_error($process);
                print_r( $this->error_code);
                print_r( $this->error_string);
                curl_close($process);
                die;
            }
            return FALSE;
        }        
        // Request successful
        else {
            $this->info = curl_getinfo($process);
            curl_close($process);
            return json_decode($this->response);
        }
    }
}