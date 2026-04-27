<?php 
require 'db.php';
include 'header.php';

$reservations = [];
if (!$db_error) {
    try {
        $sql = "SELECT * FROM reservation ORDER BY id DESC";
        $stmt = $pdo->query($sql);
        $reservations = $stmt->fetchAll();
    } catch (Exception $e) {
        $db_error = true;
    }
}

// Fallback to Mock Data for CV/Demo if DB is not connected
if ($db_error || empty($reservations)) {
    $reservations = [
        ['id' => 101, 'code_reservation' => 'RES-9921', 'nom_client' => 'Jean-Pierre Laurent', 'telephone' => '+33 6 12 34 56 78', 'date_arrivee' => date('Y-m-d'), 'date_depart' => date('Y-m-d', strtotime('+3 days')), 'type_chambre' => 'Suite Lux'],
        ['id' => 102, 'code_reservation' => 'RES-8842', 'nom_client' => 'Sarah Benali', 'telephone' => '+212 6 61 22 33 44', 'date_arrivee' => date('Y-m-d', strtotime('-1 day')), 'date_depart' => date('Y-m-d', strtotime('+5 days')), 'type_chambre' => 'Premium Double'],
        ['id' => 103, 'code_reservation' => 'RES-7710', 'nom_client' => 'Michael Smith', 'telephone' => '+1 202 555 0123', 'date_arrivee' => date('Y-m-d', strtotime('+2 days')), 'date_depart' => date('Y-m-d', strtotime('+10 days')), 'type_chambre' => 'Standard Single']
    ];
}

$total = count($reservations);
$today_count = 1; 
?>


<div class="stats-grid">
    <div class="stat-card">
        <span class="stat-label">Total Réservations</span>
        <span class="stat-value"><?= $total ?></span>
    </div>
    <div class="stat-card">
        <span class="stat-label">Aujourd'hui</span>
        <span class="stat-value"><?= $today_count ?></span>
    </div>
    <div class="stat-card">
        <span class="stat-label">Statut Système</span>
        <span class="stat-value" style="color: var(--primary);">OPTIMAL</span>
    </div>
</div>

<div class="glass-panel">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h2 style="font-family: 'Outfit'; font-size: 1.5rem;">Base de données des Clients</h2>
        <a href="ajouter_reservation.php" class="btn-action">+ Nouvelle Entrée</a>
    </div>

    <?php if (isset($_GET['success'])): ?>
        <div style="background: rgba(0, 255, 136, 0.1); color: var(--primary); padding: 1rem; border-radius: 12px; margin-bottom: 1.5rem; text-align: center; font-weight: 700; border: 1px solid rgba(0, 255, 136, 0.2);">
            Opération réussie ! Votre base de données est à jour.
        </div>
    <?php endif; ?>

    <div class="premium-table-wrapper">
        <table class="premium-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Code/ID</th>
                    <th>Client</th>
                    <th>Téléphone</th>
                    <th>Période</th>
                    <th>Chambre</th>
                    <th>État</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($reservations)): ?>
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 4rem; color: var(--text-gray);">
                            <div style="font-size: 3rem; margin-bottom: 1rem;">📂</div>
                            Aucun enregistrement trouvé.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($reservations as $res): ?>
                        <tr>
                            <td style="font-weight: 800; color: var(--primary);"><?= $res['id'] ?></td>
                            <td><span class="status-pill status-active" style="background: rgba(0, 204, 255, 0.1); color: #0cf; border-color: rgba(0, 204, 255, 0.2);"><?= htmlspecialchars($res['code_reservation']) ?></span></td>
                            <td>
                                <div style="font-weight: 700; color: #fff;"><?= htmlspecialchars($res['nom_client']) ?></div>
                            </td>
                            <td style="color: var(--text-gray);"><?= htmlspecialchars($res['telephone']) ?></td>
                            <td>
                                <div style="font-weight: 600; color: #fff;">
                                    <?= !empty($res['date_arrivee']) ? date('d M', strtotime($res['date_arrivee'])) : '?' ?> - 
                                    <?= !empty($res['date_depart']) ? date('d M Y', strtotime($res['date_depart'])) : '?' ?>
                                </div>
                            </td>
                            <td><span style="font-weight: 600;"><?= htmlspecialchars($res['type_chambre']) ?></span></td>
                            <td><span class="status-pill status-active">Vérifié</span></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'footer.php'; ?>

