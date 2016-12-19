<?php
/**
 * @author Chris Hilsdon <chris@koolserve.uk>
 */

namespace Gitlab;

class Gitlab
{
    /**
     * Gitlab URL
     * @var string
     */
    protected $url;

    /**
     * Token that is ued to authenticate with gitlab
     * @var string
     */
    protected $token;

    /**
     * Set the SSL certificate verification behavior of a request.
     * @link http://docs.guzzlephp.org/en/latest/request-options.html#verify
     * @var boolean
     */
    protected $verifySSL = false;

    /**
     * Get the value of Gitlab URL
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set the value of Gitlab URL
     *
     * @param string url
     *
     * @return self
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get the value of Token that is ued to authenticate with gitlab
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set the value of Token that is ued to authenticate with gitlab
     *
     * @param string token
     *
     * @return self
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    public function getVerifySSL()
    {
        return $this->verifySSL;
    }

    public function setVerifySSL($verifySSL)
    {
        $this->verifySSL = $verifySSL;
    }

    public function __construct($url, $token)
    {
        $this->setUrl($url);
        $this->setToken($token);
    }

}