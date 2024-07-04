<?php


it('Mgr can Login', function (){
    $user =createUser('mgr');
    $response = \Pest\Laravel\postJson(route('api.mgr.auth.'),[
        'email'=>$user->email,
        'password'=>'password'
    ]);
    $response->assertSessionDoesntHaveErrors()
        ->assertOk()
        ->assertJsonStructure([
            'token',
            'message',
            'status'
        ]);
});

it('Mgr can List Positions', function (){
    $user =createUser('mgr');
    \Pest\Laravel\actingAs($user);
    $response = \Pest\Laravel\getJson(route('api.mgr.positions.list'));
    $response->assertSessionDoesntHaveErrors()
        ->assertOk()
        ->assertJsonStructure([
            'data' => [
                '*'=>[
                    'id',
                    'title',
                    'body',
                    'user_id',
                    'created_at',
                    'updated_at',
                ]
            ],
            'message',
            'status'
        ]);
});

it('Mgr can show Positions', function (){
    $user =createUser('mgr');
    \Pest\Laravel\actingAs($user);
    $position = \App\Models\Position::first();
    $response = \Pest\Laravel\get("api/mgr/positions/{$position->id}");
    $response->assertSessionDoesntHaveErrors()
        ->assertOk()
        ->assertJsonStructure([
            'data' => [
                'id',
                'title',
                'body',
                'user_id',
                'created_at',
                'updated_at',
            ],
            'message',
            'status'
        ]);
});
