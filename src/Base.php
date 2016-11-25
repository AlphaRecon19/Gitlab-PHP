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

    public function post($url, $data = [])
    {
        $request = new Request($this->getContainer());

        return $request->fetch($url, 'POST');
    }

    public function delete($url)
    {
        $request = new Request($this->getContainer());

        return $request->fetch($url, 'DELETE');
    }

    public function save($url, $path)
    {
        $request = new Request($this->getContainer());

        return $request->fetch($url, 'GET', [
            'sink' => $path
        ]);
    }

}