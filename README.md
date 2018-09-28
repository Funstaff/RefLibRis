RefLibRis
===

[![Build Status](https://travis-ci.org/Funstaff/RefLibRis.svg?branch=master)](https://travis-ci.org/Funstaff/RefLibRis)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Funstaff/RefLibRis/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Funstaff/RefLibRis/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/Funstaff/RefLibRis/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/Funstaff/RefLibRis/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/funstaff/ref-lib-ris/v/stable)](https://packagist.org/packages/funstaff/ref-lib-ris)
[![License](https://poser.pugx.org/funstaff/ref-lib-ris/license)](https://packagist.org/packages/funstaff/ref-lib-ris)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/0ae60c3a-8405-4e4f-baae-f5d697e367a9/mini.png)](https://insight.sensiolabs.com/projects/0ae60c3a-8405-4e4f-baae-f5d697e367a9)

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
    "funstaff/ref-lib-ris": ">=2.0"
  }
}
```

## Use
```php
<?php

namespace ...;

use Funstaff\RefLibRis\RecordProcessing;
use Funstaff\RefLibRis\RisDefinition;
use Funstaff\RefLibRis\RisMappings;
use Funstaff\RefLibRis\RisWriter;

$mapping = [
    'DEFAULT' => [
        'TY' => ['type'],
        'AU' => ['author'],
        'TI' => ['title', 'title_secondary'],
    ],
    'BOOK' => [
        'TY' => ['type'],
        'AU' => ['author'],
        'TI' => ['title', 'title_secondary'],
        'ID' => ['recordid']
    ]
];

$recordDb = [
    'title' => ['History of the CDC PY - 1999'],
    'author' => ['Behrens, J.', 'Behrens, A.'],
    'type' => ['BOOK']
];

$risMappings = new RisMappings($mapping, 'DEFAULT');
$recordProcessing = new RecordProcessing($risMappings);
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
