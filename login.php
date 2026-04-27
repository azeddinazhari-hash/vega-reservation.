<?php
session_start();
require_once __DIR__ . '/db.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = :user";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':user' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: ajouter_reservation.php");
        exit;
    } else {
        $error = "Identifiants incorrects. Veuillez réessayer.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Vega Reservation</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #00e676;
            --primary-hover: #00c853;
            --bg-dark: #0a0e14;
            --text-main: #ffffff;
            --border: rgba(255, 255, 255, 0.1);
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-dark);
            background-image: radial-gradient(circle at center, rgba(0, 230, 118, 0.08) 0%, transparent 70%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-main);
        }
        .login-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            padding: 3.5rem;
            border-radius: 24px;
            border: 1px solid var(--border);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 460px;
            animation: fadeIn 0.8s ease-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .logo {
            font-family: 'Outfit', sans-serif;
            font-size: 2.25rem;
            font-weight: 900;
            background: linear-gradient(135deg, #00e676 0%, #00c853 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-align: center;
            margin-bottom: 2.5rem;
            letter-spacing: -1.5px;
        }
        .logo span { -webkit-text-fill-color: #fff; opacity: 0.9; }
        h1 { font-family: 'Outfit', sans-serif; font-size: 1.75rem; font-weight: 800; margin-bottom: 0.5rem; text-align: center; }
        p.subtitle { color: rgba(255, 255, 255, 0.5); text-align: center; margin-bottom: 2.5rem; font-size: 0.9rem; }
        
        .form-group { margin-bottom: 1.5rem; }
        label { display: block; font-size: 0.75rem; font-weight: 700; margin-bottom: 0.75rem; text-transform: uppercase; letter-spacing: 1px; color: rgba(255, 255, 255, 0.6); }
        input {
            width: 100%;
            padding: 1rem 1.25rem;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--border);
            border-radius: 12px;
            color: white;
            font-size: 1rem;
            transition: all 0.3s;
        }
        input:focus {
            outline: none;
            border-color: var(--primary);
            background: rgba(255, 255, 255, 0.06);
            box-shadow: 0 0 20px rgba(0, 230, 118, 0.1);
        }
        .btn {
            width: 100%;
            padding: 1.1rem;
            background: linear-gradient(135deg, #00e676 0%, #00c853 100%);
            color: #0a0e14;
            border: none;
            border-radius: 12px;
            font-weight: 800;
            font-family: 'Outfit', sans-serif;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 30px rgba(0, 230, 118, 0.3);
        }
        .error {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
            padding: 1rem;
            border-radius: 12px;
            font-size: 0.85rem;
            margin-bottom: 1.5rem;
            border: 1px solid rgba(239, 68, 68, 0.2);
            text-align: center;
            font-weight: 500;
        }
        .footer-links {
            margin-top: 2.5rem;
            text-align: center;
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.4);
        }
        .footer-links a { color: var(--primary); text-decoration: none; font-weight: 700; }
    </style>

</head>
<body>
    <div class="login-card">
        <div class="logo">VEGA<span>RESERV</span></div>
        <h1>Bienvenue</h1>
        <p class="subtitle">Connectez-vous pour gérer vos réservations</p>

        <?php if ($error): ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label for="username">Utilisateur</label>
                <input type="text" id="username" name="username" placeholder="votre_nom" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" placeholder="••••••••" required>
            </div>
            <button type="submit" class="btn">Se connecter</button>
        </form>

        <div class="footer-links">
            Pas encore de compte ? <a href="#">Contactez l'administrateur</a>
        </div>
    </div>
</body>
</html>