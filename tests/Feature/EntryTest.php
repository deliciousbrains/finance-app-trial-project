<?php

namespace Tests\Feature;

use App\Models\Entry;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class EntryTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    public function testIndex()
    {
        /** @var User $firstUser */
        $firstUser = User::factory()->create();
        /** @var User $secondUser */
        $secondUser = User::factory()->create();
        /** @var Entry $firstEntry */
        $firstEntry = Entry::factory()->create();
        $firstEntry->user_id = $firstUser->id;
        $firstEntry->save();
        /** @var Entry $secondEntry */
        $secondEntry = Entry::factory()->create();
        $secondEntry->user_id = $secondUser->id;
        $secondEntry->save();
        /** @var Entry $thirdEntry */
        $thirdEntry = Entry::factory()->create();
        $thirdEntry->user_id = $firstUser->id;
        $thirdEntry->save();

        $response = $this->actingAs($firstUser)->getJson('/api/entries');

        $response->assertStatus(200);
        $data = json_decode($response->getContent(), true);
        $this->assertEquals(2, sizeof($data));
        $this->assertEquals($firstEntry->id, $data[0]['id']);
        $this->assertEquals($thirdEntry->id, $data[1]['id']);
    }

    public function testStore()
    {
        /** @var User $user */
        $user = User::factory()->create();

        $postData = [
            'label' => 'My Label',
            'value' => '204.50',
        ];

        $response = $this->actingAs($user)->postJson('/api/entries', $postData);

        $response->assertStatus(200);
        $data = json_decode($response->getContent(), true);
        $this->assertEquals('My Label', $data['label']);
        $this->assertEquals('204.50', $data['value']);
        $carbonDate = new Carbon($data['date']);
        $this->assertEquals(Carbon::now()->format('Y-m-d'), $carbonDate->format('Y-m-d'));
        $this->assertEquals($user->id, $data['user_id']);

        $this->assertDatabaseHas('entries', ['id' => $data['id']]);
    }

    public function testStoreWithBadRequest()
    {
        /** @var User $user */
        $user = User::factory()->create();

        $postData = [
            'foo' => 'bar',
        ];

        $response = $this->actingAs($user)->postJson('/api/entries', $postData);

        $response->assertStatus(422);
    }

    public function testUpdate()
    {

    }

    public function testUpdateWithBadRequest()
    {

    }

    public function testUpdateWithBadId()
    {

    }

    public function testUpdateWithIdForAnotherUser()
    {

    }

    public function testDestroy()
    {

    }

    public function testDestroyWithBadId()
    {

    }

    public function testDestroyWithIdForAnotherUser()
    {

    }
}
