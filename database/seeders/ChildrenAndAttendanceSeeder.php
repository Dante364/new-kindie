<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Children as Child;
use App\Models\Attendance;
use Carbon\Carbon;

class ChildrenAndAttendanceSeeder extends Seeder
{
    public function run()
    {
        // Create sample children
        $children = Child::insert([
            ['name' => 'Alice', 'age' => 7, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Bob', 'age' => 8, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Charlie', 'age' => 9, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);

        // Fetch the IDs of the inserted children
        $childIds = Child::pluck('id');

        // Create attendance records for each child
        foreach ($childIds as $childId) {
            Attendance::insert([
                ['child_id' => $childId, 'date' => Carbon::yesterday(), 'status' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['child_id' => $childId, 'date' => Carbon::today(), 'status' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ]);
        }
    }
}