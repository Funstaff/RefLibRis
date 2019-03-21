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
     * @var RisFieldsMapping
     */
    private $fieldMapping;

    /**
     * setUp
     */
    public function setUp()
    {
        $this->fieldMapping = new RisFieldsMapping($this->getMapping());
    }

    /**
     * testFindField
     */
    public function testFindField()
    {
        $this->assertEquals(['CN'], $this->fieldMapping->findRisFieldByFieldName('isbn'));
        $this->assertEquals([], $this->fieldMapping->findRisFieldByFieldName('ZZ'));
    }

    /**
     * testGetAllRisFields
     */
    public function testGetAllRisFields()
    {
        $this->assertEquals(array_keys($this->getMapping()), $this->fieldMapping->getAllRisFields());
    }

    /**
     * @return array
     */
    private function getMapping()
    {
        return [
            'TY' => ['type'],
            'CN' => ['isbn', 'issn'],
            'LA' => ['language'],
        ];
    }
}