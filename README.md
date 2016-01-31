# Wrapper for Multisafepay Library

https://www.multisafepay.com/documentation/doc/API-Reference/

https://github.com/MultiSafepay/PHP


Put this in your composer.json


```javascript
{
    "require": {
        "athenaspa/multisafepay": "dev-master"
    },
    "repositories": [{
        "type": "git",
        "url": "https://github.com/athenaspa/multisafepay.git"
    }],
    "autoload": {
        "files": ["vendors/multisafepay/api/models/API/Autoloader.php"]
    },
    "config": {
        "vendor-dir": "vendors"
    }
}
```
