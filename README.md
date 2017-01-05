RefLibRis
===

[![Build Status](https://travis-ci.org/Funstaff/RefLibRis.svg?branch=master)](https://travis-ci.org/Funstaff/RefLibRis)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Funstaff/RefLibRis/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Funstaff/RefLibRis/?branch=master)

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

use Funstaff\RefLibRis\RecordProcessing;
use Funstaff\RefLibRis\RisDefinition;
use Funstaff\RefLibRis\RisFieldsMapping;
use Funstaff\RefLibRis\RisWriter;

$mapping = [
    'TY' => ['type'],
    'AU' => ['author'],
    'TI' => ['title', 'title_secondary'],
];

$risFieldsMapping = new RisFieldsMapping($mapping);

$recordDb = [
    'title' => ['History of the CDC PY - 1999'],
    'author' => ['Behrens, J.', 'Behrens, A.'],
    'type' => ['BOOK']
];

$recordProcessing = new RecordProcessing($risFieldsMapping);
$record = $recordProcessing->process($recordDb);

$writer = new RisWriter(new RisDefinition());
$output = $writer->addRecord($record)->process();
```
Output:
```ex
TY  - BOOK
AU  - Behrens, J.
AU  - Behrens, A.
TI  - History of the CDC PY - 1999
ER  -

```

## Found a bug

If you found a bug, *please* let me know. The best way is to file a report at 
[http://github.com/funstaff/RefLibRis/issues](http://github.com/funstaff/RefLibRis/issues).