tixastronauta/acc-ip
=============================

[![Build Status](https://travis-ci.org/tixastronauta/acc-ip.svg?branch=master)](https://travis-ci.org/tixastronauta/acc-ip)

PHP 5 library to retrieve client's accurate IP Address

# Installing

Add this library as a composer dependency:

```
$ composer require tixastronauta/acc-ip
```

# Using

```php
require 'vendor/autoload.php'

use TixAstronauta\AccIp\AccIp as AccIp;

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
