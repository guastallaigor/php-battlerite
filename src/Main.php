<?php

namespace guastallaigor\PhpBattlerite;

use GuzzleHttp\Exception\RequestException;

/**
 * PHP-Battlerite easy API.
 *
 * @category  Games
 *
 * @author    Igor Guastalla de Lima  <limaguastallaigor@gmail.com>
 * @copyright 2018 PHP Battlerite
 * @license   MIT https://github.com/guastallaigor/php-battlerite/blob/master/LICENSE
 *
 * @link      https://github.com/guastallaigor/php-battlerite
 */
class Main
{
    /**
     * Guzzle Client variable to send all requests.
     *
     * @var object<GuzzleHttp\Client>
     */
    private $client;

    /**
     * API Key of your development battlerite account.
     *
     * @var string
     */
    private $apiKey;

    /**
     * @var \guastallaigor\PhpBattlerite\Config
     */
    private $config;

    /**
     * Main constructor.
     *
     * @param \guastallaigor\PhpBattlerite\Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
        $this->client = new \GuzzleHttp\Client();
    }

    /**
     * Method to set your API Key provided by your Battlerite development account.
     *
     * @param string $apiKey
     *
     * @return void
     */
    public function setAPIKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * Function that is going to make all the requests you need.
     *
     * @param string $method
     * @param string $request
     * @param array  $filter
     *
     * @return array
     */
    public function sendRequest($method, $request, $filter = [], $global = true)
    {
        $apiUrl = 'https://api.dc01.gamelockerapp.com/';
        $shardsGlobal = 'shards/global/';
        $url = $apiUrl.($global ? $shardsGlobal.$request : $request);
        $header = [
            'Authorization' => 'Bearer '.$this->apiKey,
            'Accept'        => 'application/vnd.api+json',
        ];

        try {
            $response = $this->client->request(
                $method,
                $url,
                [
                    'query'   => $filter,
                    'headers' => $header,
                ]
            );

            return json_decode($response->getBody()->getContents());
        } catch (RequestException $error) {
            $response = $this->statusCodeHandling($error);

            return $response;
        }
    }

    /**
     * Get a single player request.
     *
     * @param string $id
     *
     * @return array
     */
    public function getPlayer($id)
    {
        return $this->sendRequest('GET', 'players/'.$id);
    }

    /**
     * Get a collection of players.
     *
     * @param string $ids
     * @param string $type
     *
     * @return array
     */
    public function getPlayers($ids, $type = 'playerIds')
    {
        $filter = ['filter['.$type.']' => $ids];

        return $this->sendRequest('GET', 'players', $filter);
    }

    /**
     * Get a collection of teams.
     *
     * @param array $filters
     *
     * @return array
     */
    public function getTeams($filter)
    {
        // need work
        return $this->sendRequest('GET', 'teams', $filter);
    }

    /**
     * Get Battlerite status.
     *
     * @return array
     */
    public function getStatus()
    {
        return $this->sendRequest('GET', 'status', [], false);
    }

    /**
     * Get all the telemetry data.
     *
     * @param array $filters
     *
     * @return array
     */
    public function getMatches($filters)
    {
        $formattedFilter = [];
        foreach ($filters as $key => $value) {
            if ($key === 'offset' || $key === 'limit') {
                $formattedFilter['page['.$key.']'] = $value;
            } elseif ($key === 'sort') {
                $formattedFilter['sort'] = $value;
            } else {
                $formattedFilter['filter['.$key.']'] = $value;
            }
        }

        return $this->sendRequest('GET', 'matches', $formattedFilter);
    }

    /**
     * Function to handle unexpected errors.
     *
     * @param RequestException $error
     *
     * @return array
     */
    protected function statusCodeHandling($error)
    {
        return [
            'statuscode' => $error->getResponse()->getStatusCode(),
            'error'      => $error->getResponse()->getBody()->getContents(),
        ];
    }
}
