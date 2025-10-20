<?php

namespace App\DataFixtures\Feedbacks;

/**
 * Templates de feedbacks réalistes pour chaque dimension RIASEC
 * À utiliser dans FeedbacksFixtures pour générer des feedbacks cohérents
 */
class FeedbackTemplates
{
    public const FEEDBACKS = [
        'R' => [ // Réaliste
            [
                'title' => 'Profil Réaliste dominant',
                'content' => "Votre profil révèle une forte orientation vers les métiers concrets et pratiques. Vous appréciez le travail manuel, les activités physiques et les tâches qui produisent des résultats tangibles. Les métiers techniques, l'artisanat, la mécanique ou encore l'agriculture pourraient vous convenir. Vous préférez les environnements structurés où les objectifs sont clairs et mesurables.",
                'recommendations' => ['Ingénieur', 'Électricien', 'Mécanicien', 'Architecte', 'Agriculteur']
            ],
            [
                'title' => 'Orientation technique affirmée',
                'content' => "Vos résultats indiquent une préférence pour le travail avec des outils, des machines et des objets concrets. Vous êtes attiré par les défis techniques et les problèmes nécessitant des solutions pratiques. Les domaines comme le BTP, l'industrie, la maintenance ou les métiers de la nature correspondent à votre profil. Vous excellez dans les tâches qui demandent précision et habileté manuelle.",
                'recommendations' => ['Technicien', 'Plombier', 'Pilote', 'Chef de chantier', 'Horticulteur']
            ],
            [
                'title' => 'Compétences pratiques valorisées',
                'content' => "Vous manifestez un intérêt marqué pour les activités concrètes et les résultats visibles. Les métiers nécessitant des compétences techniques et manuelles sont particulièrement adaptés à votre profil. Vous appréciez le travail autonome, les environnements extérieurs et les projets qui allient théorie et pratique. L'artisanat, l'industrie ou les métiers de l'environnement pourraient vous épanouir.",
                'recommendations' => ['Menuisier', 'Soudeur', 'Géomètre', 'Forestier', 'Conducteur de travaux']
            ],
            [
                'title' => 'Aptitude technique naturelle',
                'content' => "Votre profil suggère une aisance avec les équipements techniques et les processus concrets. Vous préférez les activités où vous pouvez voir directement le fruit de votre travail. Les métiers de terrain, l'industrie manufacturière ou les technologies appliquées correspondent à vos aspirations. Vous valorisez l'efficacité, la qualité et les standards professionnels élevés.",
                'recommendations' => ['Technicien de maintenance', 'Opérateur CNC', 'Contrôleur qualité', 'Automaticien', 'Frigoriste']
            ]
        ],
        'I' => [ // Investigateur
            [
                'title' => 'Profil Investigateur prononcé',
                'content' => "Vos résultats révèlent une forte curiosité intellectuelle et un goût prononcé pour l'analyse et la recherche. Vous excellez dans la résolution de problèmes complexes et appréciez les environnements qui stimulent votre réflexion. Les carrières scientifiques, la recherche, l'analyse de données ou la médecine correspondent parfaitement à votre profil. Vous aimez comprendre le 'pourquoi' des choses et explorer de nouvelles idées.",
                'recommendations' => ['Chercheur', 'Data Scientist', 'Médecin', 'Biologiste', 'Statisticien']
            ],
            [
                'title' => 'Esprit analytique développé',
                'content' => "Votre profil indique une préférence pour le travail intellectuel et l'investigation approfondie. Vous êtes attiré par les défis analytiques et les questions qui nécessitent rigueur et méthodologie. Les domaines comme la science, la technologie, l'ingénierie ou la recherche médicale sont en adéquation avec vos compétences. Vous valorisez la précision, la logique et l'approche systématique.",
                'recommendations' => ['Ingénieur R&D', 'Pharmacien', 'Analyste', 'Chimiste', 'Astrophysicien']
            ],
            [
                'title' => 'Orientation recherche et analyse',
                'content' => "Vos résultats soulignent votre intérêt pour l'observation, l'expérimentation et la découverte de nouvelles connaissances. Vous êtes méthodique, curieux et appréciez les environnements qui encouragent l'innovation intellectuelle. Les carrières en laboratoire, en informatique théorique, en mathématiques ou en sciences naturelles pourraient vous satisfaire pleinement.",
                'recommendations' => ['Chercheur en laboratoire', 'Mathématicien', 'Géologue', 'Informaticien', 'Archéologue']
            ],
            [
                'title' => 'Pensée scientifique affirmée',
                'content' => "Votre profil met en évidence des capacités d'analyse et de raisonnement logique remarquables. Vous êtes attiré par les domaines nécessitant expertise technique et pensée critique. La recherche fondamentale ou appliquée, l'ingénierie de systèmes complexes ou les sciences de la vie correspondent à vos aspirations. Vous excellez dans les situations requérant observation minutieuse et déduction.",
                'recommendations' => ['Ingénieur système', 'Biochimiste', 'Psychologue chercheur', 'Économiste', 'Astronome']
            ]
        ],
        'A' => [ // Artistique
            [
                'title' => 'Profil Artistique dominant',
                'content' => "Vos résultats révèlent une sensibilité artistique développée et un besoin d'expression créative. Vous appréciez l'originalité, l'esthétique et les environnements qui valorisent l'innovation. Les métiers de la création, du design, des arts ou de la communication correspondent à votre profil. Vous êtes attiré par les projets qui permettent de laisser libre cours à votre imagination et de créer quelque chose d'unique.",
                'recommendations' => ['Designer graphique', 'Architecte d\'intérieur', 'Artiste', 'Réalisateur', 'Illustrateur']
            ],
            [
                'title' => 'Créativité naturelle affirmée',
                'content' => "Votre profil indique un fort potentiel créatif et une préférence pour les activités artistiques. Vous excellez dans les domaines nécessitant imagination, sens esthétique et originalité. Les métiers du spectacle, de la mode, de la publicité ou des arts visuels sont en adéquation avec vos talents. Vous valorisez la liberté d'expression et les environnements flexibles.",
                'recommendations' => ['Styliste', 'Photographe', 'Scénographe', 'Compositeur', 'Directeur artistique']
            ],
            [
                'title' => 'Sensibilité esthétique développée',
                'content' => "Vos résultats soulignent votre goût pour la beauté, l'harmonie et l'expression personnelle. Vous êtes attiré par les projets créatifs et les environnements qui encouragent l'innovation artistique. Les carrières en design, en arts appliqués, en communication visuelle ou en création de contenu correspondent à votre profil. Vous appréciez le travail autonome et les projets diversifiés.",
                'recommendations' => ['UX Designer', 'Décorateur', 'Créateur de contenu', 'Graphiste', 'Motion designer']
            ],
            [
                'title' => 'Expression artistique valorisée',
                'content' => "Votre profil met en avant votre capacité à imaginer, concevoir et réaliser des projets créatifs. Vous êtes sensible aux formes, aux couleurs et aux atmosphères. Les domaines comme les arts du spectacle, le multimédia, l'artisanat d'art ou la communication créative pourraient vous épanouir. Vous recherchez du sens et de l'authenticité dans votre travail.",
                'recommendations' => ['Comédien', 'Web designer', 'Céramiste', 'Chef cuisinier', 'Danseur']
            ]
        ],
        'S' => [ // Social
            [
                'title' => 'Profil Social prononcé',
                'content' => "Vos résultats révèlent une forte orientation vers les métiers relationnels et l'aide aux autres. Vous excellez dans les situations d'interaction humaine et trouvez satisfaction à contribuer au bien-être d'autrui. Les carrières dans l'éducation, la santé, le social ou les ressources humaines correspondent parfaitement à votre profil. Vous valorisez l'empathie, la communication et le travail d'équipe.",
                'recommendations' => ['Enseignant', 'Infirmier', 'Éducateur spécialisé', 'Psychologue', 'Assistant social']
            ],
            [
                'title' => 'Compétences relationnelles affirmées',
                'content' => "Votre profil indique des aptitudes remarquables pour le contact humain et l'accompagnement. Vous êtes attiré par les métiers qui ont un impact direct sur la vie des personnes. Les domaines du conseil, de la formation, du soin ou de l'animation sociale sont en adéquation avec vos talents. Vous appréciez les environnements collaboratifs et bienveillants.",
                'recommendations' => ['Conseiller d\'orientation', 'Formateur', 'Ergothérapeute', 'Coach', 'Animateur socioculturel']
            ],
            [
                'title' => 'Orientation service et accompagnement',
                'content' => "Vos résultats soulignent votre sensibilité aux besoins d'autrui et votre désir d'être utile. Vous êtes doué pour l'écoute, la communication et la résolution de problèmes humains. Les carrières dans le médico-social, l'éducation spécialisée, les services à la personne ou le conseil correspondent à votre profil. Vous recherchez du sens et de l'impact positif dans votre travail.",
                'recommendations' => ['Orthophoniste', 'Aide-soignant', 'Conseiller d\'insertion', 'Puéricultrice', 'Médiateur']
            ],
            [
                'title' => 'Aptitude naturelle aux relations humaines',
                'content' => "Votre profil met en évidence votre capacité à créer du lien, à comprendre les autres et à favoriser leur développement. Vous excellez dans les situations nécessitant diplomatie, patience et bienveillance. Les métiers de la santé mentale, du développement personnel, de l'action sociale ou de la petite enfance correspondent à vos aspirations.",
                'recommendations' => ['Psychothérapeute', 'Responsable RH', 'Auxiliaire de vie', 'Directeur de crèche', 'Travailleur social']
            ]
        ],
        'E' => [ // Entreprenant
            [
                'title' => 'Profil Entreprenant dominant',
                'content' => "Vos résultats révèlent un esprit entrepreneurial affirmé et des compétences en leadership. Vous êtes motivé par les défis, la prise de décision et l'atteinte d'objectifs ambitieux. Les carrières dans le commerce, le management, l'entrepreneuriat ou la politique correspondent à votre profil. Vous appréciez l'autonomie, la compétition et les environnements dynamiques où vous pouvez avoir de l'influence.",
                'recommendations' => ['Entrepreneur', 'Commercial', 'Manager', 'Chef d\'entreprise', 'Consultant']
            ],
            [
                'title' => 'Leadership et ambition affirmés',
                'content' => "Votre profil indique de fortes capacités de persuasion et un goût pour la stratégie et les responsabilités. Vous excellez dans la négociation, la gestion de projets et l'animation d'équipes. Les domaines du business development, du marketing, de la gestion ou de la vente correspondent à vos talents. Vous valorisez la performance, les résultats et la progression de carrière.",
                'recommendations' => ['Business developer', 'Directeur commercial', 'Chef de projet', 'Responsable marketing', 'Négociateur']
            ],
            [
                'title' => 'Esprit d\'initiative développé',
                'content' => "Vos résultats soulignent votre dynamisme, votre confiance en vous et votre capacité à convaincre. Vous êtes attiré par les situations nécessitant prise de risque calculée et vision stratégique. Les carrières en vente, en développement commercial, en gestion de patrimoine ou en relations publiques correspondent à votre profil. Vous recherchez variété, challenge et reconnaissance.",
                'recommendations' => ['Conseiller financier', 'Agent immobilier', 'Responsable des ventes', 'Chargé d\'affaires', 'Lobbyiste']
            ],
            [
                'title' => 'Compétences entrepreneuriales naturelles',
                'content' => "Votre profil met en avant votre aptitude à identifier les opportunités, à mobiliser les ressources et à piloter des projets ambitieux. Vous êtes orienté résultats et savez fédérer autour de vos idées. Les métiers du management stratégique, de la création d'entreprise, du conseil en stratégie ou de la direction correspondent à vos aspirations.",
                'recommendations' => ['Directeur général', 'Consultant en stratégie', 'Créateur de startup', 'Franchiseur', 'Business angel']
            ]
        ],
        'C' => [ // Conventionnel
            [
                'title' => 'Profil Conventionnel affirmé',
                'content' => "Vos résultats révèlent une préférence pour les environnements structurés et les tâches organisées. Vous excellez dans le respect des procédures, la gestion de l'information et le travail méticuleux. Les carrières dans l'administration, la comptabilité, la gestion ou les services administratifs correspondent à votre profil. Vous appréciez la clarté, l'ordre et la fiabilité dans votre travail.",
                'recommendations' => ['Comptable', 'Assistant administratif', 'Contrôleur de gestion', 'Secrétaire', 'Gestionnaire']
            ],
            [
                'title' => 'Rigueur et organisation valorisées',
                'content' => "Votre profil indique des aptitudes remarquables pour le traitement précis de l'information et le suivi rigoureux des dossiers. Vous êtes attiré par les métiers nécessitant méthode, conformité et attention aux détails. Les domaines de la finance, du juridique, de la documentation ou de la logistique sont en adéquation avec vos talents. Vous valorisez la stabilité et les systèmes bien définis.",
                'recommendations' => ['Auditeur', 'Juriste', 'Documentaliste', 'Gestionnaire de stock', 'Analyste financier']
            ],
            [
                'title' => 'Compétences administratives développées',
                'content' => "Vos résultats soulignent votre efficacité dans la gestion des données, des chiffres et des processus administratifs. Vous excellez dans l'organisation, la planification et le respect des normes. Les carrières en back-office, en gestion de paie, en administration publique ou en conformité correspondent à votre profil. Vous appréciez les environnements prévisibles et structurés.",
                'recommendations' => ['Gestionnaire de paie', 'Agent administratif', 'Contrôleur interne', 'Archiviste', 'Office manager']
            ],
            [
                'title' => 'Méthodologie et précision naturelles',
                'content' => "Votre profil met en avant votre fiabilité, votre sens du détail et votre capacité à gérer des systèmes complexes. Vous êtes doué pour le traitement systématique de l'information et le respect des procédures. Les métiers de la banque, de l'assurance, de la qualité ou de la gestion administrative correspondent à vos aspirations. Vous recherchez clarté, efficacité et professionnalisme.",
                'recommendations' => ['Conseiller bancaire', 'Gestionnaire de sinistres', 'Responsable qualité', 'Chargé de clientèle', 'Responsable administratif']
            ]
        ]
    ];

    /**
     * Retourne un feedback aléatoire pour une dimension donnée
     */
    public static function getRandomFeedback(string $dimensionCode): ?array
    {
        if (!isset(self::FEEDBACKS[$dimensionCode])) {
            return null;
        }

        $feedbacks = self::FEEDBACKS[$dimensionCode];
        return $feedbacks[array_rand($feedbacks)];
    }

    /**
     * Retourne un feedback basé sur la dimension dominante d'une session
     */
    public static function getFeedbackForDominantDimension(array $scores): ?array
    {
        if (empty($scores)) {
            return null;
        }

        // Trouver la dimension avec le score le plus élevé
        $maxScore = max($scores);
        $dominantDimension = array_search($maxScore, $scores);

        return self::getRandomFeedback($dominantDimension);
    }
}

