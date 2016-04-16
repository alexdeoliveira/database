<?php

namespace TrezeVel\TrezeDatabase\Tests;

use TrezeVel\TrezeDatabase\AbstractRepository;
use TrezeVel\TrezeDatabase\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Mockery as m;

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

        Category::create([
                    'name' => 'name category',
                    'description' => 'description category'
                ]);

        echo Category::first()->name;
    }

    public function testIfImplementsRepositoryInterface()
    {
        $mock = m::mock(AbstractRepository::class);
        $this->assertInstanceOf(RepositoryInterface::class, $mock);
    }

    public function testShouldReturnAll()
    {
        $mockRepository = m::mock(AbstractRepository::class);
        $mockStd = m::mock(\stdClass::class);

        $mockStd->id = 1;
        $mockStd->name = 'name';
        $mockStd->description = 'description';

        $mockRepository
            ->shouldReceive('all')
            ->andReturn([$mockStd, $mockStd, $mockStd]);

        $result = $mockRepository->all();
        $this->assertCount(3, $result);
        $this->assertInstanceOf(\stdClass::class, $result[0]);
    }

    public function testShouldReturnAllWithArguments()
    {
        $mockRepository = m::mock(AbstractRepository::class);
        $mockStd = m::mock(\stdClass::class);

        $mockStd->id = 1;
        $mockStd->name = 'name';

        $mockRepository
            ->shouldReceive('all')
            ->with(['id', 'name'])
            ->andReturn([$mockStd, $mockStd, $mockStd]);

        $result = $mockRepository->all(['id', 'name']);
        $this->assertCount(3, $result);
        $this->assertInstanceOf(\stdClass::class, $result[0]);
    }

    public function testShouldReturnCreate()
    {
        $mockRepository = m::mock(AbstractRepository::class);
        $mockStd = m::mock(\stdClass::class);

        $mockStd->id = 1;
        $mockStd->name = 'name';

        $mockRepository
            ->shouldReceive('create')
            ->with(['name' => 'stdClassName'])
            ->andReturn($mockStd);

        $result = $mockRepository->create(['name' => 'stdClassName']);

        $this->assertEquals(1, $result->id);
        $this->assertInstanceOf(\stdClass::class, $result);
    }

    public function testShouldReturnUpdateSuccess()
    {
        $mockRepository = m::mock(AbstractRepository::class);
        $mockStd = m::mock(\stdClass::class);

        $mockStd->id = 1;
        $mockStd->name = 'name';

        $mockRepository
            ->shouldReceive('update')
            ->with(['name' => 'stdClassName'], 1)
            ->andReturn($mockStd);

        $result = $mockRepository->update(['name' => 'stdClassName'], 1);

        $this->assertEquals(1, $result->id);
        $this->assertInstanceOf(\stdClass::class, $result);
    }

    /**
     * @expectedException \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function testShouldUpdateFail()
    {
        $mockRepository = m::mock(AbstractRepository::class);
        $mockStd = m::mock(\stdClass::class);

        $throw = new ModelNotFoundException();
        $throw->setModel(\stdClass::class);

        $mockRepository
            ->shouldReceive('update')
            ->with(['name' => 'stdClassName'], 0)
            ->andThrow($throw);

        $mockRepository->update(['name' => 'stdClassName'], 0);
    }

    public function testShouldReturnDeleteSuccess()
    {
        $mockRepository = m::mock(AbstractRepository::class);

        $mockRepository
            ->shouldReceive('delete')
            ->with(1)
            ->andReturn(true);

        $result = $mockRepository->delete(1);

        $this->assertEquals(true, $result);
    }


    /**
     * @expectedException \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function testShouldDeleteFail()
    {
        $mockRepository = m::mock(AbstractRepository::class);

        $throw = new ModelNotFoundException();
        $throw->setModel(\stdClass::class);

        $mockRepository
            ->shouldReceive('delete')
            ->with(0)
            ->andThrow($throw);

        $mockRepository->delete(0);
    }

    public function testShouldReturnFindWithoutColumnsSuccess()
    {
        $mockRepository = m::mock(AbstractRepository::class);
        $mockStd = m::mock(\stdClass::class);

        $mockStd->id = 1;
        $mockStd->name = 'name';
        $mockStd->description = 'description';

        $mockRepository
            ->shouldReceive('find')
            ->with(1)
            ->andReturn($mockStd);

        $result = $mockRepository->find(1);

        $this->assertInstanceOf(\stdClass::class, $result);
    }

    public function testShouldReturnFindWithColumnsSuccess()
    {
        $mockRepository = m::mock(AbstractRepository::class);
        $mockStd = m::mock(\stdClass::class);

        $mockStd->id = 1;
        $mockStd->name = 'name';

        $mockRepository
            ->shouldReceive('find')
            ->with(1, ['id', 'name'])
            ->andReturn($mockStd);

        $result = $mockRepository->find(1, ['id', 'name']);

        $this->assertInstanceOf(\stdClass::class, $result);
    }

    /**
     * @expectedException \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function testShouldFindFail()
    {
        $mockRepository = m::mock(AbstractRepository::class);

        $throw = new ModelNotFoundException();
        $throw->setModel(\stdClass::class);

        $mockRepository
            ->shouldReceive('find')
            ->with(0)
            ->andThrow($throw);

        $mockRepository->find(0);
    }

    public function testShouldReturnFindByWithArgumentsSuccess()
    {
        $mockRepository = m::mock(AbstractRepository::class);
        $mockStd = m::mock(\stdClass::class);

        $mockStd->id = 1;
        $mockStd->name = 'name';

        $mockRepository
            ->shouldReceive('findBy')
            ->with('name', 'my-data', ['id', 'name'])
            ->andReturn([$mockStd, $mockStd, $mockStd]);

        $result = $mockRepository->findBy('name', 'my-data', ['id', 'name']);

        $this->assertCount(3, $result);
        $this->assertInstanceOf(\stdClass::class, $result[0]);
    }

    public function testShouldReturnFindByEmptySuccess()
    {
        $mockRepository = m::mock(AbstractRepository::class);

        $mockRepository
            ->shouldReceive('findBy')
            ->with('name', '', ['id', 'name'])
            ->andReturn([]);

        $result = $mockRepository->findBy('name', '', ['id', 'name']);

        $this->assertCount(0, $result);
    }
    
}
