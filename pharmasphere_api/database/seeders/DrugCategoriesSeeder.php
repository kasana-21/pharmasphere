<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class DrugCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    DB::table('drug_categories')->insert([
        ['name' => 'Painkiller'],
        ['name' => 'Antibiotics'],
        ['name' => 'Antidepressant'],
        ['name' => 'Antihistamine'],
        ['name' => 'Antiviral'],
        ['name' => 'Antifungal'],
        ['name' => 'Antibacterial'],
        ['name' => 'Anticonvulsant'],
        ['name' => 'Antiemetic'],
        ['name' => 'Antidiarrheal'],
        ['name' => 'Antiseptic'],
        ['name' => 'Antitussive'],
        ['name' => 'Bronchodilator'],
        ['name' => 'Decongestant'],
        ['name' => 'Diuretic'],
        ['name' => 'Expectorant'],
        ['name' => 'Laxative'],
        ['name' => 'Muscle Relaxant'],
        ['name' => 'Stimulant'],
        ['name' => 'Vasodilator'],
        ['name' => 'Vasoconstrictor'],
        ['name' => 'Vitamin'],
        ['name' => 'Antacid'],
        ['name' => 'Antianxiety'],
        ['name' => 'Anticoagulant'],
        ['name' => 'Anticonvulsant'],
        ['name' => 'Antidiabetic'],
        ['name' => 'Antiemetic'],
        ['name' => 'Antifungal'],
        ['name' => 'Antihistamine'],
        ['name' => 'Antihypertensive'],
        ['name' => 'Anti-inflammatory'],
        ['name' => 'Antimanic'],
        ['name' => 'Antimigraine'],
        ['name' => 'Antineoplastic'],
        ['name' => 'Antipsychotic'],
        ['name' => 'Antipyretic'],
        ['name' => 'Antirheumatic'],
        ['name' => 'Antispasmodic'],
        ['name' => 'Antitussive'],
        ['name' => 'Bronchodilator'],
        ['name' => 'Decongestant'],
        ['name' => 'Diuretic'],
        ['name' => 'Expectorant'],
        ['name' => 'Laxative'],
        ['name' => 'Muscle Relaxant'],
        ['name' => 'Stimulant'],
        ['name' => 'Vasodilator'],
        ['name' => 'Vasoconstrictor'],    
        // Add more categories as needed
    ]);
}
}
