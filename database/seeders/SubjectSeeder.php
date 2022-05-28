<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //Subject::factory()->count(5)->create();
           $subjects=[
               [ 'name'=>'Bangla', 'created_at' => now(), 'updated_at' => now()],
               [ 'name'=>'English', 'created_at' => now(),'updated_at' => now() ],
           ];
        Subject::insert($subjects);
    
    }
}
