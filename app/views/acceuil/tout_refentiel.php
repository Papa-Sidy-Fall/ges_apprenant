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
    <link rel="stylesheet" href="<?= $urlCss . Chemins::CheminAssetCss->value ."/tout_referentiel.css" ?>">
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
        <div id="openModalBtn" class="Gril btn-ajouter " >+ Creer un référentiel</div>           
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




<!-- Le bouton pour ouvrir le modal -->
<div id="openModalBtn" class="btn-ajouter">+ Créer un référentiel</div>

<!-- Le Modal -->
<div id="referentielModal" class="modal">
    <div class="modal-content">
        <div class="cln">
            
            <h2>Créer un nouveau référentiel</h2>
            <span class="close">×</span>
        </div>

    <form action="/referentiels/ajout" method="post" enctype="multipart/form-data">
        <label for="photo">Photo du référentiel</label>
        <div class="photdp">
            <label for="photo" class="drop-area">
                <span class="aj">Ajouter </span> ou Glisser
            </label>
            <input type="file" id="photo" name="photoReferentiel" accept="image/*" style="display: none;" required>
        </div>

        <label>Nom*</label>
        <input type="text" class="nomref" name="nomReferentiel" placeholder="Nom du référentiel" required>

        <label>Description</label>
        <textarea name="description" class="textar" placeholder="Description"></textarea>

        <div class="form-row">
            <div>
                <label>Capacité*</label>
                <input type="number" class="capacite" name="capacite" value="30" required>
            </div>
            <div >
                <label>Nombre de sessions*</label>
                <select class="select" name="nombre_sessions" required>
                    <option>1 session</option>
                    <option>2 sessions</option>
                    <option>3 sessions</option>
                </select>
            </div>
        </div>

        <div class="form-actions">
            <button type="button" class="cancel-btn">Annuler</button>
            <button type="submit" class="submit" class="submit-btn">Créer</button>
        </div>
    </form>
    </div>
</div>

<style>
/* Styles pour la page de création de référentiel */
.form-container {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    margin-top: 20px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 500;
}

.form-group input[type="text"],
.form-group textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
}

.form-group textarea {
    height: 120px;
    resize: vertical;
}

.photdp {
    margin-top: 10px;
}

.drop-area {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100px;
    border: 2px dashed #ddd;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.drop-area:hover {
    background-color: #f9f9f9;
}

.actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 20px;
}

.cancel {
    background-color: #f1f1f1;
    color: #333;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
    font-weight: 500;
}

.submit {
    background-color: #00775b;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
    font-weight: 500;
}

.erreurs {
    background-color: #ffebee;
    color: #c62828;
    padding: 10px 15px;
    border-radius: 4px;
    margin-bottom: 20px;
}

.success-message {
    background-color: #e8f5e9;
    color: #2e7d32;
    padding: 10px 15px;
    border-radius: 4px;
    margin-bottom: 20px;
}

.btn-creer-referentiel {
    display: inline-block;
    background-color: #00775b;
    color: white;
    padding: 10px 15px;
    border-radius: 4px;
    text-decoration: none;
    margin-bottom: 20px;
}

.btn-creer-referentiel i {
    margin-right: 5px;
}
</style>

<script>
const modal = document.getElementById("referentielModal");
const openBtn = document.getElementById("openModalBtn");  // ici openModalBtn
const closeBtn = document.querySelector(".close");
const cancelBtn = document.querySelector(".cancel-btn");

openBtn.onclick = () => modal.style.display = "block";
closeBtn.onclick = () => modal.style.display = "none";
cancelBtn.onclick = () => modal.style.display = "none";

window.onclick = (event) => {
    if (event.target === modal) modal.style.display = "none";
};

// Drag & Drop pour l'image
const dropArea = document.querySelector('.drop-area');

dropArea.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropArea.classList.add('dragover');
});

dropArea.addEventListener('dragleave', () => {
    dropArea.classList.remove('dragover');
});

dropArea.addEventListener('drop', (e) => {
    e.preventDefault();
    dropArea.classList.remove('dragover');
    const fileInput = document.getElementById('photo');
    fileInput.files = e.dataTransfer.files;
});
</script>
</html>
<?php
    return ob_get_clean(); 
}
?>
