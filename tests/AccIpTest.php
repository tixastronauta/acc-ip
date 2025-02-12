<?php

namespace TixAstronauta\AccIp\Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class AccIpTest extends TestCase
{
    /**
     * @dataProvider serverEnvironmentGood
     */
    #[DataProvider('serverEnvironmentGood')]
    public function testRemoteAddr($server, $expectedIp)
    {
        $c = new \TixAstronauta\AccIp\AccIp($server);
        $this->assertEquals($expectedIp, $c->getIpAddress());
    }

    /**
     * @dataProvider serverEnvironmentBad
     */
    #[DataProvider('serverEnvironmentBad')]
    public function testBadServerArray($server)
    {
        $c = new \TixAstronauta\AccIp\AccIp($server);
        $this->assertFalse($c->getIpAddress());
    }

    /**
     * @dataProvider serverEnvironmentCustomHeaders
     */
    #[DataProvider('serverEnvironmentCustomHeaders')]
    public function testCustomHeaders($server, $headers, $expectedIp)
    {
        $c = new \TixAstronauta\AccIp\AccIp($server, $headers);
        $this->assertEquals($expectedIp, $c->getIpAddress());
    }

    /**
     * @return array
     */
    public static function serverEnvironmentGood()
    {
        return [
            [
                ['REMOTE_ADDR' => '127.0.0.1'],
                '127.0.0.1'
            ],
            [
                // $server 2
                [
                    'REMOTE_ADDR'     => '216.58.211.238',
                    'HTTP_USER_AGENT' => 'Sample/User Agent'
                ],
                // expected output
                '216.58.211.238'
            ],
            [
                // $server 3
                [
                    'HTTP_X_FORWARDED_FOR' => '127.0.0.1,216.58.211.238'
                ],
                '216.58.211.238'
            ]
        ];
    }

    /**
     * @return array
     */
    public static function serverEnvironmentBad()
    {
        return [
            [
                // $server 1
                [
                    'REMOTEADDR' => '127.0.0.1'
                ]
            ],
            [
                // $server 2
                [
                    'HTTP_USER_AGENT' => 'Sample/User Agent'
                ]
            ],

        ];
    }

    /**
     * @return array
     */
    public static function serverEnvironmentCustomHeaders()
    {
        return [
            [
                // $server 1
                [
                    'X-My-Ip-Address' => '127.0.0.1',
                    'HTTP_USER_AGENT' => 'Sample/User Agent'
                ],
                // $headers
                [
                    'X-My-Ip-Address'
                ],
                // expected output
                '127.0.0.1'
            ],
            [
                // $server 2
                [
                    'X-My-Ip-Address' => '127.0.0.1,216.58.211.238',
                    'HTTP_USER_AGENT' => 'Sample/User Agent'
                ],
                // $headers
                [
                    'X-My-Ip-Address'
                ],
                // expected output
                '216.58.211.238'
            ]
        ];
    }
}
