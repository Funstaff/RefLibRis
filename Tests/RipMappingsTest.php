<?php

namespace Funstaff\RefLibRis\Tests;

use Funstaff\RefLibRis\RisMappings;

/**
 * RipMappingsTest
 *
 * @author Bertrand Zuchuat <bertrand.zuchuat@rero.ch>
 */
class RipMappingsTest  extends \PHPUnit_Framework_TestCase
{
    /**
     * testMappingsWithExistingType
     */
    public function testMappingsWithExistingType()
    {
        $ris = new RisMappings($this->getMapping(), 'default');
        $fieldsMapping = $ris->findRisFieldByType('BOOK');
        $this->assertInstanceOf('Funstaff\RefLibRis\RisFieldsMapping', $fieldsMapping);
        $this->assertContains('SN', $fieldsMapping->getAllRisFields());
    }

    /**
     * testMappingsFallback
     */
    public function testMappingsFallback()
    {
        $ris = new RisMappings($this->getMapping(), 'default');
        $fieldsMapping = $ris->findRisFieldByType('Foo');
        $this->assertInstanceOf('Funstaff\RefLibRis\RisFieldsMapping', $fieldsMapping);
        $this->assertContains('PB', $fieldsMapping->getAllRisFields());
    }

    /**
     * testMappingsExceptionType
     */
    public function testMappingsExceptionType()
    {
        $this->expectException(\InvalidArgumentException::class);
        $ris = new RisMappings($this->getMapping(), 'Bar');
        $ris->findRisFieldByType('Foo');
    }

    /**
     * @return array
     */
    private function getMapping()
    {
        return [
            'default' => [
                'TY' => ['type'],
                'AU' => ['author'],
                'TI' => ['title'],
                'PB' => ['publisher']
            ],
            'BOOK' => [
                'TY' => ['type'],
                'SN' => ['isbn', 'issn'],
                'AU' => ['author'],
                'TI' => ['title'],
            ]
        ];
    }
}
