<?php
    declare(strict_types=1);

    namespace App\Controllersdescription;

    use App\Enums\Fonction\Fonction;
    use App\MESS\Enums\Textes;
    use Chemins;
    $controller=require __DIR__ . "/controller.php";
    $modelRef = $controller[Fonction::Inclusion->value](Chemins::ServiceRef->value);

    function ajoutdescription(array $params, array $modelRef,$controller)
    {
        $donnee = include __DIR__ . Chemins::Model->value;
        $database = &$donnee['database'];
        $databaseFile = $donnee['databaseFile'];
        $nomRef = $params['nomRef'] ?? '';
        $description = $params['description'] ?? '';
        $photoref = $_FILES['photo'] ?? null;
        $nbrModule = (int)$params['nbrModule'] ?? 0;
        $nbrApprenant = (int)$params['nbrApprenant'] ??0;
    
        $erreurs = [];
    
        // Validation des données
        if (empty($nomRef)) {
            $erreurs[] = "Le nom du référentiel est obligatoire";
        }
    
        if (empty($description)) {
            $erreurs[] = "La description est obligatoire";
        }
    
        if (empty($photoref['name'])) {
            $erreurs[] = "La photo du référentiel est obligatoire";
        }
    
        // Vérifier l'unicité du nom du référentiel
        if (isset($modelRef['unicite']) && !$modelRef['unicite']($database, $nomRef)) {
            $erreurs[] = "Ce référentiel existe déjà";
        }
    
        if (!empty($erreurs)) {
            $_SESSION['erreurs'] = $erreurs;
            $_SESSION['old'] = [
                'nomReferentiel' => $nomRef,
                'description' => $description
            ];
            header('Location: /referentiels/creer');
            exit;
        }
    
        // Sauvegarder la photo
        $photorefPath= $controller[Fonction::SavePhoto->value]($photoref);
    
        // Ajouter le référentiel à la base de données
        if ($modelRef[Fonction::ajouterRef->value]($database, $nomRef, 0, $description, 0, $photorefPath)) {
            $controller[Fonction::FPC->value]($databaseFile, $database);
            $_SESSION['message'] = "Le référentiel a été ajouté avec succès";
            header('Location: /Tout_referentiels');
        } else {
            $_SESSION['erreurs'] = ["Erreur lors de l'ajout du référentiel"];
            header('Location: /referentiels/creer');
        }
    
        exit;
    }
    function affichageRef(): void
    {
        $donnee = include __DIR__ . Chemins::Model->value;
        $database = $donnee['database'];

        $serviceRef = include __DIR__ . Chemins::ServiceRef->value;
        $infoRef = $serviceRef['afficherAllRef']($database);

        $ref = include __DIR__ . Chemins::Referentiel->value;
        $layout = include __DIR__ . Chemins::Layout->value;

        echo $layout($ref($infoRef));
    }

    function affichageToutRef(): void
    {

        $donnee = include __DIR__ . Chemins::Model->value;
        $database = $donnee['database'];

        $serviceRef = include __DIR__ . Chemins::ServiceRef->value;
        $infoRef = $serviceRef['afficherAllRef']($database);

        $ref = include __DIR__ . Chemins::Tous_referentiel->value;
        $layout = include __DIR__ . Chemins::Layout->value;

        echo $layout($ref($infoRef));
    
        
    }

    return [
        Fonction::AffichageRef->value => 'App\Controllersdescription\affichageRef',
        Fonction::AffichageToutRef->value  => 'App\Controllersdescription\affichageToutRef',
        '/referentiels/creer' => function() use ($referentielController) {
            $referentielController['afficherPageCreation']();
        },
    ];