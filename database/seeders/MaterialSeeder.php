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
                'content' => '<p>
PLA (ácido poliláctico) es uno de los materiales más populares y utilizados en impresión 3D FDM debido a su facilidad de uso, bajo costo y origen biodegradable.<br><br>

Derivado de recursos naturales como el almidón de maíz o la caña de azúcar, el PLA es una excelente opción para usuarios principiantes y para proyectos que no requieran alta resistencia mecánica o térmica.<br><br>

Su baja temperatura de fusión reduce el riesgo de warping, lo que lo hace ideal para impresoras sin cama caliente. Este comportamiento lo convierte en uno de los filamentos más accesibles y seguros para iniciarse en la impresión 3D doméstica o educativa.<br><br>

Aunque no es el material más resistente ni el más flexible, su excelente definición de detalles y su disponibilidad en una amplia gama de colores y acabados lo convierten en una elección ideal para prototipos visuales, piezas decorativas, modelos conceptuales, juguetes y todo tipo de aplicaciones no estructurales.<br><br>

Además, gracias a su base biológica, el filamento PLA tiene un menor impacto ambiental comparado con plásticos derivados del petróleo, aunque sigue siendo importante reciclarlo adecuadamente para minimizar su huella ecológica.
</p>',
                'image_url' => 'https://firebasestorage.googleapis.com/v0/b/pf25-alain-joel.firebasestorage.app/o/morfeo3d%2FMateriales%2FPLA.webp?alt=media&token=8ec893fa-c289-40a1-ba2a-88987fc596b0',
                'keywords' => json_encode(['pla', 'biodegradable', 'fácil de imprimir']),
                'order' => 1,
                'price' => 0.30,
            ],
            [
                'name' => 'PETG',
                'slug' => 'petg',
                'short_description' => 'Material resistente, flexible y fácil de imprimir, ideal para piezas funcionales, envases y componentes con exposición moderada al calor.',
                'content' => '<p>
PETG (tereftalato de polietileno glicol) combina las mejores propiedades del PLA y del ABS, ofreciendo resistencia mecánica, durabilidad, cierta flexibilidad y facilidad de impresión.<br><br>

Es un material ideal para piezas funcionales, especialmente aquellas que estarán sometidas a esfuerzos moderados, impactos o exposición a la humedad. PETG es resistente a productos químicos y a la intemperie, lo que lo convierte en una buena opción para aplicaciones en exteriores o en entornos industriales exigentes.<br><br>

Aunque es un poco más propenso al stringing que el PLA, una correcta configuración de retracción y temperatura puede minimizar este efecto y garantizar una calidad de impresión consistente.<br><br>

Es ampliamente utilizado para fabricar envases, componentes mecánicos, soportes estructurales, carcasas de electrónica y piezas que requieren cierta elasticidad sin llegar a deformarse fácilmente.<br><br>

Además, el filamento PETG es reciclable y más seguro para usos alimentarios, siempre que se imprima adecuadamente y se utilicen boquillas limpias y dedicadas exclusivamente para este propósito. Esto lo convierte en una opción versátil, funcional y confiable para usuarios intermedios y profesionales de la impresión 3D.
</p>',
                'image_url' => 'https://firebasestorage.googleapis.com/v0/b/pf25-alain-joel.firebasestorage.app/o/morfeo3d%2FMateriales%2FPETG.webp?alt=media&token=0123f128-407d-40fb-a261-27bea68a779f',
                'keywords' => json_encode(['petg', 'resistente', 'impacto']),
                'order' => 2,
                'price' => 0.35,

            ],
            [
                'name' => 'ABS',
                'slug' => 'abs',
                'short_description' => 'Plástico técnico con alta resistencia térmica y mecánica, ideal para piezas sometidas a estrés, impactos o temperaturas elevadas.',
                'content' => '<p>
ABS (acrilonitrilo butadieno estireno) es un filamento técnico de alto rendimiento ampliamente utilizado en impresión 3D por su excelente resistencia al impacto, durabilidad y estabilidad térmica.<br><br>

Este plástico es ideal para fabricar piezas resistentes que soporten altas temperaturas, esfuerzos mecánicos y uso continuo. El filamento ABS es especialmente valorado en sectores como la automoción, la ingeniería, la electrónica y la fabricación de prototipos industriales.<br><br>

En impresión 3D FDM, requiere una cama caliente y preferiblemente una impresora cerrada para evitar warping y garantizar una buena adhesión entre capas. Su superficie lisa se puede lijar, pintar o tratar con vapor de acetona para lograr un acabado brillante tipo inyectado.<br><br>

ABS es perfecto para imprimir engranajes, soportes estructurales, carcasas, piezas funcionales, modelos de validación y componentes sometidos a condiciones exigentes.<br><br>

Aunque no es biodegradable, su robustez lo convierte en uno de los materiales más confiables y versátiles para impresión 3D profesional. Si estás buscando un material resistente para impresión 3D, el ABS es una de las mejores opciones disponibles.
</p>
',      'image_url' => 'https://firebasestorage.googleapis.com/v0/b/pf25-alain-joel.firebasestorage.app/o/morfeo3d%2FMateriales%2FABS.webp?alt=media&token=a0b230d3-1b7e-46da-ab41-df540ec22bcb',
                'keywords' => json_encode(['abs', 'resistencia térmica', 'industria']),
                'order' => 3,
                'price' => 0.40,
            ],
            [
                'name' => 'Resina Tough',
                'slug' => 'resina-tough-resistente-3d',
                'short_description' => 'Resina Tough: alta resistencia al impacto, ideal para piezas duraderas en impresión 3D SLA/DLP/MSLA.',
                'content' => '<p>
La Resina Tough es un material avanzado para impresión 3D con tecnología SLA, DLP y MSLA, diseñado para ofrecer una mayor resistencia mecánica y reducir la fragilidad en comparación con las resinas estándar.<br><br>

Gracias a su composición optimizada, esta resina permite fabricar piezas duraderas, resistentes al impacto y con una excelente precisión de detalle, lo que la convierte en una opción ideal para la creación de prototipos funcionales, ensamblajes de prueba y piezas que requieren soportar estrés mecánico sin romperse.<br><br>

A diferencia de otras resinas más frágiles, la Tough conserva un equilibrio ideal entre rigidez y flexibilidad, permitiendo imprimir componentes que pueden doblarse levemente sin quebrarse, como clips, carcasas protectoras o piezas técnicas ajustables.<br><br>

Su excelente fidelidad dimensional y acabado superficial la hacen adecuada para sectores como la ingeniería, la robótica, el diseño de producto y la fabricación de piezas personalizadas. Además, tras un correcto postcurado UV, mejora aún más sus propiedades físicas, aumentando su durabilidad y resistencia general.<br><br>

Si buscás una resina resistente para impresión 3D profesional con alta calidad y versatilidad, la Resina Tough es una de las mejores elecciones del mercado actual.
</p>',
                'image_url' => 'https://firebasestorage.googleapis.com/v0/b/pf25-alain-joel.firebasestorage.app/o/morfeo3d%2FMateriales%2FRESINA-T.webp?alt=media&token=dc1a0660-cb30-48e0-80b1-78f1946abfe6',
                'keywords' => json_encode(['resina tough', 'resina resistente', 'sla', 'dlp', 'msla', 'impacto']),
                'order' => 4,
                'price' => 0.50,
            ]
        ]);
    }
}
