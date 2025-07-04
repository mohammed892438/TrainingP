<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            CountrySeeder::class,
            ProvidedServiceSeeder::class,
            SectorSeeder::class,
            FieldOfWorkSeeder::class,
            EducationLevelSeeder::class,
            AnnualBudgetSeeder::class,
            EmployeeNumberSeeder::class,
            LanguagestableSeeder::class,
            ExperienceAreaSeeder::class,
            UserTypeSeeder::class,
            OrganizationTypesTableSeeder::class,
            OrganizationSectorsTableSeeder::class,
            programTypeSeeder::class,
            TrainingClassificationSeeder::class,
            trainingLevelSeeder::class,
            programPresentationMethodSeeder::class
        ]);

    }
}
