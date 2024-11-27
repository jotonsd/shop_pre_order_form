<?php

namespace Tests\Unit;

use Mockery;
use PHPUnit\Framework\TestCase;
use Joton\PreOrder\Models\PreOrder;
use Joton\PreOrder\Repositories\PreOrderRepository;

class PreOrderRepositoryTest extends TestCase
{
    /**
     * Cleanup Mockery resources after each test.
     */
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    /**
     * Test the `getAll` method in the repository.
     * It verifies if the method fetches paginated results with details.
     */
    public function test_get_all_pre_orders_returns_paginated_results()
    {
        $mockPreOrder = Mockery::mock(PreOrder::class);
        $mockPreOrder->shouldReceive('with')
            ->with('details')
            ->andReturnSelf()
            ->once();

        $mockPreOrder->shouldReceive('orderBy')
            ->with('id', 'desc')
            ->andReturnSelf()
            ->once();

        $mockPreOrder->shouldReceive('paginate')
            ->with(10)
            ->andReturn((object)['data' => [], 'total' => 0])
            ->once();

        $repository = new PreOrderRepository($mockPreOrder);
        $result = $repository->getAll();

        $this->assertIsObject($result);
        $this->assertEquals(0, $result->total);
    }

    /**
     * Test the `getById` method in the repository.
     * It verifies if the method fetches the correct PreOrder by ID.
     */
    public function test_get_by_id_returns_correct_pre_order()
    {
        $id = 1;

        $mockPreOrder = Mockery::mock(PreOrder::class);
        $mockPreOrder->shouldReceive('with')
            ->with('details')
            ->andReturnSelf()
            ->once();

        $mockPreOrder->shouldReceive('findOrFail')
            ->with($id)
            ->andReturn((object)['id' => $id, 'name' => 'Joton'])
            ->once();

        $repository = new PreOrderRepository($mockPreOrder);
        $result = $repository->getById($id);

        $this->assertIsObject($result);
    }
}
