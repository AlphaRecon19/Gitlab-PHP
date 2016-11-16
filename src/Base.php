<?php
/**
 * @author Chris Hilsdon <chris@koolserve.uk>
 */

namespace Gitlab;

abstract class Base
{
    protected $app;

    public function __construct(Gitlab $gitlab)
    {
        $this->app = $gitlab;
    }

    public function getContainer()
    {
        return $this->app;
    }

    public function get($url)
    {
        $request = new Request($this->getContainer());

        return $request->fetch($url);
    }

}