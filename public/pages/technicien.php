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
$filter = isset($_GET['filter']) ? $_GET['filter'] : '';
$query = "SELECT * FROM Equipement";
if ($filter) {
    $query .= " WHERE catégorie = ?";
}
$stmt = $conn->prepare($query);
if ($filter) {
    $stmt->bind_param("s", $filter);
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
        <form method="GET">
            <select name="filter">
                <option value="">All Categories</option>
                <option value="Serveur">Serveur</option>
                <option value="Onduleur">Onduleur</option>
                <option value="Carte Graphique">Carte Graphique</option>
                <!-- Add more categories as needed -->
            </select>
            <button type="submit">Filter</button>
        </form>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Category</th>
                <th>Status</th>
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