<?php

namespace Tests\Feature\LogInventory;

use App\Models\LogInventory;
use Illuminate\Http\Response;
use Tests\TestCase;

class LogInventoryEndpointsTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function logs_count()
    {
        LogInventory::truncate();

        LogInventory::factory()->create([
            'service_name' => 'order-service',
            'log_time' => 1663410113,
            'verb' => 'POST',
            'url' => '/orders',
            'protocol' => 'HTTP/1.1',
            'status' => 201]
        );
        $response = $this->get(route('logs.count', ['serviceNames[]' => 'order-service', 'statusCode' => 201]));
        $responseData = json_decode($response->getContent(), true);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure(['count']);
        $this->assertEquals(1, $responseData[ 'count' ]);

        $response = $this->get(route('logs.count', ['serviceNames[]' => 'invoice-service', 'statusCode' => 201]));
        $responseData = json_decode($response->getContent(), true);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure(['count']);
        $this->assertEquals(0, $responseData[ 'count' ]);
    }
}
