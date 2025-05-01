<!DOCTYPE html>
<html lang="fr">
<?php
$url="http://".$_SERVER["HTTP_HOST"];
require_once __DIR__ . '/../../enums/Textes.php';
use App\MESS\Enums\Textes;

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
        <div class="seConnecter"><?=Textes::SeConnecter->value;?></div>
     
        <?php if(!empty($_SESSION['message'])): ?>
            <div class="alert"><?= $_SESSION['message'] ?></div>
        <?php endif; ?>
        <?php if(!empty($_SESSION['messageSuccess'])): ?>
            <div class="alertSuccess"><?= $_SESSION['messageSuccess'] ?></div>
        <?php endif; ?>

        <?php unset($_SESSION['message']); ?>

            <form action="/login" method="post">
                <div class="login">
                    <label for="login"><?=Textes::Login->value;?></label>
                   
                    <input type="text" value="<?= htmlspecialchars($_POST['login'] ?? '') ?>" class=" <?php if(empty($message["msgId"])): ?> entrer <?php else: ?>entrer alert<?php endif; ?>  " id="login" name="login" placeholder="<?php if(empty($message["msgId"])): ?><?=Textes::PlaceholderLogin->value;?><?php else: ?><?= $message["msgId"] ?><?php endif; ?> ">
            
                </div>
                <div class="mdp">
                    <label for="password"><?=Textes::MDP->value;?></label>
               
                        <input type="text" value="<?= htmlspecialchars($_POST['password'] ?? '') ?>" class="<?php if(empty($message["msgP"])):?>entrer masque<?php else: ?>entrer masque alert<?php endif; ?>" id="password" name="password" placeholder="<?php if(empty($message["msgP"])): ?><?=Textes::PlaceholderMdp->value;?><?php else: ?><?= $message["msgP"] ?><?php endif; ?>" >
                </div>
                <div class="mdpOublie">
                    <a href="/MDP"><?=Textes::MDPOublie->value;?></a>
                </div>
                <div class="bc">
                   <input class="btnSeConnecter"  type="submit" value="<?=Textes::SeConnecter->value;?>">   
                </div>
            </form>
      
    </div>
</body>
</html>