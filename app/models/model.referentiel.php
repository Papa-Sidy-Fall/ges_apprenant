<?php
namespace App\ModelsRef;
use App\Enums\Fonction\Fonction;
return [
    Fonction::ajouterRef->value => function(array &$database, string $nomModule, int $nbrModule, string $desRef, int $nbrApr, $photoRef) {
        $database['Module'][] = [
            'Nom' => $nomModule,
            'NombresModule' => $nbrModule,
            'Description' => $desRef,
            'NombresApprenant' => $nbrApr,
            'photoRef' => $photoRef,
            'statut' => 'inactive'
        ];
        return true;
    },
    Fonction::afficherAllRef->value => fn($database) => $database['Referentiels'],

    Fonction::unicite->value => function(array $database, string $nomRef) {
        $unique = true;
        array_walk($database['Referentiels'], function($Ref) use ($nomRef, &$unique) {
            if (isset($Ref['Nom']) && $Ref['Nom'] === $nomRef) {
                $unique = false;
            }
        });
        return $unique;
    },



];
?>
