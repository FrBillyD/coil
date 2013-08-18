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
class Coil
{
    private $curl;
    public static $userAgent = 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/28.0.1500.71 Chrome/28.0.1500.71 Safari/537.36';

    /**
     * Executes a GET request through CURL
     *
     * @param String  $url
     * @param Array   $arrFields
     * @param Array   $arrOptions
     *
     * @return String
     */
    public static function get($url, $arrFields = null, $arrOptions = null)
    {
        $instance = new Coil();
        if (is_array($arrFields)) {
            $url .= '?' . http_build_query($arrFields);
        }
        $instance->setUrl($url);
        $instance->setReturnTransfer($returnTransfer = true);
        $instance->setOptions($arrOptions);

        return $instance->execute();
    }

    /**
     * Executes a POST request through CURL
     *
     * @param String $url
     * @param Array  $arrFields
     * @param Array  $arrOptions
     *
     * @return String
     */
    public static function post($url, $arrFields, $arrOptions = null)
    {
        $instance = new Coil();
        $instance->setUrl($url);
        $instance->setPost(true);
        $instance->setPostFields($arrFields);
        $instance->setReturnTransfer($returnTransfer = true);
        $instance->setOptions($arrOptions);

        return $instance->execute();
    }

    /**
     * Downloads $url into $localFile
     *
     * @param String $url
     * @param String $localFile
     * @param Array  $arrOptions
     *
     * @return Bool result
     */
    public static function fetch($url, $localFile, $arrOptions = null)
    {
        $fp =fopen($localFile, 'w+');
        $instance = new Coil();
        $instance->setUrl($url);
        $instance->set(CURLOPT_FILE, $fp);
        $instance->setOptions($arrOptions);
        $result = $instance->execute();
        fclose($fp);

        return $result;
    }

    /**
     * Perform a HTTP HEAD request on $url
     * @param String     $url
     * @param CURLINFO_* $info
     * @param Array      $arrOptions
     *
     * @return Bool curl_info
     */
    public static function head($url, $info = CURLINFO_HTTP_CODE, $arrOptions = null)
    {
        $instance = new Coil();
        $instance->setUrl($url);
        $instance->set(CURLOPT_NOBODY, true);
        $instance->setOptions($arrOptions);

        return $instance->execute($info);
    }

    /**
     * Sets CURLOPT option
     *
     * @param String $url
     */
    public function setUrl($url)
    {
        $this->set(CURLOPT_URL, $url);
    }

    /**
     * Sets CURLOPT_POST option
     *
     * @param Bool $bool
     */
    public function setPost($bool)
    {
        $this->set(CURLOPT_POST, $bool);
    }

    /**
     * Sets CURLOPT_RETURNTRANSFER option
     *
     * @param Bool $bool
     */
    public function setReturnTransfer($bool)
    {
        $this->set(CURLOPT_RETURNTRANSFER, $bool);
    }

    /**
     * Sets curl options CURLOPT_POSTFIELDS for posts
     *
     * @param Array $arr
     */
    public function setPostFields($arr)
    {
        $this->set(CURLOPT_POSTFIELDS, http_build_query($arr));
    }

    /**
     * Creates a new Coil instance
     * @param Array $arrOptions
     */
    public function __construct($arrOptions = null)
    {
        $this->curl = curl_init();
        $this->set(CURLOPT_USERAGENT, self::$userAgent);
        $this->setOptions($arrOptions);
    }

    /**
     * Sets curl options through curl_setopt function
     * @param CURLOPT_* $option
     * @param Mixed     $value
     */
    public function set($option, $value)
    {
        curl_setopt($this->curl, $option, $value);
    }

    /**
     * Sets curl options
     * @param Array $arrOptions
     */
    public function setOptions($arrOptions)
    {
        if (!is_array($arrOptions)) {
            return;
        }

        foreach ($arrOptions as $key => $value) {
            $this->set($key, $value);
        }
    }

    /**
     * Executes the call to curl_exec with the setted url
     * @param CURLINFO $info
     *
     * @return String curl_exec call result
     */
    public function execute($info = null)
    {
        $this->result = curl_exec($this->curl);
        if ($info) {
            $this->result = curl_getinfo($this->curl, $info);
        }
        curl_close($this->curl);

        return $this->result;
    }

}
