tixastronauta/acc-ip
====================

[![Latest Stable Version](https://poser.pugx.org/tixastronauta/acc-ip/v)](//packagist.org/packages/tixastronauta/acc-ip)
[![Total Downloads](https://poser.pugx.org/tixastronauta/acc-ip/downloads)](//packagist.org/packages/tixastronauta/acc-ip)
[![Latest Unstable Version](https://poser.pugx.org/tixastronauta/acc-ip/v/unstable)](//packagist.org/packages/tixastronauta/acc-ip)
[![License](https://poser.pugx.org/tixastronauta/acc-ip/license)](//packagist.org/packages/tixastronauta/acc-ip)
[![CodeFactor](https://www.codefactor.io/repository/github/tixastronauta/acc-ip/badge)](https://www.codefactor.io/repository/github/tixastronauta/acc-ip)
[![Build Status](https://github.com/tixastronauta/acc-ip/actions/workflows/ci.yml/badge.svg)](https://github.com/tixastronauta/acc-ip/actions/workflows/ci.yml)

# Accurate IP Address

PHP library to retrieve the most accurate client's accurate IP Address.

Instead of simply checking the `$_SERVER['REMOTE_ADDR']` variable, this library checks for the most common headers that contain the client's IP Address:

| Header                       | Description                                                                                                                         |
|------------------------------|-------------------------------------------------------------------------------------------------------------------------------------|
| **HTTP_CF_CONNECTING_IP**    | Cloudflare-provided real IP of the client. Best when using Cloudflare as a proxy.                                                   |
| **HTTP_X_FORWARDED_FOR**     | Standard header used by proxies and load balancers. Can contain multiple IPs. The first valid non-private IP is usually the client. |
| **HTTP_X_REAL_IP**           | Used by Nginx and some proxies to pass the real IP.                                                                                 |
| **HTTP_X_CLUSTER_CLIENT_IP** | Commonly set by AWS Elastic Load Balancer and other cloud providers.                                                                |
| **HTTP_FORWARDED_FOR**       | RFC-compliant alternative to `X-Forwarded-For`. Similar functionality.                                                              |
| **HTTP_FORWARDED**           | RFC-compliant `Forwarded` header (e.g., `for=192.168.1.1;proto=http`).                                                              |
| **HTTP_X_FORWARDED**         | Similar to `X-Forwarded-For`, but used in some legacy systems.                                                                      |
| **HTTP_CLIENT_IP**           | Sometimes set by proxies but is easily spoofed, so it should not be fully trusted.                                                  |
| **REMOTE_ADDR**              | IP address of the direct connection. Often the load balancer or proxy IP rather than the real client. Used as a last resort.        |

# Installing

Add this library as a composer dependency:

```bash
composer require tixastronauta/acc-ip
```

# Using

```php
require 'vendor/autoload.php'

use TixAstronauta\AccIp;

$accIp = new AccIp();
$ipAddress = $accIp->getIpAddress(); // this is the client's accurate IP Address. false on failure
```

# License 

```
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
```
