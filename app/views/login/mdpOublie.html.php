<?php 
require_once __DIR__ . '/../../enums/Textes.php';
use App\MESS\Enums\Textes;
 ?>
<!DOCTYPE html>
<html lang="fr">
<?php
$url="http://".$_SERVER["HTTP_HOST"];


?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= $url.Chemins::CheminAssetCss->value."/login.css"; ?>">
    <title>Connexion</title>
</head>
<body>
    <div class="container">

        <div class="entSonatel">
           <img src="<?= $url.Chemins::CheminAssetImage->value."/logo_odc.png"?>" alt="logo sonatel">
         </div>
       
        <div class="mBienvenue">
            <h5><?= Textes::Bienvenue1->value; ?></h5>
            <h5 class="ECSA"><?=Textes::ECSA->value;?></h5>
        </div>
        <div class="seConnecter"><?=Textes::ChangePass->value;?></div>
        <?php if(!empty($_SESSION['message'])): ?>
            <div class="alert"><?= $_SESSION['message'] ?></div>
        <?php endif; ?>
        <?php unset($_SESSION['message']); ?>

            <form action="/MDP" method="POST">
                <div class="login">
                    <label for="login"><?=Textes::EntrerEm->value;?></label>
                
                    <input type="text" class=" <?php if(empty($message["msgId"])): ?> entrer <?php else: ?>entrer alert<?php endif; ?>  " id="login" name="email" placeholder="<?php if(empty($message["msgId"])): ?><?=Textes::EntrerEm->value;?><?php else: ?><?= $message["msgId"] ?><?php endif; ?> ">
            
                </div>
                <div class="mdp">
                    <label for="password"><?=Textes::MDP->value;?></label>
            
                        <input type="text" class="<?php if(empty($message["msgP"])):?>entrer masque<?php else: ?>entrer masque alert<?php endif; ?>" id="password" name="password" placeholder="<?php if(empty($message["msgP"])): ?><?=Textes::PlaceholderMdp->value;?><?php else: ?><?= $message["msgP"] ?><?php endif; ?>" >
                </div>

                <div class="bc">
                    <input class="btnSeConnecter"  type="submit" value="<?=Textes::Changer->value;?>">   
                </div>
            </form>
    
    </div>
</body>
</html>