<?php


it('Reg can Login', function (){
    $user =createUser('reg');
    $response = \Pest\Laravel\postJson(route('api.reg.auth.'),[
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


it('reg can List Positions', function (){
    $user =createUser('regular');
    \Pest\Laravel\actingAs($user);
    $response = \Pest\Laravel\getJson(route('api.reg.positions.list'));
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

it('Reg can show Positions', function (){
    $user =createUser('regular');
    $position = $user->positions()->create([
        'title'=>'job',
        'body'=>'job description'
    ]);
    \Pest\Laravel\actingAs($user);
    $response = \Pest\Laravel\get("api/reg/positions/{$position->id}");
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

it('Reg can store Positions', function (){
    $user =createUser('regular');
    \Pest\Laravel\actingAs($user);
    $response = \Pest\Laravel\postJson(route('api.reg.positions.store'),[
        'title'=>'job',
        'body'=>'job description'
    ]);
    $response->assertSessionDoesntHaveErrors()
        ->assertCreated()
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

it('Reg can update Positions', function (){
    $user =createUser('regular');
    \Pest\Laravel\actingAs($user);
    $position = $user->positions()->create([
        'title'=>'job',
        'body'=>'job description'
    ]);
    $response = \Pest\Laravel\put("api/reg/positions/{$position->id}" , [
        'title'=>'new job',
        'body'=>'new job description'
    ]);
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

it('Reg can delete Positions', function (){
    $user =createUser('regular');
    \Pest\Laravel\actingAs($user);
    $position = $user->positions()->create([
        'title'=>'job',
        'body'=>'job description'
    ]);
    $response = \Pest\Laravel\delete("api/reg/positions/{$position->id}" );
    $response->assertSessionDoesntHaveErrors()
        ->assertOk()
        ->assertJsonStructure([
            'message',
            'status'
        ]);
});
