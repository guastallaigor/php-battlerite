<?php

namespace guastallaigor\PhpBattlerite\Tests;

use guastallaigor\PhpBattlerite\Config;
use guastallaigor\PhpBattlerite\Main;

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
    private static $apiKey = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJqdGkiOiJlMzcwZGNjMC1iNWY3LTAxMzUtY2M4Yy0wYTU4NjQ2MGRjMzUiLCJpc3MiOiJnYW1lbG9ja2VyIiwiaWF0IjoxNTExODI1MDA0LCJwdWIiOiJzdHVubG9jay1zdHVkaW9zIiwidGl0bGUiOiJiYXR0bGVyaXRlIiwiYXBwIjoiZmFudGFzeS1lLWxlYWd1ZSIsInNjb3BlIjoiY29tbXVuaXR5IiwibGltaXQiOjEwfQ.KO7BudPBWqk8DHbfTCYgtwhJK7T3WVL_qiOUqaNt-O8';
    private $playerData = [
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
                            'data' => ['type' => 'object']
                        ],
                    ],
                ],
            ],
        ],
    ];
    private $participante = [
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

    public function testGetASinglePlayer()
    {
        $main = $this->buildMain();
        $id = '812023674780659712';
        $response = $main->getPlayer($id);

        $this->assertJsonDocumentMatchesSchema($response, [
            'type'     => 'object',
            'required' => ['data'],
            'data'     => [$this->playerData],
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

        $this->assertJsonDocumentMatchesSchema($response, [
            'type'     => 'object',
            'required' => ['data', 'included', 'links', 'meta'],
            'data'     => [
                'type'       => 'object',
                'required'   => ['type', 'id', 'attributes', 'relationships', 'links'],
                'properties' => [
                    'type' => ['type' => 'string'],
                    'id'   => ['type' => 'string'],
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
            // missing some comparisions on array bellow
            'included' => [
                'type'       => 'array',
                'required'   => ['type', 'id', 'attributes'],
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

    private function buildMain()
    {
        $main = new Main(new Config());
        $main->setAPIKey(self::$apiKey);

        return $main;
    }
}
