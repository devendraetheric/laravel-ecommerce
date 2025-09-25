<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;


uses(RefreshDatabase::class);

test('can list users', function () {

    $users = User::factory()->count(3)->create();

    $response = $this->get(route('admin.users.index'));

    $response->assertOk();

    foreach ($users as $user) {
        $response->assertSee($user->first_name);
        $response->assertSee($user->email);
    }
});
