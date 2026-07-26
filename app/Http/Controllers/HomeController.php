<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Home', [
            'stats' => [
                ['value' => '5+', 'label' => "ans d'expérience terrain"],
                ['value' => '50+', 'label' => 'utilisateurs assistés / jour'],
                ['value' => '400+', 'label' => 'postes en environnement call center'],
            ],

            'languages' => [
                ['flag' => '🇫🇷', 'label' => 'Français — courant'],
                ['flag' => '🇬🇧', 'label' => 'Anglais — professionnel'],
                ['flag' => '🇲🇱', 'label' => 'Bambara — langue maternelle'],
            ],

            'services' => [
                [
                    'num' => '01',
                    'title' => 'Support IT & Réseaux',
                    'tagline' => 'Pour que vos équipes ne soient jamais bloquées par un problème technique.',
                    'items' => [
                        "Diagnostic et résolution rapide d'incidents matériels/logiciels",
                        'Configuration et maintenance réseau (câblage, switches, routeurs)',
                        'Déploiement et suivi de postes de travail et périphériques',
                        'Administration Google Workspace & Microsoft 365',
                        "Rapports d'activité IT réguliers pour le management",
                    ],
                    'stack' => ['Réseaux', 'Google Workspace', 'M365', 'Ticketing'],
                    'dark' => true,
                ],
                [
                    'num' => '02',
                    'title' => 'Développement Web',
                    'tagline' => 'Pour transformer un besoin métier en outil ou site fonctionnel.',
                    'items' => [
                        'Applications API & full-stack avec Laravel',
                        'Interfaces modernes avec Vue.js et Inertia.js',
                        'Sites vitrines et outils métier sur mesure',
                        'Bases de données PostgreSQL, MySQL, SQL Server',
                        'Intégration Supabase / Firebase',
                    ],
                    'stack' => ['Laravel', 'Vue.js', 'Inertia.js', 'PostgreSQL'],
                    'dark' => false,
                ],
                [
                    'num' => '03',
                    'title' => 'Design Graphique & Cartes',
                    'tagline' => 'Des créations qui marquent les esprits — mariage, affaires, événements.',
                    'items' => [
                        'Cartes d\'invitation mariage, baptême, anniversaire — sur mesure, élégantes',
                        'Cartes de visite et professionnelles — papier premium ou format numérique',
                        'Flyers, affiches, supports printing pour commerces et associations',
                        'Identité visuelle complète : logo, charte, templates',
                        'Formation aux outils Canva & suite Adobe pour vos équipes',
                    ],
                    'stack' => ['Canva', 'Photoshop', 'Illustrator', 'Print'],
                    'dark' => true,
                ],
            ],

            'why' => [
                ['icon' => '🌍', 'title' => 'Communication sans friction', 'text' => 'Trilingue français / anglais / bambara — pour des clients locaux comme internationaux, sans intermédiaire.'],
                ['icon' => '⚡', 'title' => 'Habitué à la haute pression', 'text' => 'Formé dans un centre d\'appel de 400+ postes : je priorise vite et je ne laisse pas un incident traîner.'],
                ['icon' => '🗓️', 'title' => 'Disponibilité immédiate', 'text' => 'Horaires flexibles, y compris week-ends et jours fériés, selon les besoins du projet.'],
            ],

            'typingStrings' => ['Support IT & Réseaux', 'Développeur fullstack'],

            'skills' => [
                ['category' => 'Frontend', 'items' => ['HTML/CSS', 'JavaScript', 'Vue.js', 'Bootstrap']],
                ['category' => 'Backend', 'items' => ['PHP', 'Laravel', 'REST API']],
                ['category' => 'Base de données', 'items' => ['MySQL', 'PostgreSQL', 'SQL Server']],
                ['category' => 'Réseaux', 'items' => ['CCNA', 'Câblage', 'Switches', 'Routeurs']],
                ['category' => 'Infra', 'items' => ['G. Workspace', 'M365', 'Ticketing', 'Supabase']],
            ],

            'projects' => [
                [
                    'title' => 'SaaS Facturation & Stock',
                    'description' => 'Application web complète de facturation et gestion de stocks avec tableau de bord, génération de documents PDF, suivi des mouvements et multi-utilisateurs.',
                    'stack' => ['Laravel', 'Vue.js', 'MySQL', 'Inertia.js'],
                    'tag' => 'SaaS',
                ],
                [
                    'title' => 'Chat Interne d\'Entreprise',
                    'description' => 'Messagerie instantanée privée pour les équipes de Call Me Mali : fichiers, notifications, historique et administration des groupes.',
                    'stack' => ['Laravel', 'Vue.js', 'PostgreSQL', 'WebSockets'],
                    'tag' => 'Interne',
                ],
                [
                    'title' => 'Gestion du Parc Informatique',
                    'description' => 'Application web de suivi des équipements, affectations, maintenance préventive et reporting IT pour le département technique.',
                    'stack' => ['Laravel', 'Vue.js', 'MySQL', 'Bootstrap'],
                    'tag' => 'Interne',
                ],
            ],

            'projectStats' => [
                ['icon' => 'briefcase', 'value' => '10+', 'label' => 'Projets livrés'],
                ['icon' => 'users-alt', 'value' => '20+', 'label' => 'Clients satisfaits'],
                ['icon' => 'award', 'value' => '5+', 'label' => "Années d'expérience"],
            ],

            'socials' => [
                ['icon' => 'uil-instagram', 'url' => '#', 'label' => 'Instagram'],
                ['icon' => 'uil-github-alt', 'url' => '#', 'label' => 'GitHub'],
                ['icon' => 'uil-facebook-f', 'url' => '#', 'label' => 'Facebook'],
            ],

            'contact' => [
                'email' => 'sidibeousmanemohamed@gmail.com',
                'phone' => '+223 94 14 73 75',
                'phone_href' => '+22394147375',
                'location' => 'Kabala Est, Bamako, Mali',
            ],
        ]);
    }
}
