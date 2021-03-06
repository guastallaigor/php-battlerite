<?php

namespace guastallaigor\PhpBattlerite\Tests;

use guastallaigor\PhpBattlerite\Config;
use guastallaigor\PhpBattlerite\Main;
use Illuminate\Support\Arr;
use SebastianBergmann\Comparator\DoubleComparatorTest;

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
class PhpBattleriteTest extends TestCase
{
    private $player = [
        'type'       => 'object',
        'required'   => ['type', 'id', 'attributes', 'titleId', 'relationships', 'links'],
        'properties' => [
            'type'       => ['type' => 'string'],
            'id'         => ['type' => 'string'],
            'attributes' => [
                'type'       => 'object',
                'required'   => ['name', 'patchVersion', 'shardId', 'stats'],
                'properties' => [
                    'name'         => ['type' => 'string'],
                    'patchVersion' => ['type' => 'string'],
                    'shardId'      => ['type' => 'string'],
                    'stats'        => ['type' => 'object'],
                ],
            ],
            'titleId'       => ['type' => 'string'],
            'relationships' => [
                'type'       => 'object',
                'required'   => ['assets'],
                'properties' => [
                    'assets' => [
                        'type'       => 'object',
                        'required'   => ['data'],
                        'properties' => [
                            'data' => ['type' => 'array'],
                        ],
                    ],
                ],
            ],
            'links' => [
                'type'       => 'object',
                'required'   => ['schema', 'self'],
                'properties' => [
                    'schema' => ['type' => 'string'],
                    'self'   => ['type' => 'string'],
                ],
            ],
        ],
    ];
    private $team = [
        'type'       => 'object',
        'required'   => ['type', 'id', 'attributes', 'relationships'],
        'properties' => [
            'type'       => ['type' => 'string'],
            'id'         => ['type' => 'string'],
            'attributes' => [
                'type'       => 'object',
                'required'   => ['name', 'shardId', 'stats', 'titleId'],
                'properties' => [
                    'name'    => ['type' => 'string'],
                    'shardId' => ['type' => 'string'],
                    'stats'   => ['type' => 'string'],
                    'titleId' => ['type' => 'object'],
                ],
            ],
            'relationships' => [
                'type'       => 'object',
                'required'   => ['assets'],
                'properties' => [
                    'assets' => [
                        'type'       => 'object',
                        'required'   => ['data'],
                        'properties' => [
                            'data' => ['type' => 'array'],
                        ],
                    ],
                ],
            ],
        ],
    ];
    private $roster = [
        'type'       => 'object',
        'required'   => ['type', 'id', 'attributes', 'relationships'],
        'properties' => [
            'type'       => ['type' => 'string'],
            'id'         => ['type' => 'string'],
            'attributes' => [
                'type'       => 'object',
                'required'   => ['shardId', 'stats', 'won'],
                'properties' => [
                    'shardId' => ['type' => 'string'],
                    'stats'   => [
                        'type'       => 'object',
                        'required'   => ['score', 'side'],
                        'properties' => [
                            'score' => ['type' => 'string'],
                            'side'  => ['type' => 'string'],
                        ],
                    ],
                    'won' => ['type' => 'string'],
                ],
            ],
            'relationships' => [
                'type'       => 'object',
                'required'   => ['participants', 'team'],
                'properties' => [
                    'participants' => [
                        'type'       => 'object',
                        'required'   => ['data'],
                        'properties' => [
                            'data' => [
                                'type'       => 'array',
                                'required'   => ['type', 'id'],
                                'properties' => [
                                    'type' => ['type' => 'string'],
                                    'id'   => ['type' => 'string'],
                                ],
                            ],
                        ],
                    ],
                    'team' => [
                        'type'       => 'object',
                        'required'   => ['data'],
                        'properties' => [
                            'data' => ['type' => 'object'],
                        ],
                    ],
                ],
            ],
        ],
    ];
    private $participant = [
        'type'       => 'object',
        'required'   => ['type', 'id', 'attributes', 'relationships'],
        'properties' => [
            'type'       => ['type' => 'string'],
            'id'         => ['type' => 'string'],
            'attributes' => [
                'type'       => 'object',
                'required'   => ['actor', 'shardId', 'stats'],
                'properties' => [
                    'actor'   => ['type' => 'string'],
                    'shardId' => ['type' => 'string'],
                    'stats'   => [
                        'type'       => 'object',
                        'required'   => ['attachment', 'emote', 'mount', 'outfit'],
                        'properties' => [
                            'attachment' => ['type' => 'number'],
                            'emote'      => ['type' => 'number'],
                            'mount'      => ['type' => 'number'],
                            'outfit'     => ['type' => 'number'],
                        ],
                    ],
                    'won' => ['type' => 'string'],
                ],
            ],
            'relationships' => [
                'type'       => 'object',
                'required'   => ['participants', 'team'],
                'properties' => [
                    'participants' => [
                        'type'       => 'object',
                        'required'   => ['data'],
                        'properties' => [
                            'data' => [
                                'type'       => 'array',
                                'required'   => ['type', 'id'],
                                'properties' => [
                                    'type' => ['type' => 'string'],
                                    'id'   => ['type' => 'string'],
                                ],
                            ],
                        ],
                    ],
                    'team' => [
                        'type'       => 'object',
                        'required'   => ['data'],
                        'properties' => [
                            'data' => ['type' => 'object'],
                        ],
                    ],
                ],
            ],
        ],
    ];
    private $round = [
        'type'       => 'object',
        'required'   => ['type', 'id', 'attributes', 'relationships'],
        'properties' => [
            'type'       => ['type' => 'string'],
            'id'         => ['type' => 'string'],
            'attributes' => [
                'type'       => 'object',
                'required'   => ['duration', 'ordinal', 'stats'],
                'properties' => [
                    'duration' => ['type' => 'string'],
                    'ordinal'  => ['type' => 'string'],
                    'stats'    => [
                        'type'       => 'object',
                        'required'   => ['winningTeam'],
                        'properties' => [
                            'winningTeam' => ['type' => 'number'],
                        ],
                    ],
                ],
            ],
            'relationships' => [
                'type'       => 'object',
                'required'   => ['participants'],
                'properties' => [
                    'participants' => [
                        'type'       => 'object',
                        'required'   => ['data'],
                        'properties' => [
                            'data' => ['type' => 'array'],
                        ],
                    ],
                ],
            ],
        ],
    ];
    private $asset = [
        'type'       => 'object',
        'required'   => ['type', 'id', 'attributes'],
        'properties' => [
            'type'       => ['type' => 'string'],
            'id'         => ['type' => 'string'],
            'attributes' => [
                'type'       => 'object',
                'required'   => ['URL', 'createdAt', 'description', 'name'],
                'properties' => [
                    'URL'         => ['type' => 'string'],
                    'createdAt'   => ['type' => 'string'],
                    'description' => ['type' => 'string'],
                    'name'        => ['type' => 'string'],
                ],
            ],
        ],
    ];

    public function testGetASinglePlayer()
    {
        $main = $this->buildMain();
        $id = '812023674780659712';
        $response = $main->getPlayer($id);

        $this->assertJsonDocumentMatchesSchema($response, [
            'type'     => 'object',
            'required' => ['data'],
            'data'     => [$this->player],
        ]);
    }

    public function testGetACollectionOfTwoPlayersByPlayerId()
    {
        $main = $this->buildMain();
        $ids = '812023674780659712,804508313378234368';
        $response = $main->getPlayers($ids);

        $this->assertJsonDocumentMatchesSchema($response, [
            'type'     => 'object',
            'required' => ['data'],
            'data'     => [
                $this->player,
                $this->player,
            ],
        ]);
    }

    public function testGetBattleriteStatus()
    {
        $main = $this->buildMain();
        $response = $main->getStatus();

        $this->assertJsonDocumentMatchesSchema($response, [
            'type'     => 'object',
            'required' => ['data'],
            'data'     => [
                'type'       => 'object',
                'required'   => ['type', 'id', 'attributes'],
                'properties' => [
                    'type'       => ['type' => 'string'],
                    'id'         => ['type' => 'string'],
                    'attributes' => [
                        'type'       => 'object',
                        'required'   => ['releasedAt', 'version'],
                        'properties' => [
                            'releasedAt' => ['type' => 'string'],
                            'version'    => ['type' => 'string'],
                        ],
                    ],
                ],
            ],
        ]);
    }

    public function testGetFilteredMatches()
    {
        $main = $this->buildMain();
        $filters = [
            'limit'       => '1',
            'sort'        => 'createdAt',
            'serverType'  => 'QUICK2V2,QUICK3V3',
            'rankingType' => 'RANKED',
            'playerIds'   => '812023674780659712',
        ];
        $response = $main->getMatches($filters);
        dd($response);

        $this->assertJsonDocumentMatchesSchema($response, [
            'type'     => 'object',
            'required' => ['data', 'included', 'links', 'meta'],
            'data'     => [
                'type'       => 'object',
                'required'   => ['type', 'id', 'attributes', 'relationships', 'links'],
                'properties' => [
                    'type'       => ['type' => 'string'],
                    'id'         => ['type' => 'string'],
                    'attributes' => [
                        'type'       => 'object',
                        'required'   => ['createdAt', 'duration', 'gameMode', 'patchVersion', 'shardId', 'stats', 'tags', 'titleId'],
                        'properties' => [
                            'createdAt'    => ['type' => 'string'],
                            'duration'     => ['type' => 'string'],
                            'gameMode'     => ['type' => 'string'],
                            'patchVersion' => ['type' => 'string'],
                            'shardId'      => ['type' => 'string'],
                            'stats'        => [
                                'type'       => 'object',
                                'required'   => ['mapID', 'type'],
                                'properties' => [
                                    'mapID'  => ['type' => 'string'],
                                    'type'   => ['type' => 'string'],
                                ],
                            ],
                            'tags' => [
                                'type'       => 'object',
                                'required'   => ['rankingType', 'serverType'],
                                'properties' => [
                                    'rankingType' => ['type' => 'string'],
                                    'serverType'  => ['type' => 'string'],
                                ],
                            ],
                            'titleId' => ['type' => 'string'],
                        ],
                    ],
                    'relationships' => [
                        'type'       => 'object',
                        'required'   => ['assets', 'rosters', 'rounds', 'spectators'],
                        'properties' => [
                            'assets' => [
                                'type'       => 'string',
                                'required'   => ['data'],
                                'properties' => [
                                    'data' => [
                                        'type'       => 'array',
                                        'required'   => ['type', 'id'],
                                        'properties' => [
                                            'type' => ['type' => 'string'],
                                            'id'   => ['type' => 'string'],
                                        ],
                                    ],
                                ],
                            ],
                            'rosters' => [
                                'data' => [
                                    'type'       => 'array',
                                    'required'   => ['type', 'id'],
                                    'properties' => [
                                        'type' => ['type' => 'string'],
                                        'id'   => ['type' => 'string'],
                                    ],
                                ],
                            ],
                            'rounds' => [
                                'data' => [
                                    'type'       => 'array',
                                    'required'   => ['type', 'id'],
                                    'properties' => [
                                        'type' => ['type' => 'string'],
                                        'id'   => ['type' => 'string'],
                                    ],
                                ],
                            ],
                            'spectators' => [
                                'data' => ['type' => 'array'],
                            ],
                        ],
                    ],
                    'links' => [
                        'type'       => 'object',
                        'required'   => ['schema', 'self'],
                        'properties' => [
                            'schema' => ['type' => 'string'],
                            'self'   => ['type' => 'string'],
                        ],
                    ],
                ],
            ],
            // missing some comparisons on array bellow
            'included' => [
                'type'       => 'array',
                'properties' => [
                    'type'       => ['type' => 'string'],
                    'id'         => ['type' => 'string'],
                    'attributes' => [
                        'type'       => 'object',
                        'properties' => [
                            'duration' => ['type' => 'number'],
                            'ordinal'  => ['type' => 'number'],
                            'stats'    => [
                                'type'       => 'object',
                                'required'   => ['winningTeam'],
                                'properties' => [
                                    'winningTeam' => ['type' => 'number'],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            'links' => [
                'type'       => 'object',
                'required'   => ['next', 'self'],
                'properties' => [
                    'next' => ['type' => 'string'],
                    'self' => ['type' => 'string'],
                ],
            ],
            'meta' => ['type' => 'object'],
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
