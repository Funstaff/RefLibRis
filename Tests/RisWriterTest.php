<?php

namespace Funstaff\RefLibRis\Tests;

use Funstaff\RefLibRis\RisDefinition;
use Funstaff\RefLibRis\RisWriter;

/**
 * RisWriterTest
 *
 * @author Bertrand Zuchuat <bertrand.zuchuat@gmail.com>
 */
class RisWriterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var RisWriter
     */
    private $writer;

    /**
     * setUp
     */
    public function setUp()
    {
        $this->writer = new RisWriter(new RisDefinition());
    }

    /**
     * testExceptionProcess
     */
    public function testExceptionProcess()
    {
        $this->expectException(\LengthException::class);
        $this->writer->process();
    }

    /**
     * testProcess
     */
    public function testRecordProcess()
    {
        $this->assertEquals(
            $this->getResultRecord(),
            $this->writer->addRecord($this->getRecord())->process()
        );
    }

    /**
     * testRecordsProcess
     */
    public function testRecordsProcess()
    {
        $records = [
            $this->getRecord(),
            $this->getRecord(),
        ];

        foreach ($records as $record) {
            $this->writer->addRecord($record);
        }
        $this->assertEquals(
            $this->getResultRecords(),
            $this->writer->process()
        );
    }

    /**
     * testSetRecordsProcess
     */
    public function testSetRecordsProcess()
    {
        $records = [
            $this->getRecord(),
            $this->getRecord(),
        ];

        $this->writer->setRecords($records);
        $this->assertEquals(
            $this->getResultRecords(),
            $this->writer->process()
        );
    }

    /**
     * testRecordExceptionTYNotFound
     */
    public function testRecordExceptionTYNotFound()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->writer->addRecord([
            'AU' => ['Foo', 'Bar'],
        ])->process();
    }

    /**
     * testTagException
     */
    public function testTagException()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->writer->addRecord([
            'ZZ' => ['Foo', 'Bar'],
        ])->process();
    }

    /**
     * testRecordNoValidation
     */
    public function testRecordNoValidation()
    {
        $this->assertEquals(
            $this->getResultRecordCustom(),
            $this->writer->addRecord($this->getRecordCustom())->process()
        );
    }

    /**
     * @return array
     */
    private function getRecord()
    {
        return [
            'TY' => 'BOOK',
            'AU' => ['Behrens, J.'],
            'TI' => ['History of the CDC PY - 1999'],
            'CY' => ['Chicago'],
            'PB' => ['Parity Press'],
            'SP' => ['144'],
            'VL' => ['2nd'],
            'KW' => ['Epidemiology', 'U.S. Gov\'t'],
            'DO' => ['DOI: 10.xxxxxxxxx'],
        ];
    }

    private function getRecordCustom()
    {
        return [
            'TY' => 'BOOK',
            'ZZ' => ['File'],
        ];
    }

    private function getResultRecord()
    {
        return file_get_contents(__DIR__.'/data/single.ris');
    }

    private function getResultRecordCustom()
    {
        return file_get_contents(__DIR__.'/data/single_custom.ris');
    }

    private function getResultRecords()
    {
        return file_get_contents(__DIR__.'/data/multiple.ris');
    }
}