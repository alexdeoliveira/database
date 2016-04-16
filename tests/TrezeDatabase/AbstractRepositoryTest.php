<?php

namespace TrezeVel\TrezeDatabase\Tests;

use TrezeVel\TrezeDatabase\AbstractRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Mockery as m;
use TrezeVel\TrezeDatabase\Repository\CategoryRepository;
use TrezeVel\TrezeDatabase\Models\Category;

/**
* Model de teste da categoria
*/
class AbstractRepositoryTest extends AbstractTestCase
{

    public function setUp()
    {
        parent::setUp();
        $this->migrate();
    }

    public function testCanModel()
    {
        $respository = new CategoryRepository();
        $this->assertEquals(Category::class, $respository->model());
    }
    
    
}
