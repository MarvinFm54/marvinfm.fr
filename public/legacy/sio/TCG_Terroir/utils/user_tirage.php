<?php
if (!isset($_SESSION['user'])) 
{
    header("Location: index.php?p=connect");
    exit;
}

$username = $_SESSION['user'];

$stmt = $pdo->prepare("SELECT id, last_draw FROM users WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch();

$user_id = $user['id'];
$last_draw = $user['last_draw'];

$can_draw = false;
if (!$last_draw || strtotime($last_draw) < time() - 3600) 
{
    $can_draw = true;
}
?>