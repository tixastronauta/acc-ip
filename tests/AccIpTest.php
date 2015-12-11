<?php

/*
The MIT License (MIT)

Copyright (c) 2015 Tiago 'Tix' Carvalho

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
 */

class AccIpTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider serverEnvironmentGood
     */
    public function testRemoteAddr($server, $expectedIp)
    {
        $c = new \TixAstronauta\AccIp\AccIp($server);
        $this->assertEquals($expectedIp, $c->getIpAddress());
    }

    /**
     * @dataProvider serverEnvironmentBad
     */
    public function testBadServerArray($server)
    {
        $c = new \TixAstronauta\AccIp\AccIp($server);
        $this->assertFalse($c->getIpAddress());
    }

    /**
     * @dataProvider serverEnvironmentCustomHeaders
     */
    public function testCustomHeaders($server, $headers, $expectedIp)
    {
        $c = new \TixAstronauta\AccIp\AccIp($server, $headers);
        $this->assertEquals($expectedIp, $c->getIpAddress());

    }

    /**
     * @return array
     */
    public function serverEnvironmentGood()
    {
        return [
            [
                // $server 1
                [
                    'REMOTE_ADDR' => '127.0.0.1'
                ],
                // expected output
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
    public function serverEnvironmentBad()
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
    public function serverEnvironmentCustomHeaders()
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