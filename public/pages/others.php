<!-- filepath: /Users/es_tk_/Library/Mobile Documents/com~apple~CloudDocs/Bibi/FS/3A/Projet/Annexe/Code/public/pages/dashboard.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - GP Digital Solutions</title>
  <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
  <header class="sticky-header">
    <div class="nav-container">
      <div class="logo">GP<span>.</span></div>
      <nav>
        <ul class="nav-links">
          <li><a href="index.html">Home</a></li>
          <li><a href="dashboard.php" class="active">Dashboard</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <section class="dashboard-section">
    <h1>Dashboard</h1>
    <?php
      // Database connection
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "gestion_materiel";

      $conn = new mysqli($servername, $username, $password, $dbname);

      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      // Fetch and display Utilisateur data
      echo "<h2>Users</h2>";
      $result = $conn->query("SELECT * FROM Utilisateur");
      if ($result->num_rows > 0) {
        echo "<table border='1'><tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th><th>Registration Date</th></tr>";
        while ($row = $result->fetch_assoc()) {
          echo "<tr><td>{$row['id_utilisateur']}</td><td>{$row['nom']} {$row['prenom']}</td><td>{$row['email']}</td><td>{$row['rôle']}</td><td>{$row['date_inscription']}</td></tr>";
        }
        echo "</table>";
      } else {
        echo "<p>No users found.</p>";
      }

      // Fetch and display Equipement data
      echo "<h2>Equipment</h2>";
      $result = $conn->query("SELECT * FROM Equipement");
      if ($result->num_rows > 0) {
        echo "<table border='1'><tr><th>ID</th><th>Name</th><th>Description</th><th>Category</th><th>Status</th><th>Quantity</th></tr>";
        while ($row = $result->fetch_assoc()) {
          echo "<tr><td>{$row['id_equipement']}</td><td>{$row['nom']}</td><td>{$row['description']}</td><td>{$row['catégorie']}</td><td>{$row['état']}</td><td>{$row['quantite_dispo']}</td></tr>";
        }
        echo "</table>";
      } else {
        echo "<p>No equipment found.</p>";
      }

      // Fetch and display Notification data
      echo "<h2>Notifications</h2>";
      $result = $conn->query("SELECT * FROM Notification");
      if ($result->num_rows > 0) {
        echo "<table border='1'><tr><th>ID</th><th>User ID</th><th>Type</th><th>Message</th><th>Date Sent</th></tr>";
        while ($row = $result->fetch_assoc()) {
          echo "<tr><td>{$row['id_notification']}</td><td>{$row['id_utilisateur']}</td><td>{$row['type']}</td><td>{$row['message']}</td><td>{$row['date_envoi']}</td></tr>";
        }
        echo "</table>";
      } else {
        echo "<p>No notifications found.</p>";
      }

      // Fetch and display Reservation data
      echo "<h2>Reservations</h2>";
      $result = $conn->query("SELECT * FROM Reservation");
      if ($result->num_rows > 0) {
        echo "<table border='1'><tr><th>ID</th><th>User ID</th><th>Start Date</th><th>End Date</th><th>Status</th></tr>";
        while ($row = $result->fetch_assoc()) {
          echo "<tr><td>{$row['id_reservation']}</td><td>{$row['id_utilisateur']}</td><td>{$row['date_debut']}</td><td>{$row['date_fin']}</td><td>{$row['statut']}</td></tr>";
        }
        echo "</table>";
      } else {
        echo "<p>No reservations found.</p>";
      }

      $conn->close();
    ?>
  </section>

  <footer>
    <p>&copy; 2025 GP Digital Solutions. All rights reserved.</p>
  </footer>
</body>
</html>