<?php include 'header.php'; ?>

<div style="max-width: 800px; margin: 0 auto;">
    <div class="glass-panel">
        <h2 style="font-family: 'Outfit'; font-size: 2rem; margin-bottom: 2rem; text-align: center; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-alt) 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Nouvelle Réservation</h2>
        
        <form method="POST" action="insert_reservation.php">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                <div class="form-field">
                    <label>Identifiant de Réservation</label>
                    <input type="text" name="code_reservation" class="form-input" placeholder="RES-XXXX" required>
                </div>

                <div class="form-field">
                    <label>Nom complet du Client</label>
                    <input type="text" name="nom_client" class="form-input" placeholder="Client Name" required>
                </div>
            </div>

            <div class="form-field">
                <label>Coordonnées Téléphoniques</label>
                <input type="tel" name="telephone" class="form-input" placeholder="+212 ..." required>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                <div class="form-field">
                    <label>Date d'Arrivée</label>
                    <input type="date" name="date_arrivee" class="form-input" required>
                </div>

                <div class="form-field">
                    <label>Date de Départ</label>
                    <input type="date" name="date_depart" class="form-input" required>
                </div>
            </div>

            <div class="form-field">
                <label>Configuration de la Chambre</label>
                <select name="type_chambre" class="form-input" required>
                    <option value="" disabled selected>Sélectionnez une option...</option>
                    <option value="Simple">Standard Single</option>
                    <option value="Double">Premium Double</option>
                    <option value="Suite">Luxurious Suite</option>
                </select>
            </div>

            <div style="text-align: center; margin-top: 1rem;">
                <button type="submit" class="btn-action" style="width: 100%; justify-content: center;">Confirmer & Enregistrer</button>
            </div>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>




