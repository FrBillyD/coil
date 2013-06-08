<?php
/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * @copyright Copyleft
 */
namespace Asphyxia\Coil;

/**
 * Coil is an abstraction layer for PHP's cURL functions.
 * 
 * @package Asphyxia\Coil
 */
class Coil {

    private $curl;

    /**
     * Executes a GET request through CURL
     * 
     * @param String $url
     * @param Array $arrFields
     * @param Boolean $returnTransfer
     * @return String
     */
    public static function get($url, $arrFields = null, $returnTransfer = true) {
        $instance = new Coil();
        if (is_array($arrFields)) {
            $url .= '?' . http_build_query($arrFields);
        }
        $instance->setUrl($url);
        $instance->setReturnTransfer($returnTransfer);
        return $instance->execute();
    }

    /**
     * Executes a POST request through CURL
     * 
     * @param String $url
     * @param Array $arrFields
     * @param Boolean $returnTransfer
     * @return String
     */
    public static function post($url, $arrFields, $returnTransfer = true) {
        $instance = new Coil();
        $instance->setUrl($url);
        $instance->setPost(true);
        $instance->setPostFields($arrFields);
        $instance->setReturnTransfer($returnTransfer);
        return $instance->execute();
    }

    /* Getters and setters */

    /**
     * Sets CURLOPT option
     * 
     * @param type $url
     */
    public function setUrl($url) {
        $this->set(CURLOPT_URL, $url);
    }

    /**
     * Sets CURLOPT_POST option
     * 
     * @param type $bool
     */
    public function setPost($bool) {
        $this->set(CURLOPT_POST, $bool);
    }

    /**
     * Sets CURLOPT_RETURNTRANSFER option
     * 
     * @param type $bool
     */
    public function setReturnTransfer($bool) {
        $this->set(CURLOPT_RETURNTRANSFER, $bool);
    }

    /**
     * Sets curl options CURLOPT_POSTFIELDS for posts
     * 
     * @param Array $arr
     */
    public function setPostFields($arr) {
        $this->set(CURLOPT_POSTFIELDS, http_build_query($arr));
    }

    /**
     * Creates a new Coil instance
     */
    public function __construct() {
        $this->curl = curl_init();
    }

    /**
     * Sets curl options through curl_setopt function
     * @param type $option
     * @param type $value
     */
    public function set($option, $value) {
        curl_setopt($this->curl, $option, $value);
    }

    /**
     * Deprecated
     */
    protected function create() {
        
    }

    /**
     * Executes the call to curl_exec with the setted url
     * 
     * @return String curl_exec call result
     */
    public function execute() {
        $this->result = curl_exec($this->curl);
        curl_close($this->curl);
        return $this->result;
    }

}
