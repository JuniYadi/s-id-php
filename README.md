# S.ID

[![Total Downloads](https://poser.pugx.org/juniyadi/s-id/downloads)](https://packagist.org/packages/juniyadi/s-id)
[![Latest Stable Version](https://poser.pugx.org/juniyadi/s-id/v/stable)](https://packagist.org/packages/juniyadi/s-id)
[![Build Status](https://travis-ci.org/JuniYadi/s-id-php.svg?branch=master)](https://travis-ci.org/JuniYadi/s-id-php)
[![License](https://poser.pugx.org/juniyadi/s-id/license)](https://packagist.org/packages/juniyadi/s-id)

This package for short url by https://s.id

# Install
```
composer require juniyadi/s-id
```

# How to Use
```php
use JuniYadi\SID;

$url = new SID();
$short = $url->short('https://google.com');

var_dump($short);

## Result
array(2) {
  ["url"]=>
  string(18) "https://s.id/70kin"
  ["original"]=>
  string(18) "https://google.com"
}
```

# Information
* License : [MIT](LICENSE)
* Authors : Juni Yadi
* Status : Unofficial Packages