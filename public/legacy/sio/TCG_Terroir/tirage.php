<?php
include("./utils/ini_session.php");
include("./utils/db_access.php");
include("./utils/user_tirage.php");

if ($can_draw) 
{
    
    function getDropRate($category) {
        global $dropRates;
        return isset($dropRates[$category]) ? $dropRates[$category] : 0.0;
    }
    
    function tirerCategorie($dropRates) {
        $rand = mt_rand() / mt_getrandmax() * 100;
        $cumul = 0;
        foreach ($dropRates as $cat => $rate) {
            $cumul += $rate;
            if ($rand <= $cumul) {
                return $cat;
            }
        }
        return 'commun';
    }
    
    function tirerCartes($pdo, $dropRates, $nb = 3) {
        $cartes = [];
    
        while (count($cartes) < $nb) {
            $categorie = tirerCategorie($dropRates);
    
            $stmt = $pdo->prepare("
                SELECT f.id 
                FROM cheeses f
                LEFT JOIN categories c ON f.categorie_id = c.id
                WHERE c.nom = ?
                ORDER BY RAND()
                LIMIT 1
            ");
            $stmt->execute([$categorie]);
            $result = $stmt->fetch();
    
            if ($result) {
                $cartes[] = ['id' => $result['id']];
            }
        }
    
        return $cartes;
    }

}
$dropRates = [ 
    'commun' => 55.0, 
    'peu commun' => 25.0, 
    'rare' => 12.0, 
    'épique' => 5.0, 
    'légendaire' => 2.0, 
    'or' => 0.5, 
    'diamant' => 0.4, 
    'FOAT' => 0.1
];

$cards = $can_draw ? tirerCartes($pdo, $dropRates) : [];

if ($can_draw) 
{
    foreach ($cards as $card) 
    {
        $pdo->prepare("INSERT INTO collections_cheeses (id_user, id_cheese, date) VALUES (?, ?, NOW())")
            ->execute([$user_id, $card['id']]);
    }

    $pdo->prepare("UPDATE users SET last_draw = NOW() WHERE id = ?")->execute([$user_id]);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Tirage de cartes</title>
    <link rel="stylesheet" href="./public/couleurs.css">
    <link rel="stylesheet" href="./public/styles_header.css">
    <link rel="stylesheet" href="./public/styles_common_pages.css">
    <?php include("./utils/common_head.php"); ?>
</head>
<body class="cheese">
    <?php include("./parts/header_tirage.php"); ?>

    <section class="container-tirage">
        <div>
            <nav class="content">
                <h1>Tirage de cartes</h1>
                <?php if ($can_draw): ?>
                    <p>Voici tes cartes ! Elles vont être ajoutées à ta collection. </p>
                <?php else: ?>
                    <p>Tu as déjà tiré tes cartes. Reviens dans une heure !</p>
                <?php endif; ?>
            </nav>
        </div>

        <?php if ($can_draw): ?>
        <section class="content-home">
            <?php foreach ($cards as $card): 
                $stmt = $pdo->prepare("
                    SELECT f.nom AS fromage, f.description, f.image_url, c.nom AS categorie
                    FROM cheeses f
                    LEFT JOIN categories c ON f.categorie_id = c.id
                    WHERE f.id = ?
                ");
                $stmt->execute([$card['id']]);
                $fromage = $stmt->fetch();
                
                $dropRate = getDropRate($fromage['categorie']);
            ?>
            <div class="card-home tirage" data-drop-rate="<?= $dropRate ?>">
                <h2><?= htmlspecialchars($fromage['fromage']) ?></h2>
                <p><?= nl2br(htmlspecialchars($fromage['description'])) ?></p>
                <?php if ($fromage['image_url']): ?>
                    <img src="<?= $fromage['image_url'] ?>" alt="">
                <?php endif; ?>
                <h4><?= htmlspecialchars($fromage['categorie']) ?></h4>
            </div>
            <?php endforeach; ?>
        </section>
        <?php endif; ?>
    </section>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init();</script>
</body>
</html>
