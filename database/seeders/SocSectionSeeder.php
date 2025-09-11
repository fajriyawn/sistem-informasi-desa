<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SocSection; // Direkomendasikan untuk import model

class SocSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = [
            [
                'key' => 'status-lingkungan-pesisir',
                'title' => 'Status Lingkungan Pesisir',
            ],
            [
                'key' => 'diagram-radar-tata-kelola',
                'title' => 'Diagram Radar Tata Kelola',
            ],
            [
                'key' => 'diagram-radar-pembangunan',
                'title' => 'Diagram Radar Pembangunan',
            ],
            [
                'key' => 'matriks-penilaian',
                'title' => 'Matriks Penilaian',
            ],
        ];

        foreach ($sections as $section) {
            SocSection::updateOrCreate(
                ['key' => $section['key']], 
                [
                    'title' => $section['title'],
                    'image_path' => null,
                ]
            );
        }
    }
}

