<?php

namespace guastallaigor\PhpBattlerite;

/**
 * Class PhpBattlerite
 *
 * @author  Igor Guastalla de Lima  <limaguastallaigor@gmail.com>
 */
class Main
{
    /**
     * API URL root of Battlerite.
     *
     * @var string
     */
    private static $apiUrl = "https://api.dc01.gamelockerapp.com/shards/global/";

    /**
     * Guzzle Client variable to send all requests.
     *
     * @var string
     */
    private $client;

    /**
     * API Key of your development battlerite account.
     *
     * @String
     */
    private $apiKey;

    /**
     * @var  \guastallaigor\PhpBattlerite\Config
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
     * @param [String] $apiKey
     * @return void
     */
    public function setAPIKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * Function that is going to make all the requests you need.
     *
     * @param [String] $method
     * @param [String] $request
     * @param array $filter
     * @return json
     */
    public function sendRequest($method, $request, $filter = [])
    {
        try {
            $url = self::$apiUrl . $request;
            $header = [
                "Authorization" => "Bearer " . $this->apiKey,
                "Accept" =>  "application/vnd.api+json"
            ];
            $response = $this->client->request($method, $url, [
                "query" => $filter,
                "headers" => $header
            ]);

            return json_decode($response->getBody()->getContents());
        } catch (RequestException $error) {
            $response = $this->StatusCodeHandling($error);

            return $response;
        }
    }

    /**
     * Get a single player request.
     *
     * @param [String] $id
     * @return json
     */
    public function getPlayer($id)
    {
        return $this->sendRequest('GET', 'players/' . $id);
    }

    /**
     * Function to handle unexpected errors.
     *
     * @param [RequestException] $error
     * @return void
     */
    protected function statusCodeHandling($error)
    {
        $response = [
            "statuscode" => $error->getResponse()->getStatusCode(),
            "error" => json_decode($e->getResponse()->getBody(true)->getContents()),
        ];

        return $response;
    }

    // examples:

    // $client = new \GuzzleHttp\Client(['base_uri' => 'https://maps.google.com/maps/api/geocode/']);
    // $response = $client->request('GET', 'json', ['query' => [
    //     'sensor' => false,
    //     'address' => str_slug(sprintf('%s %s %s %s %s', $cedente->endereco, $cedente->bairro, $cedente->cidade, $cedente->uf, $cedente->cep), '+'),
    //     'key' => 'AIzaSyBKJTMCtsbrICqo9_NTY05loUAfI_xmN9A'
    // ]]);
    // $address = json_decode($response->getBody()->getContents());

    // return [
    //     'endereco' => $cedente->endereco,
    //     'bairro' => $cedente->bairro,
    //     'cidade' => $cedente->cidade,
    //     'uf' => $cedente->uf,
    //     'cep' => $cedente->cep,
    //     'latitude' => $address->results[0]->geometry->location->lat ?? null,
    //     'longitude' => $address->results[0]->geometry->location->lng ?? null,
    // ];

    // protected function prepareAccessToken()
    // {
    //     // "Content-Type"=>"application/x-www-form-urlencoded;charset=UTF-8"
    //     // . base64_encode()

    //     try {
    //         $value = ["grant_type" => "client_credentials"];
    //         $header = [

    //             ];
    //         $response = $this->client->post($url, ['query' => $value,'headers' => $header]);
    //         $result = json_decode($response->getBody()->getContents());

    //         $this->accesstoken = $result->access_token;
    //     }
    //     catch (RequestException $e) {
    //         $response = $this->statusCodeHandling($e);
    //         return $response;
    //     }
    // }

}
