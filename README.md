# S.ID

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