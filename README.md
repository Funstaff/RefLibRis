RefLibRis
===

* Author: Bertrand Zuchuat <bertrand.zuchuat@gmail.com>
* License: MIT

This library provide a writer to RIS data format.

## Installation

1. Follow the instructions at http://packagist.org
2. In your new project, create a `composer.json` file which requires
   RefLibRis:

```javascript
{
  "require": {
    "funstaff/ref-lib-ris": ">=1.0"
  }
}
```

## Use
```php
<?php

namespace ...;

use Funstaff\RefLibRis\RisWriter;
use Funstaff\RefLibRis\RisDefinition;

$writer = new RisWriter(new RisDefinition());

$record = [
    'TY' => 'BOOK',
    'AU' => ['Behrens, J.'],
    'TI' => ['History of the CDC PY - 1999']
];

$output = $writer->addRecord($record)->process();
```

## Found a bug

If you found a bug, *please* let me know. The best way is to file a report at 
[http://github.com/funstaff/RefLibRis/issues](http://github.com/funstaff/RefLibRis/issues).