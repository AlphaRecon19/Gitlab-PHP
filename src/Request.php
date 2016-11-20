<?php
/**
 * @author Chris Hilsdon <chris@koolserve.uk>
 */

namespace Gitlab;

use GuzzleHttp\Client;

class Request extends Base
{
    public function fetch($url, $type = "GET", $data = [])
    {
        $app = $this->getContainer();
        $url = $app->getUrl() . $url;

        $client = new Client();
        $data = $data + [
            'headers' => [
                'PRIVATE-TOKEN' => $app->getToken(),
            ],
        ];
        $request = $client->request($type, $url, $data);

        $response = (string) $request->getBody();
        $response = json_decode($response, true);

        return $response;
    }
}