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

namespace TixAstronauta\AccIp;

/**
 * Class AccIp
 * @author Tiago Carvalho <tiago.carvalho@gmail.com>
 */
class AccIp
{

    /**
     * @var array $server
     */
    private $server;

    /**
     * @var array $headers
     */
    private $headers;

    /**
     * AccIp constructor
     *
     * @param array $server the $_SERVER variable
     * @param array $headers ordered array of headers to check for the real ip (best to worst)
     */
    public function __construct($server = [], $headers = [])
    {
        if (empty($server))
        {
            $server = $_SERVER;
        }
        if (empty($headers))
        {
            $headers = $this->getDefaultHeaders();
        }

        $this->server = $server;
        $this->headers = $headers;
    }

    /**
     * Returns the default headers to check for the real ip (best to worst)
     */
    private function getDefaultHeaders()
    {
        return [
            'HTTP_CLIENT_IP',
            'HTTP_X_FORWARDED_FOR',
            'HTTP_X_FORWARDED',
            'HTTP_X_CLUSTER_CLIENT_IP',
            'HTTP_FORWARDED_FOR',
            'HTTP_FORWARDED',
            'HTTP_X_REAL_IP',
            'REMOTE_ADDR'
        ];
    }

    /**
     * Returns client's accurate IP Address
     *
     * @return bool|string ip address, false on failure
     */
    public function getIpAddress()
    {
        foreach ($this->headers as $k)
        {
            if (isset($this->server[$k]))
            {
                // header can be comma separated
                $ips = explode(',', $this->server[$k]);
                $ip = trim(end($ips));
                $ip = filter_var($ip, FILTER_VALIDATE_IP);
                if (false !== $ip)
                {
                    return $ip;
                }
            }
        }

        // no valid ip found
        return false;
    }

}