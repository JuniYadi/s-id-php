<?php

namespace JuniYadi;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;

class SID
{
    /**
     * Set Endpoint Api URL
     *
     * @param string $endpoint
     */
    private $endpoint;

    /**
     * Username or Email Account S.ID
     *
     * @param string $username
     */
    private $username;

    /**
     * Password Account S.ID
     *
     * @param string $password
     */
    private $password;

    /**
     * Login Status
     *
     * @param bool $login
     */
    private $login;

    /**
     * Set Guzzle Instance
     *
     * @see GuzzleHttp\Client
     */
    private $guzzle;

    /**
     * Set Guuzle CookieJar Instance
     *
     * @see GuzzleHttp\Cookie\CookieJar
     */
    private $jar;

    /**
     * User Agent
     *
     * @param string $useragent
     */
    private $useragent;

    /**
     * Set Cookie Path
     *
     * @param string $cookiepath
     */
    private $cookiepath;

    /**
     * Global CSRF-Token
     */
    private $csrf;

    /**
     * SID Construct Parameters
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        if (isset($data)) {
            $this->endpoint     = $data['endpoint'] ?? 'https://s.id/';
            $this->useragent    = $data['useragent'] ?? 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36';

            // Login Details
            $this->username     = $data['username'] ?? null;
            $this->password     = $data['password'] ?? null;

            if (isset($data['username']) and isset($data['password'])) {
                $this->login = true;
            }

            $this->guzzle = new Client([
                'verify'    => false
            ]);

            $this->jar = new CookieJar();
        }
    }

    /**
     * Get Cookie
     */
    public function cookie()
    {
        $request = $this->guzzle->get(
            $this->endpoint . 'auth/login',
            [
                'headers' => [
                    'Host'          => 's.id',
                    'Origin'        => 'https://s.id',
                    'User-Agent'    => $this->useragent,
                ],
                'cookies' => $this->jar
            ]
        );
    }

    /**
     * Login Action
     *
     * @param string $username|$password
     *
     */
    public function login()
    {
        if ($this->login) {
            $this->guzzle = new Client([
                'verify'    => false,
                'cookies'   => $this->jar
            ]);
        } else {
            throw new \Exception('Username and Password ');
        }

        $request = $this->guzzle->post(
            $this->endpoint . 'auth/login',
            [
                'headers' => [
                    'Host'      => 's.id',
                    'Origin'    => 'https://s.id'
                ],
                'form_params' => [
                    '_token'    => $this->token,
                    'username'  => $this->username,
                    'password'  => $this->password
                ]
            ]
        );

        $response = $request->getBody();

        return $response;
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
