<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\OperatorWork;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OperatorWork>
 */
class OperatorWorkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = OperatorWork::class;

    public function definition(): array
    {
        $mesin_id = [
            'LYK01',
            'LYK10',
            'LYK206',
            'LYK11',
            'LYK05',
            'LYK200'
        ];

        $site_kode = [
            'R001',
            'R002',
            'R003',
            'R004',
            'R005',
            'R006',
            'R007',
            'R008',
            'R009'
        ];

        $tasks = [
            'A1',
            'A2',
            'A3',
            'A4',
            'A5',
            'A6',
            'A7',
            'A8',
            'A9',
            'A10'
        ];

        $oum = ['Pokok','Meter'];
        
        return [
            'submitted_by'=>$this->faker->name(),
            'submitted_when'=>$this->faker->dateTimeBetween('2024-01-01',date('Y-m-d'))->format('Y-m-d'),
            'site_code'=>$site_kode[array_rand($site_kode)],
            'activity'=>$this->faker->realText($maxNbChars = 20, $indexSize = 2),
            'uom'=>$oum[array_rand($oum)],
            'block'=>$this->faker->buildingNumber(),
            'task'=>$tasks[array_rand($tasks)],
            'start'=>$this->faker->dateTimeBetween('2024-01-01',date('Y-m-d'))->format('Y-m-d'),
            'end'=>$this->faker->dateTimeBetween('2024-01-01',date('Y-m-d'))->format('Y-m-d'),
            'mesin_id'=>$mesin_id[array_rand($mesin_id)],
            'fuel'=>$this->faker->buildingNumber(),
            'check_by'=>null,
            'check_when'=>null,
            'verified_by'=>null,
            'verified_when'=>null,
            'duty'=>'On Duty',
            'reason'=>null
        ];
    }
}
