<?php
/**
 * @author Chris Hilsdon <chris@koolserve.uk>
 */

namespace Gitlab;

use GuzzleHttp\Client;

class Request extends Base
{
    public function fetch($url, $type = "GET", $data = null)
    {
        $app = $this->getContainer();
        $url = $app->getUrl() . $url;

        $client = new Client();
        $request = $client->request($type, $url, [
            'headers' => [
                'PRIVATE-TOKEN' => $app->getToken(),
            ],
            'json' => $data
        ]);

        $response = (string) $request->getBody();
        $response = json_decode($response, true);

        return $response;
    }
}