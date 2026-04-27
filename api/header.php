<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Auto-login for development/demo as requested
if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    $_SESSION['user_id'] = 1;
    $_SESSION['username'] = 'DemoUser';
}

$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VEGA Reserv | System Pro</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/style.css?v=<?= time() ?>">
</head>

<body>

<div class="mesh-bg"></div>

<div class="main-wrapper">
    <aside class="sidebar">
        <div class="logo-container">
            <div class="logo-text">VEGA</div>
        </div>
        
        <nav class="nav-menu">
            <a href="ajouter_reservation.php" class="nav-item <?= $current_page == 'ajouter_reservation.php' ? 'active' : '' ?>">
                <span class="icon">➕</span> <span>Nouvelle Réservation</span>
            </a>
            <a href="lisete_reservation.php" class="nav-item <?= $current_page == 'lisete_reservation.php' ? 'active' : '' ?>">
                <span class="icon">📋</span> <span>Liste des Réservations</span>
            </a>
            <a href="#" class="nav-item">
                <span class="icon">📊</span> <span>Statistiques</span>
            </a>
            <div style="margin-top: auto; padding-top: 2rem; border-top: 1px solid var(--card-border);">
                <a href="logout.php" class="nav-item" style="color: #ff5252;">
                    <span class="icon">🚪</span> <span>Déconnexion</span>
                </a>
            </div>
        </nav>
    </aside>

    <main class="content-area">
        <header class="header-top">
            <div class="welcome-text">
                <h1>Hello, <?= htmlspecialchars($_SESSION['username']) ?></h1>
                <p>Bienvenue sur votre portail de gestion premium.</p>
            </div>
            <div class="user-profile">
                <div style="width: 48px; height: 48px; border-radius: 50%; background: var(--card-bg); border: 1px solid var(--primary); display: flex; align-items: center; justify-content: center; font-weight: 800; color: var(--primary);">
                    <?= substr($_SESSION['username'], 0, 1) ?>
                </div>
            </div>
        </header>
