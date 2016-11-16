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

    public function __construct($url, $token)
    {
        $this->setUrl($url);
        $this->setToken($token);
    }

}