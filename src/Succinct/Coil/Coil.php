<?php

namespace Succinct\Coil;

class Coil {
	private $curl;

    public static function get($url, $returnTransfer = true){
        $instance = new Coil();
        $instance->setUrl($url);
        $instance->setReturnTransfer($returnTransfer);
        return $instance->execute();
    }

    public static function post($url, $arrFields, $returnTransfer = true){
        $instance = new Coil();
        $instance->setUrl($url);
        $instance->setPost(true);
        $instance->setPostFields($arrFields);
        $instance->setReturnTransfer($returnTransfer);
        return $instance->execute();
    }

    /* Getters and setters */
    public function setUrl($url){
        $this->set(CURLOPT_URL, $url);
    }

    public function setPost($bool){
        $this->set(CURLOPT_POST, $bool);
    }

    public function setReturnTransfer($bool){
        $this->set(CURLOPT_RETURNTRANSFER, $bool);
    }

    public function setPostFields($arr){
        $str = '';
        foreach ($arr as $key => $val) {
            $str .= $key . '=' . urlencode($val) . '&';
        }
        $this->set(CURLOPT_POSTFIELDS, $str);
    }

	public function __construct() {
        $this->curl = curl_init();
	}

	public function set($option, $value) {
        curl_setopt($this->curl, $option, $value);
	}

	/**
	 * Create our curl instance
	 */
	protected function create() {

	}

	/**
	 * Execute curl call
	 */
	public function execute() {
        $this->result= curl_exec($this->curl);
        curl_close ($this->curl);		
        return $this->result;
	}
}
