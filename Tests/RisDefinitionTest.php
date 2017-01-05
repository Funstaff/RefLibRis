<?php

namespace Funstaff\RefLibRis\Tests;

use Funstaff\RefLibRis\RisDefinition;

/**
 * RisDefinitionTest
 *
 * @author Bertrand Zuchuat <bertrand.zuchuat@gmail.com>
 */
class RisDefinitionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var RisDefinition
     */
    private $risDefinition;

    /**
     * Setup
     */
    public function setUp()
    {
        $this->risDefinition = new RisDefinition();
    }

    /**
     * fieldsTest
     */
    public function testHasField()
    {
        $this->assertTrue($this->risDefinition->hasField('C1'));
        $this->assertFalse($this->risDefinition->hasField('ZZ'));
    }

    /**
     * testGetFields
     */
    public function testGetFields()
    {
        $this->assertInternalType('array', $this->risDefinition->getFields());
        $this->assertContains('CN', $this->risDefinition->getFields());
    }

    /**
     * testFieldDefinition
     */
    public function testFieldDefinition()
    {
        $this->assertEquals('Date', $this->risDefinition->getFieldDefinition('DA'));
    }

    /**
     * testExceptionFieldDefinition
     */
    public function testExceptionFieldDefinition()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->risDefinition->getFieldDefinition('ZZ');
    }

    /**
     * testHasType
     */
    public function testHasType()
    {
        $this->assertTrue($this->risDefinition->hasType('COMP'));
        $this->assertFalse($this->risDefinition->hasType('ZZ'));
    }

    /**
     * testGetTypes
     */
    public function testGetTypes()
    {
        $this->assertInternalType('array', $this->risDefinition->getTypes());
        $this->assertContains('JOUR', $this->risDefinition->getTypes());
    }

    /**
     * testTypeDefinition
     */
    public function testTypeDefinition()
    {
        $this->assertEquals('Book Section', $this->risDefinition->getTypeDefinition('CHAP'));
    }

    /**
     * testExceptionTypeDefinition
     */
    public function testExceptionTypeDefinition()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->risDefinition->getTypeDefinition('ZZ');
    }
}