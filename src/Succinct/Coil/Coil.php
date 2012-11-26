<?php

namespace Succinct\Coil;

class Coil {
	private $curl;

    public static function get($url, $arrFields = null, $returnTransfer = true){
        $instance = new Coil();
        if (is_array($arrFields)) {
            $url .= '?' . http_build_query($arrFields);
        }
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
        $this->set(CURLOPT_POSTFIELDS, http_build_query($arr));
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
