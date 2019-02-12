<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class SchemaTest extends TestCase
{

    private $schema;
    private $sample = [
        'prop1' => 1,
        'prop2' => false,
        'prop3' => "string"
    ];

    public function setUp()
    {
        $this->schema = \MOM\Schema::create($this->sample);
    }

    public function test__isset()
    {
        $this->assertEquals(
            true,
            isset($this->schema->prop2)
        );
    }

    public function testToJSON()
    {
        $this->assertJson(
            (new \MOM\Schema($this->sample))->toJSON()
        );
    }

    public function testCreate()
    {
        $this->assertInstanceOf(
            \MOM\Schema::class,
            \MOM\Schema::create($this->sample)
        );
    }

    public function test__set()
    {
        $this->schema->foo = "bar";

        $this->assertObjectHasAttribute('foo', $this->schema);
    }

    public function testRemove()
    {
        $this->schema->remove('prop1');

        $this->assertObjectNotHasAttribute('prop1', $this->schema);
    }

    public function testFromJSON()
    {
        $this->assertObjectHasAttribute(
            'jsontest',
            \MOM\Schema::create(['jsontest'])
        );
    }

    public function testToArray()
    {
        $this->assertIsArray(
            \MOM\Schema::create($this->sample)->toArray()
        );
    }

    public function testUpdate()
    {
        $this->schema->add('newprop', 5);
        $this->schema->update('newprop', 'renamedprop');

        $this->assertObjectHasAttribute('renamedprop', $this->schema);
        $this->assertObjectNotHasAttribute('newprop', $this->schema);
    }

    public function testAdd()
    {
        $this->schema->add('addedprop');

        $this->assertObjectHasAttribute('addedprop', $this->schema);
    }

    public function test__get()
    {
        $this->assertEquals(
            false,
            $this->schema->prop2
        );
        $this->assertEquals(
            "string",
            $this->schema->prop3
        );
    }
}
