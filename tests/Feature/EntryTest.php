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
        /** @var User $user */
        $user = User::factory()->create();
        /** @var Entry $entry */
        $entry = Entry::factory()->create();
        $entry->user_id = $user->id;
        $entry->save();

        $postData = [
            'label' => 'My Label',
            'value' => '204.50',
            'date' => '2020-09-04'
        ];

        $response = $this->actingAs($user)->putJson('/api/entries/' . $entry->id, $postData);
        $response->assertStatus(200);
        $data = json_decode($response->getContent(), true);
        $this->assertEquals('My Label', $data['label']);
        $this->assertEquals('204.50', $data['value']);
        $carbonDate = new Carbon($data['date']);
        $this->assertEquals('2020-09-04', $carbonDate->format('Y-m-d'));

        $this->assertDatabaseHas('entries', ['id' => $data['id']]);
    }

    public function testUpdateWithBadRequest()
    {
        /** @var User $user */
        $user = User::factory()->create();
        /** @var Entry $entry */
        $entry = Entry::factory()->create();
        $entry->user_id = $user->id;
        $entry->save();

        $postData = [
            'foo' => 'bar',
        ];

        $response = $this->actingAs($user)->putJson('/api/entries/' . $entry->id, $postData);

        $response->assertStatus(422);
    }

    public function testUpdateWithBadId()
    {
        /** @var User $user */
        $user = User::factory()->create();
        $nonExistentEntryId = 999;

        $postData = [
            'label' => 'My Label',
            'value' => '204.50',
            'date' => '2020-09-04'
        ];

        $response = $this->actingAs($user)->putJson('/api/entries/' . $nonExistentEntryId, $postData);

        $response->assertStatus(404);
    }

    public function testUpdateWithIdForAnotherUser()
    {
        /** @var User $firstUser */
        $firstUser = User::factory()->create();
        /** @var User $secondUser */
        $secondUser = User::factory()->create();
        /** @var Entry $entry */
        $entry = Entry::factory()->create();
        $entry->user_id = $firstUser->id;
        $entry->save();

        $postData = [
            'label' => 'My Label',
            'value' => '204.50',
            'date' => '2020-09-04'
        ];

        $response = $this->actingAs($secondUser)->putJson('/api/entries/' . $entry->id, $postData);

        $response->assertStatus(404);
    }

    public function testDestroy()
    {
        /** @var User $user */
        $user = User::factory()->create();
        /** @var Entry $entry */
        $entry = Entry::factory()->create();
        $entry->user_id = $user->id;
        $entry->save();

        $response = $this->actingAs($user)->deleteJson('/api/entries/' . $entry->id);

        $response->assertStatus(204);
        $this->assertDatabaseMissing('entries', ['id' => $entry->id]);
    }

    public function testDestroyWithBadId()
    {
        /** @var User $user */
        $user = User::factory()->create();
        $nonExistentEntryId = 999;

        $response = $this->actingAs($user)->deleteJson('/api/entries/' . $nonExistentEntryId);

        $response->assertStatus(404);
    }

    public function testDestroyWithIdForAnotherUser()
    {
        /** @var User $firstUser */
        $firstUser = User::factory()->create();
        /** @var User $secondUser */
        $secondUser = User::factory()->create();
        /** @var Entry $entry */
        $entry = Entry::factory()->create();
        $entry->user_id = $firstUser->id;
        $entry->save();

        $response = $this->actingAs($secondUser)->deleteJson('/api/entries/' . $entry->id);
        $response->assertStatus(404);
    }
}
