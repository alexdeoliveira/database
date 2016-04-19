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

    protected $repository;

    public function setUp()
    {
        parent::setUp();
        $this->migrate();
        $this->repository = new CategoryRepository();
        $this->createCategory();
    }

    public function testCanModel()
    {
        $this->assertEquals(Category::class, $this->repository->model());
    }

    public function testCatMakeModel()
    {

        $result = $this->repository->makeModel();
        $this->assertInstanceOf(Category::class, $result);

        $reflectionClass = new \ReflectionClass($this->repository);
        $reflectionProperty = $reflectionClass->getProperty('model');
        $reflectionProperty->setAccessible(true);

        $result = $reflectionProperty->getValue($this->repository);
        $this->assertInstanceOf(Category::class, $result);
    }


    public function testCanMakeModelInConstructor()
    {

        $reflectionClass = new \ReflectionClass($this->repository);
        $reflectionProperty = $reflectionClass->getProperty('model');
        $reflectionProperty->setAccessible(true);

        $result = $reflectionProperty->getValue($this->repository);
        $this->assertInstanceOf(Category::class, $result);
    }

    public function testCanListAllCategories()
    {
        $result = $this->repository->all();
        $this->assertCount(3, $result);

        $this->assertNotNull($result[0]->description);

        $result = $this->repository->all(['name']);
        $this->assertNull($result[0]->description);
    }

    public function testCanCreateCategory()
    {
        $result = $this->repository->create([
            'name' => 'Name 4',
            'description' => 'Description 4'
        ]);
        $this->assertInstanceOf(Category::class, $result);

        $this->assertEquals('Name 4', $result->name);
        $this->assertEquals('Description 4', $result->description);

        $result = Category::find(4);
        $this->assertEquals('Name 4', $result->name);
        $this->assertEquals('Description 4', $result->description);

    }

    public function createCategory()
    {
        Category::create([
            'name' => 'Name 1',
            'description' => 'Description 1',
        ]);

        Category::create([
            'name' => 'Name 2',
            'description' => 'Description 2',
        ]);

        Category::create([
            'name' => 'Name 3',
            'description' => 'Description 3',
        ]);
    }
}
