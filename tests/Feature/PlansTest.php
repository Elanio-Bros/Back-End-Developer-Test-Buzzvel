<?php

namespace Tests\Feature;

use App\Models\Plans;
use App\Models\User_Auth;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class PlansTest extends TestCase
{
    public function test_create_plan(): void
    {
        $user = User_Auth::first();
        $response = $this->withHeader('Authorization', 'Bearer ' . Auth::tokenById($user->id))->post('/api/plans', [
            'title' => 'Holiday on Plans 1',
            'description' => "This first plan talks about how I'm going to get to where I'm going and come back later.",
            'date' => '2024-12-08', 'location' => 'Waterpark', 'participants' => array('Ana', 'Maria')
        ]);

        $response->assertStatus(201);
    }

    public function test_list_plans(): void
    {
        $user = User_Auth::first();
        $response = $this->withHeader('Authorization', 'Bearer ' . Auth::tokenById($user->id))->getJson('/api/plans');

        $response->assertStatus(200)->assertJsonStructure(['plans', 'count']);
    }

    public function test_list_plans_paginate(): void
    {
        $user = User_Auth::first();
        $response = $this->withHeader('Authorization', 'Bearer ' . Auth::tokenById($user->id))->get('/api/plans?' . http_build_query(['paginate' => true, 'page' => 1]));
        $response->assertStatus(200)->assertJsonStructure(['data', 'per_page', 'total']);
    }

    public function test_get_plan(): void
    {
        $user_id = User_Auth::first()['id'];
        $plan_id = Plans::first()['id'];
        $response = $this->withHeader('Authorization', 'Bearer ' . Auth::tokenById($user_id))->get("/api/plans/{$plan_id}");
        $response->assertStatus(200);
    }

    public function test_get_document_plan(): void
    {
        $user_id = User_Auth::first()['id'];
        $plan_id = Plans::first()['id'];
        $response = $this->withHeader('Authorization', 'Bearer ' . Auth::tokenById($user_id))->get("/api/plans/{$plan_id}");
        $response->assertStatus(200);
    }

    public function test_update_plan(): void
    {
        $user_id = User_Auth::first()['id'];
        $plan_id = Plans::first()['id'];
        $response = $this->withHeader('Authorization', 'Bearer ' . Auth::tokenById($user_id))->put("/api/plans/{$plan_id}", [
            'title' => 'Holiday on Plans 2',
            'date' => '2024-12-18', 'participants' => array('Pedro', 'Bros')
        ]);

        $response->assertStatus(200)->assertJsonStructure(['plan']);
    }

    public function test_delete_plan(): void
    {
        $user_id = User_Auth::first()['id'];
        $plan_id = Plans::first()['id'];
        $response = $this->withHeader('Authorization', 'Bearer ' . Auth::tokenById($user_id))->delete("/api/plans/{$plan_id}");
        $response->assertStatus(200);
    }
}
