<?php

namespace Database\Factories;

use App\Models\PostModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class PostModelFactory extends Factory
{
    protected $model = PostModel::class;

    public function definition(): array
    {
    	return [
            'post_title'=>$this->faker->name,
            'post_body'=>$this->faker->sentence,
    	];
    }
}