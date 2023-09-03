<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\GeneratorModel;

class license extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $license = new GeneratorModel();
        $license->wireclue = Str::random(4) . '-' . Str::random(4) . '-' . Str::random(4) . '-' . Str::random(4);
        $license->wirezone = 'sturdy.codebumble.net';
        $license->status = '1';
        $license->communication_key = "falcon";
        $license->software = "Sturdy";
        $license->generated_by = "saifur";
        $license->creation = "31-08-2023";
        $license->expiration = "31-08-2024";
        $license->created_at = now();
        $license->updated_at = now();
        $license->save();
    }
}
