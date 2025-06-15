<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Material::insert([
            [
                'name' => 'PLA',
                'slug' => 'pla',
                'short_description' => 'Material biodegradable y fácil de imprimir, ideal para prototipos detallados, piezas decorativas y proyectos educativos.',
                'content' => '<p>PLA (ácido poliláctico) es un material fácil de imprimir, ecológico y perfecto para prototipos visuales o piezas decorativas.</p>',
                'image_url' => 'https://firebasestorage.googleapis.com/v0/b/pf25-alain-joel.firebasestorage.app/o/morfeo3d%2FMateriales%2FPLA.webp?alt=media&token=8ec893fa-c289-40a1-ba2a-88987fc596b0',
                'keywords' => json_encode(['pla', 'biodegradable', 'fácil de imprimir']),
                'order' => 1,
            ],
            [
                'name' => 'PETG',
                'slug' => 'petg',
                'short_description' => 'Material resistente, flexible y fácil de imprimir, ideal para piezas funcionales, envases y componentes con exposición moderada al calor.',
                'content' => '<p>PETG es ideal para piezas funcionales, con buena resistencia al impacto y algo de flexibilidad.</p>',
                'image_url' => 'https://firebasestorage.googleapis.com/v0/b/pf25-alain-joel.firebasestorage.app/o/morfeo3d%2FMateriales%2FPETG.webp?alt=media&token=0123f128-407d-40fb-a261-27bea68a779f',
                'keywords' => json_encode(['petg', 'resistente', 'impacto']),
                'order' => 2,
            ],
            [
                'name' => 'ABS',
                'slug' => 'abs',
                'short_description' => 'Plástico técnico con alta resistencia térmica y mecánica, ideal para piezas sometidas a estrés, impactos o temperaturas elevadas.',
                'content' => '<p>ABS es un termoplástico muy duradero, ideal para aplicaciones industriales o mecánicas.</p>',
                'image_url' => 'https://firebasestorage.googleapis.com/v0/b/pf25-alain-joel.firebasestorage.app/o/morfeo3d%2FMateriales%2FABS.webp?alt=media&token=a0b230d3-1b7e-46da-ab41-df540ec22bcb',
                'keywords' => json_encode(['abs', 'resistencia térmica', 'industria']),
                'order' => 3,
            ],
            [
                'name' => 'Resina Tough',
                'slug' => 'resina-tough-resistente-3d',
                'short_description' => 'Resina Tough: alta resistencia al impacto, ideal para piezas duraderas en impresión 3D SLA/DLP/MSLA.',
                'content' => '<p>La Resina Tough es un material avanzado diseñado para ofrecer mayor resistencia mecánica y menor fragilidad en comparación con las resinas estándar utilizadas en la impresión 3D SLA, DLP y MSLA. Gracias a su composición optimizada, esta resina permite fabricar piezas duraderas y resistentes al impacto, manteniendo una excelente precisión y detalle en la impresión.</p>',
                'image_url' => 'https://firebasestorage.googleapis.com/v0/b/pf25-alain-joel.firebasestorage.app/o/morfeo3d%2FMateriales%2FRESINA-T.webp?alt=media&token=dc1a0660-cb30-48e0-80b1-78f1946abfe6',
                'keywords' => json_encode(['resina tough', 'resina resistente', 'sla', 'dlp', 'msla', 'impacto']),
                'order' => 4,
            ]
        ]);
    }
}
