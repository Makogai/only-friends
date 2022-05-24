<?php

namespace Database\Seeders;

use App\Enums\UserStatuses;
use App\Models\UserStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class UserStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userStatuses = UserStatuses::cases();

        foreach ($userStatuses as $status) {
            try {
                UserStatus::query()->create([
                    'name' => $status,
                ]);
            }catch (\Exception $e) {
                Log::error($e->getMessage());
            }
        }
    }
}
