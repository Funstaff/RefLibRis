<?php

namespace Funstaff\RefLibRis\Tests;

use Funstaff\RefLibRis\RecordProcessing;
use Funstaff\RefLibRis\RisMappings;

/**
 * RecordProcessingTest
 *
 * @author Bertrand Zuchuat <bertrand.zuchuat@rero.ch>
 */
class RecordProcessingTest extends \PHPUnit_Framework_TestCase
{
    /**
     * testProcess
     */
    public function testProcess()
    {
        $risMappings = new RisMappings($this->getMapping(), 'default');
        $recordProcessing = new RecordProcessing($risMappings);
        $result = $recordProcessing->process($this->getRecord());
        $this->assertEquals($this->getResultRecord(), $result);
    }

    /**
     * testOtherTypeProcess
     */
    public function testOtherTypeProcess()
    {
        $risMappings = new RisMappings($this->getMapping(), 'default');
        $recordProcessing = new RecordProcessing($risMappings);
        $result = $recordProcessing->process($this->getRecordWithOtherFieldType(), 'idType');
        $this->assertEquals($this->getResultRecord(), $result);
    }

    /**
     * testException
     */
    public function testException()
    {
        $this->expectException(\InvalidArgumentException::class);
        $risMappings = new RisMappings($this->getMapping(), 'default');
        $recordProcessing = new RecordProcessing($risMappings);
        $recordProcessing->process($this->getRecord(), 'foo');
    }

    /**
     * @return array
     */
    private function getMapping()
    {
        return [
            'BOOK' => [
                'TY' => ['type', 'idType'],
                'SN' => ['isbn', 'issn'],
                'AU' => ['author'],
                'TI' => ['title'],
            ]
        ];
    }

    /**
     * @return array
     */
    private function getRecord()
    {
        return [
            'type' => ['BOOK'],
            'isbn' => ['2253167150'],
            'author' => ['Lisa Gardner'],
            'title' => ['La maison d\'à côté'],
        ];
    }

    private function getRecordWithOtherFieldType()
    {
        return [
            'idType' => ['BOOK'],
            'isbn' => ['2253167150'],
            'author' => ['Lisa Gardner'],
            'title' => ['La maison d\'à côté'],
        ];
    }

    private function getResultRecord()
    {
        return [
            'TY' => ['BOOK'],
            'SN' => ['2253167150'],
            'AU' => ['Lisa Gardner'],
            'TI' => ['La maison d\'à côté'],
        ];
    }
}
