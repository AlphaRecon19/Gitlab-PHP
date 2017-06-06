<?php
/**
 * @author Chris Hilsdon <chris@koolserve.uk>
 */

namespace Gitlab;

abstract class Base
{
    protected $app;

    protected $request;

    public function __construct(Gitlab $gitlab)
    {
        $this->app = $gitlab;
    }

    public function getContainer()
    {
        return $this->app;
    }

    public function createRequest()
    {
        if ($this->request) {
            return $this->request;
        }
        $this->request = new Request($this->getContainer());

        return $this->request;
    }

    public function getRequestHeaders()
    {
        $request = $this->createRequest();
        return $request->getHeaders();
    }

    public function get($url)
    {
        $request = $this->createRequest();
        return $request->fetch($url);
    }

    public function post($url, $data = [])
    {
        $request = $this->createRequest();
        return $request->fetch($url, 'POST', ['json' => $data]);
    }

    public function delete($url)
    {
        $request = $this->createRequest();
        return $request->fetch($url, 'DELETE');
    }

    public function save($url, $path)
    {
        $request = $this->createRequest();
        return $request->fetch($url, 'GET', [
            'sink' => $path
        ]);
    }

    public function put($url)
    {
        $request = $this->createRequest();
        return $request->fetch($url, 'PUT');
    }
}