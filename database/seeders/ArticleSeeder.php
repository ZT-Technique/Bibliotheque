<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Theme;
use Illuminate\Database\Seeder;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $themes = Theme::all();
        
        if ($themes->count() === 0) {
            $this->command->error('Aucun thème trouvé. Veuillez d\'abord exécuter ThemeSeeder.');
            return;
        }

        $articles = [
            [
                'title' => 'Deep Learning pour la Classification d\'Images Médicales',
                'authors' => 'Marie Dupont, Jean Martin, Sophie Bernard',
                'year' => 2024,
                'theme_id' => $themes->where('name', 'Intelligence Artificielle')->first()->id ?? 1,
                'abstract' => 'Cette étude présente une approche innovante utilisant les réseaux de neurones convolutifs pour la classification automatique d\'images médicales. Les résultats montrent une précision de 95% sur un ensemble de données de radiographies pulmonaires.',
                'keywords' => 'deep learning, CNN, imagerie médicale, classification, intelligence artificielle',
            ],
            [
                'title' => 'Énergies Renouvelables et Transition Écologique en Afrique',
                'authors' => 'Ahmed Hassan, Fatima Ndiaye',
                'year' => 2023,
                'theme_id' => $themes->where('name', 'Développement Durable')->first()->id ?? 2,
                'abstract' => 'Analyse des politiques énergétiques en Afrique subsaharienne et leur impact sur la transition vers les énergies renouvelables. L\'étude couvre 15 pays sur une période de 10 ans.',
                'keywords' => 'énergies renouvelables, Afrique, développement durable, transition énergétique',
            ],
            [
                'title' => 'Blockchain et Sécurité des Transactions Financières',
                'authors' => 'Pierre Leclerc, Anna Kowalski',
                'year' => 2024,
                'theme_id' => $themes->where('name', 'Cybersécurité')->first()->id ?? 3,
                'abstract' => 'Étude comparative des protocoles de sécurité blockchain dans le secteur financier. Analyse des vulnérabilités et propositions d\'améliorations pour les systèmes de paiement décentralisés.',
                'keywords' => 'blockchain, cybersécurité, cryptographie, finance, transactions',
            ],
            [
                'title' => 'Génomique et Médecine Personnalisée',
                'authors' => 'Dr. Sarah Johnson, Prof. Michael Chen',
                'year' => 2023,
                'theme_id' => $themes->where('name', 'Biotechnologie')->first()->id ?? 4,
                'abstract' => 'Exploration des applications de la génomique dans le développement de traitements personnalisés pour les maladies chroniques. Focus sur le cancer et les maladies cardiovasculaires.',
                'keywords' => 'génomique, médecine personnalisée, biotechnologie, cancer, ADN',
            ],
            [
                'title' => 'Changement Climatique et Biodiversité Marine',
                'authors' => 'Elena Rodriguez, Thomas Müller',
                'year' => 2024,
                'theme_id' => $themes->where('name', 'Écologie')->first()->id ?? 5,
                'abstract' => 'Impact du réchauffement climatique sur les écosystèmes marins et la biodiversité. Étude longitudinale sur 20 ans dans les océans Atlantique et Pacifique.',
                'keywords' => 'changement climatique, biodiversité, océans, écologie marine, réchauffement',
            ],
        ];

        foreach ($articles as $articleData) {
            // Create a simple colored image as cover
            $manager = new ImageManager(new Driver());
            $colors = ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b'];
            $color = $colors[array_rand($colors)];
            
            $image = $manager->create(800, 1200)->fill($color);
            
            // Add text to image (title)
            $coverName = time() . '_' . uniqid() . '.jpg';
            $coverPath = base_path('uploads/covers/' . $coverName);
            $image->save($coverPath);
            
            // Create a dummy PDF
            $pdfName = time() . '_' . uniqid() . '.pdf';
            $pdfPath = base_path('uploads/pdfs/' . $pdfName);
            file_put_contents($pdfPath, "%PDF-1.4\n1 0 obj\n<< /Type /Catalog /Pages 2 0 R >>\nendobj\n2 0 obj\n<< /Type /Pages /Kids [3 0 R] /Count 1 >>\nendobj\n3 0 obj\n<< /Type /Page /Parent 2 0 R /Resources << /Font << /F1 << /Type /Font /Subtype /Type1 /BaseFont /Helvetica >> >> >> /MediaBox [0 0 612 792] /Contents 4 0 R >>\nendobj\n4 0 obj\n<< /Length 44 >>\nstream\nBT /F1 24 Tf 100 700 Td ({$articleData['title']}) Tj ET\nendstream\nendobj\nxref\n0 5\n0000000000 65535 f\n0000000009 00000 n\n0000000058 00000 n\n0000000115 00000 n\n0000000317 00000 n\ntrailer\n<< /Size 5 /Root 1 0 R >>\nstartxref\n410\n%%EOF");
            
            Article::create([
                'title' => $articleData['title'],
                'authors' => $articleData['authors'],
                'year' => $articleData['year'],
                'theme_id' => $articleData['theme_id'],
                'abstract' => $articleData['abstract'],
                'keywords' => $articleData['keywords'],
                'pdf_path' => 'uploads/pdfs/' . $pdfName,
                'cover_image' => 'uploads/covers/' . $coverName,
            ]);
            
            // Small delay to ensure unique filenames
            usleep(100000); // 0.1 second
        }

        $this->command->info('5 articles de test créés avec succès!');
    }
}
