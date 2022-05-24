<?php

namespace Database\Seeders;

use App\Enums\PostTypes;
use App\Models\PostType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class PostTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $postTypes = PostTypes::cases();

        foreach ($postTypes as $postType) {
            try {
                PostType::query()->create([
                    'name' => $postType,
                ]);
            }catch (\Exception $e) {
                Log::error($e->getMessage());
            }
        }
    }
}
