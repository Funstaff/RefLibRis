<?php

namespace Funstaff\RefLibRis\Tests;

use Funstaff\RefLibRis\RecordProcessing;
use Funstaff\RefLibRis\RisFieldsMapping;

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
        $recordProcessing = new RecordProcessing(new RisFieldsMapping($this->getMapping()));
        $result = $recordProcessing->process($this->getRecord());
        $this->assertEquals($this->getResultRecord(), $result);
    }

    /**
     * @return array
     */
    private function getMapping()
    {
        return [
            'TY' => ['type'],
            'SN' => ['isbn', 'issn'],
            'AU' => ['author'],
            'TI' => ['title'],
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