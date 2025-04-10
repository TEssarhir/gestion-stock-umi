<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_materiel";

// Database connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle CRUD operations for materiel
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_materiel'])) {
        $nom = $_POST['nom'];
        $description = $_POST['description'];
        $categorie = $_POST['categorie'];
        $etat = $_POST['etat'];
        $quantite = $_POST['quantite'];

        $stmt = $conn->prepare("INSERT INTO Equipement (nom, description, catégorie, état, quantite_dispo) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssi", $nom, $description, $categorie, $etat, $quantite);
        $stmt->execute();
        $stmt->close();
    } elseif (isset($_POST['update_materiel'])) {
        $id = $_POST['id'];
        $nom = $_POST['nom'];
        $description = $_POST['description'];
        $categorie = $_POST['categorie'];
        $etat = $_POST['etat'];
        $quantite = $_POST['quantite'];

        $stmt = $conn->prepare("UPDATE Equipement SET nom = ?, description = ?, catégorie = ?, état = ?, quantite_dispo = ? WHERE id_equipement = ?");
        $stmt->bind_param("ssssii", $nom, $description, $categorie, $etat, $quantite, $id);
        $stmt->execute();
        $stmt->close();
    } elseif (isset($_POST['delete_materiel'])) {
        $id = $_POST['id'];

        $stmt = $conn->prepare("DELETE FROM Equipement WHERE id_equipement = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
}

// Fetch equipment for listing and filtering
$filterCategory = isset($_GET['filter_category']) ? $_GET['filter_category'] : '';
$filterStatus = isset($_GET['filter_status']) ? $_GET['filter_status'] : '';

$query = "SELECT * FROM Equipement WHERE 1=1";
$params = [];
$types = "";

if ($filterCategory) {
    $query .= " AND catégorie = ?";
    $params[] = $filterCategory;
    $types .= "s";
}

if ($filterStatus) {
    $query .= " AND état = ?";
    $params[] = $filterStatus;
    $types .= "s";
}

$stmt = $conn->prepare($query);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();
$equipements = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Fetch reservations
$reservations = $conn->query("SELECT * FROM Reservation")->fetch_all(MYSQLI_ASSOC);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Technicien - Manage Equipments and Reservations</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <header>
        <h1>Technicien Dashboard</h1>
    </header>

    <section>
        <h2>Manage Equipments</h2>
        <form method="POST">
            <input type="hidden" name="id" id="id">
            <input type="text" name="nom" placeholder="Name" required>
            <textarea name="description" placeholder="Description" required></textarea>
            <input type="text" name="categorie" placeholder="Category" required>
            <select name="etat" required>
                <option value="disponible">Available</option>
                <option value="hors_service">Out of Service</option>
                <option value="en_reparation">Under Repair</option>
            </select>
            <input type="number" name="quantite" placeholder="Quantity" required>
            <button type="submit" name="add_materiel">Add</button>
            <button type="submit" name="update_materiel">Update</button>
            <button type="submit" name="delete_materiel">Delete</button>
        </form>

        <h3>Equipment List</h3>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>
                    Category
                    <form method="GET" style="display:inline;">
                        <select name="filter_category" onchange="this.form.submit()">
                            <option value="">All</option>
                            <option value="Serveur" <?= $filterCategory === "Serveur" ? "selected" : "" ?>>Serveur</option>
                            <option value="Onduleur" <?= $filterCategory === "Onduleur" ? "selected" : "" ?>>Onduleur</option>
                            <option value="Carte Graphique" <?= $filterCategory === "Carte Graphique" ? "selected" : "" ?>>Carte Graphique</option>
                            <!-- Add more categories as needed -->
                        </select>
                    </form>
                </th>
                <th>
                    Status
                    <form method="GET" style="display:inline;">
                        <select name="filter_status" onchange="this.form.submit()">
                            <option value="">All</option>
                            <option value="disponible" <?= $filterStatus === "disponible" ? "selected" : "" ?>>Available</option>
                            <option value="hors_service" <?= $filterStatus === "hors_service" ? "selected" : "" ?>>Out of Service</option>
                            <option value="en_reparation" <?= $filterStatus === "en_reparation" ? "selected" : "" ?>>Under Repair</option>
                        </select>
                    </form>
                </th>
                <th>Quantity</th>
            </tr>
            <?php foreach ($equipements as $equipement): ?>
                <tr>
                    <td><?= $equipement['id_equipement'] ?></td>
                    <td><?= $equipement['nom'] ?></td>
                    <td><?= $equipement['description'] ?></td>
                    <td><?= $equipement['catégorie'] ?></td>
                    <td><?= $equipement['état'] ?></td>
                    <td><?= $equipement['quantite_dispo'] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </section>

    <section>
        <h2>Manage Reservations</h2>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
            </tr>
            <?php foreach ($reservations as $reservation): ?>
                <tr>
                    <td><?= $reservation['id_reservation'] ?></td>
                    <td><?= $reservation['id_utilisateur'] ?></td>
                    <td><?= $reservation['date_debut'] ?></td>
                    <td><?= $reservation['date_fin'] ?></td>
                    <td><?= $reservation['statut'] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </section>
</body>
</html>