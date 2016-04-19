<?php

namespace TrezeVel\TrezeDatabase\Tests;

use TrezeVel\TrezeDatabase\Models\Category;
use TrezeVel\TrezeDatabase\Repository\CategoryRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Mockery as m;

/**
* Model de teste da categoria
*/
class CategoryRepositoryTest extends AbstractTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->migrate();
    }

    public function testCanModel()
    {
        $repository = new CategoryRepository();
        $this->assertEquals(Category::class, $repository->model());
    }

    public function testCatMakeModel()
    {
        $repository = new CategoryRepository();

        $result = $repository->makeModel();
        $this->assertInstanceOf(Category::class, $result);

        $reflectionClass = new \ReflectionClass($repository);
        $reflectionProperty = $reflectionClass->getProperty('model');
        $reflectionProperty->setAccessible(true);

        $result = $reflectionProperty->getValue($repository);
        $this->assertInstanceOf(Category::class, $result);
    }


    public function testCanMakeModelInConstructor()
    {
        $repository = new CategoryRepository();

        $reflectionClass = new \ReflectionClass($repository);
        $reflectionProperty = $reflectionClass->getProperty('model');
        $reflectionProperty->setAccessible(true);

        $result = $reflectionProperty->getValue($repository);
        $this->assertInstanceOf(Category::class, $result);
    }
}
