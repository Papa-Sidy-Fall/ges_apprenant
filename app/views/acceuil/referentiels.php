<?php 
use App\MESS\Enums\Textes;
include __DIR__ ."/../layout/base.layout.php";

return function ($data) {
    ob_start();
    $urlCss = "http://" . $_SERVER["HTTP_HOST"];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?= $urlCss . Chemins::CheminAssetCss->value ."/referentiel.css" ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Référentiels</title>

</head>
<div class="body">
    <div class="Container">
        <div class="Li1">
            <div class="titre-principal">Réferentiels</div>
            <div><p>Gérer les réferentiels de la promotion</p></div>
        </div>


        <div class="Cherche">
            <div class="search12">
                <form action="" method="get">
                    <input class="search1" type="text" name="recherche" placeholder="Rechercher un referentiel">
                </form>
            </div>
<a href="/Tout_referentiels" class="filtre1"> 
                <div class="icNite"><i class="fa-solid fa-book"></i></div>
                <div class="ai">Tous les réferentiels</div>
                
            
</a>
          <div class="Gril" id="openModal">+ Ajouter à la promotion</div>
            
        </div>

        <div class="separateur"></div>

        <div class="liste-refs">
            <?php if(isset($data)): ?>
                
                <?php foreach ($data as $datas): ?>

                    <div class="item-ref">
                        <div class="containImage"><img src="<?= Chemins::CheminAssetImage->value . '/' . ($datas['PhotoRef'] ?? 'logo_odc.png') ?>" alt=""></div>
                        <div class="titre-ref"><?= htmlspecialchars($datas['Nom'])?></div>
                        <div class="nb-modeles"><?= htmlspecialchars($datas['NombresModule']).' '.'Module(s)'?></div>
                        <div class="desc-ref"><?= htmlspecialchars($datas['Description'])?></div>
                        <div class="Lvert"></div>
                        <div class="derL">
                            <div class="poin">
                                <span class="points1"></span>
                                <span class="points2"></span>
                                <span class="points3"></span>
                            </div>
                            <div class="nbrAp"><p><?= htmlspecialchars($datas['NombresApprenant']).' '.'Apprenants'?></p></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucune promotion disponible.</p>
            <?php endif; ?>

     
        </div>

        <div class="pied-page">
        
        </div>
    </div>
</div>




<div class="modal" id="referentielModal">
    <div class="modal-content">
        <span class="close">×</span>
        <h2>Ajouter un référentiel</h2>
        
        <form action="/referentiels/ajout" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nomReferentiel">Nom du référentiel</label>
                <input type="text" id="nomReferentiel" name="nomReferentiel" required>
            </div>
            
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" required></textarea>
            </div>
            
            <div class="form-group">
                <label for="photoReferentiel">Photo du référentiel</label>
                <div class="photdp">
                    <label for="photoReferentiel" class="drop-area">
                        <span class="aj">Ajouter</span> ou Glisser
                    </label>
                    <input type="file" id="photoReferentiel" name="photoReferentiel" accept="image/*" style="display: none;">
                </div>
            </div>
            
            <div class="actions">
                <button type="button" class="cancel">Annuler</button>
                <button type="submit" class="submit">Ajouter le référentiel</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Script pour ouvrir et fermer le modal
    const modal = document.getElementById('referentielModal');
    const btn = document.getElementById('openModal'); // Le bouton "Ajouter à la promotion"
    const span = document.getElementsByClassName('close')[0];
    const cancelBtn = document.querySelector('.cancel');
    
    btn.onclick = function() {
        modal.style.display = "block";
    }
    
    span.onclick = function() {
        modal.style.display = "none";
    }
    
    cancelBtn.onclick = function() {
        modal.style.display = "none";
    }
    
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
</html>
<?php
    return ob_get_clean(); 
}
?>
