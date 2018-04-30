<?php

namespace guastallaigor\PhpBattlerite\Tests;

use guastallaigor\PhpBattlerite\Config;
use guastallaigor\PhpBattlerite\Main;

/**
 * Class SampleTest
 *
 * @category Test
 * @package  guastallaigor\PhpBattlerite\Tests
 * @author   Igor Guastalla de Lima <limaguastallaigor@gmail.com>
 */
class PhpBattleriteTest extends TestCase
{
    private static $apiKey = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJqdGkiOiJlMzcwZGNjMC1iNWY3LTAxMzUtY2M4Yy0wYTU4NjQ2MGRjMzUiLCJpc3MiOiJnYW1lbG9ja2VyIiwiaWF0IjoxNTExODI1MDA0LCJwdWIiOiJzdHVubG9jay1zdHVkaW9zIiwidGl0bGUiOiJiYXR0bGVyaXRlIiwiYXBwIjoiZmFudGFzeS1lLWxlYWd1ZSIsInNjb3BlIjoiY29tbXVuaXR5IiwibGltaXQiOjEwfQ.KO7BudPBWqk8DHbfTCYgtwhJK7T3WVL_qiOUqaNt-O8';

    public function testGetASinglePlayer()
    {
        $main = new Main(new Config());
        $main->setAPIKey(self::$apiKey);
        $response = $main->getPlayer('812023674780659712');

        $this->assertJsonDocumentMatchesSchema($response, [
            'type' => 'object',
            'required' => ['data'],
            'data' => [
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
                            'self' => ['type' => 'string']
                        ]
                    ]
                ]
            ]
        ]);
    }



}
