<?php
/**
 * @author Chris Hilsdon <chris@koolserve.uk>
 */

namespace Gitlab;

use GuzzleHttp\Client;

class Request extends Base
{
    protected $headers = [];

    public function fetch($url, $type = "GET", $data = [])
    {
        $app = $this->getContainer();
        //Check if $url already has the base url
        if (strpos($url, $app->getUrl()) === false) {
            $url = $app->getUrl() . $url;
        }

        $verify = $app->getVerifySSL();
        $client = new Client(['verify' => $verify]);
        $data = $data + [
            'headers' => [
                'PRIVATE-TOKEN' => $app->getToken(),
            ],
        ];
        $request = $client->request($type, $url, $data);
        $this->setHeaders($request->getHeaders());

        $response = (string) $request->getBody();
        $response = json_decode($response, true);


        return $response;
    }

    protected function setHeaders($headers)
    {
        $this->headers = $headers;
    }

    protected function getHeaders()
    {
        return $this->headers;
    }
}