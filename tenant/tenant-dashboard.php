<?php
include './php/db.php'; // database connection
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tenant Dashboard - Shri Nivas</title>
    <link rel="stylesheet" href="tenant.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Shri Nivas</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="../Login-form/logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5">
    <h2>Welcome, Tenant!</h2>

    <h4 class="mt-4 mb-3">Available Properties</h4>
    <div class="row">
        <?php
        $query = "SELECT p.*, d.property_name, d.bedroom_image 
                  FROM properti p 
                  JOIN properties d ON p.id = d.id 
                  WHERE p.is_available = 1";
        $result = mysqli_query($conn, $query);

        while($row = mysqli_fetch_assoc($result)) {
            echo '<div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100">
                        <img src="../' . $row['bedroom_image'] . '" class="card-img-top" alt="Property Image" style="height:200px; object-fit:cover;">
                        <div class="card-body">
                            <h5 class="card-title">' . $row['property_name'] . '</h5>
                            <p class="card-text">
                                ₹' . $row['rent'] . '/month<br>
                            </p>
                            <a href="view-property.php?id=' . $row['id'] . '" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                  </div>';
        }
        ?>
    </div>
</div>

</body>
</html>
