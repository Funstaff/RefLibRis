<?php

namespace Funstaff\RefLibRis\Tests;

use Funstaff\RefLibRis\RisFieldsMapping;

/**
 * RisFieldsMappingTest
 *
 * @author Bertrand Zuchuat <bertrand.zuchuat@gmail.com>
 */
class RisFieldsMappingTest extends \PHPUnit_Framework_TestCase
{
    /**
     * testFindField
     */
    public function testFindField()
    {
        $fieldMapping = new RisFieldsMapping($this->getMapping());
        $this->assertEquals('CN', $fieldMapping->findRisFieldByFieldName('isbn'));
        $this->assertNull($fieldMapping->findRisFieldByFieldName('ZZ'));
    }

    private function getMapping()
    {
        return [
            'TY' => ['type'],
            'CN' => ['isbn', 'issn'],
            'LA' => ['language'],
        ];
    }
}