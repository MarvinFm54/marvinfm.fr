<?php
$stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
$stmt->execute([$_SESSION["user"]]);
$user = $stmt->fetch();

$user_id = $user['id'];

$db_query = $pdo->prepare("SELECT id_cheese FROM collections_cheeses WHERE id_user = ?");
$db_query->execute([$user_id]);
$cheeses = $db_query->fetchAll(PDO::FETCH_COLUMN); // seulement les id_cheese

// Compter les répétitions
$cheese_counts = array_count_values($cheeses);

foreach ($cheese_counts as $cheese_id => $repetition) {
    $db_query = $pdo->prepare("
        SELECT 
            f.id,
            f.nom AS fromage,
            f.description,
            f.image_url,
            c.nom AS categorie
        FROM cheeses f
        LEFT JOIN categories c ON f.categorie_id = c.id
        WHERE f.id = ?
    ");
    $db_query->execute([$cheese_id]);
    $fromage = $db_query->fetch();

    echo "<div class='card-home'>";
    echo "<a><div class='card-text'>";
    echo "<h2>{$fromage['fromage']} ";
    if ($repetition > 1) 
    {
        echo "({$repetition})";
        
    }
    echo "</h2>";
    echo "<h3>" . nl2br(htmlspecialchars($fromage['description'])) . "</h3>";

    if (!empty($fromage['image_url'])) {
        echo "<img src='{$fromage['image_url']}' alt='Image de {$fromage['fromage']}'>";
    }

    echo "<h4>{$fromage['categorie']}</h4>";
    echo "</div></a>";
    echo "</div>";
}
?>
