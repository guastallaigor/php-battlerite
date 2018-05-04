<?php

namespace guastallaigor\PhpBattlerite\Tests;

use guastallaigor\PhpBattlerite\Config;
use guastallaigor\PhpBattlerite\Main;
use Illuminate\Support\Arr;
use SebastianBergmann\Comparator\DoubleComparatorTest;

/**
 * PHP-Battlerite easy API
 *
 * @category  Games
 * @package   tests
 * PhpBattleriteTest class
 * @author    Igor Guastalla de Lima  <limaguastallaigor@gmail.com>
 * @copyright 2018 PHP Battlerite
 * @license   MIT https://github.com/guastallaigor/php-battlerite/blob/master/LICENSE
 * @link      https://github.com/guastallaigor/php-battlerite
 */
class PhpBattleriteTest extends TestCase
{
    private $playerData = [
        'type' => 'object',
        'required' => ['type', 'id', 'attributes', 'titleId', 'relationships', 'links'],
        'properties' => [
            'type' => ['type' => 'string'],
            'id' => ['type' => 'string'],
            'attributes' => [
                'type' => 'object',
                'required' => ['name', 'patchVersion', 'shardId', 'stats'],
                'properties' => [
                    'name' => ['type' => 'string'],
                    'patchVersion' => ['type' => 'string'],
                    'shardId' => ['type' => 'string'],
                    'stats' => ['type' => 'object']
                ]
            ],
            'titleId' => ['type' => 'string'],
            'relationships' => [
                'type' => 'object',
                'required' => ['assets'],
                'properties' => [
                    'assets' => [
                        'type' => 'object',
                        'required' => ['data'],
                        'properties' => [
                            'data' => ['type' => 'array']
                        ]
                    ]
                ]
            ],
            'links' => [
                'type' => 'object',
                'required' => ['schema', 'self'],
                'properties' => [
                    'schema' => ['type' => 'string'],
                    'self' => ['type' => 'string'],
                ]
            ]
        ]
    ];

    public function testGetASinglePlayer()
    {
        $main = $this->buildMain();
        $id = '812023674780659712';
        $response = $main->getPlayer($id);

        $this->assertJsonDocumentMatchesSchema($response, [
            'type' => 'object',
            'required' => ['data'],
            'data' => [$this->playerData],
        ]);
    }

    public function testGetACollectionOfTwoPlayers()
    {
        $main = $this->buildMain();
        $ids = '812023674780659712,779528393816432640';
        $response = $main->getPlayers($ids);

        $this->assertJsonDocumentMatchesSchema($response, [
            'type' => 'object',
            'required' => ['data'],
            'data' => [
                $this->playerData,
                $this->playerData,
            ],
        ]);
    }

    public function testGetBattleriteStatus()
    {
        $main = $this->buildMain();
        $response = $main->getStatus();

        $this->assertJsonDocumentMatchesSchema($response, [
            'type' => 'object',
            'required' => ['data'],
            'data' => [
                'type' => 'object',
                'required' => ['type', 'id', 'attributes'],
                'properties' => [
                    'type' => ['type' => 'string'],
                    'id' => ['type' => 'string'],
                    'attributes' => [
                        'type' => 'object',
                        'required' => ['releasedAt', 'version'],
                        'properties' => [
                            'releasedAt' => ['type' => 'string'],
                            'version' => ['type' => 'string'],
                        ]
                    ]
                ]
            ]
        ]);
    }

    /**
     * @return Main
     * @throws \guastallaigor\PhpBattlerite\Exceptions\ConfigFileNotFoundException
     */
    private function buildMain()
    {
        $config = new Config();
        $main = new Main($config);
        $main->setAPIKey($config->get('apikey'));

        return $main;
    }
}
