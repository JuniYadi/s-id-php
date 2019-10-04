<?php

namespace JuniYadi;

use GuzzleHttp\Client;

class SID
{
    /**
     * Set Endpoint Api URL
     *
     * @param string $vars
     */
    private $endpoint;

    /**
     * Set Guzzle Instance
     */
    private $guzzle;

    public function __construct(array $data=null)
    {
        $this->endpoint = $data['endpoint'] ?? 'https://s.id/';

        $this->guzzle = new Client([
            'verify'    => false
        ]);
    }

    /**
     * Public Short URL S.ID
     *
     * @param string $url
     *
     * @return array
     */
    public function short($url)
    {
        $request = $this->guzzle->post(
            $this->endpoint . 'api/public/link/shorten',
            [
                'headers' => [
                    'Host'      => 's.id',
                    'Origin'    => 'https://s.id',
                    'Referer'   => 'https://s.id/'
                ],
                'form_params' => [
                    'url' => $url,
                ]
            ]
        );

        $response = json_decode($request->getBody());
        $result = [
            'url' => $this->endpoint . $response->short,
            'original' => $response->long_url,
        ];

        return $result;
    }
}
