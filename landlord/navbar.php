<nav class="navbar">
  <div class="logo">My Dashboard</div>
  <div class="menu-toggle" id="menu-toggle">☰</div>
  <div class="nav-links" id="nav-links">
    <a href="index.php">Dashboard</a>
    <a href="add-property.php">Add Property</a>
    <a href="manage-property.php">Manage Properties</a>
    <a href="bookings.php">Bookings</a>
    <a href="edit-profile.php">Edit Profile</a>
    <a href="logout.php" class="logout">Logout</a>
  </div>
</nav>

<style>
/* Navbar Styling */
.navbar {
    background-color: rgb(244, 198, 113);
    padding: 10px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
}

.navbar .logo {
    font-size: 20px;
    font-weight: bold;
    color: white;
}

.navbar .menu-toggle {
    display: none;
    font-size: 24px;
    color: white;
    cursor: pointer;
}

.nav-links {
    display: flex;
    gap: 20px;
}

.nav-links a {
    color: white;
    text-decoration: none;
    font-weight: bold;
    font-size: 16px;
    transition: background-color 0.3s, color 0.3s;
    padding: 8px 12px;
    border-radius: 5px;
}

.nav-links a:hover {
    background-color:rgb(0, 0, 0);
    color: white;
}

.nav-links a.logout {
    background-color: #ff4d4d;
}

.nav-links a.logout:hover {
    background-color: #e60000;
}

/* Responsive CSS */
@media (max-width: 768px) {
    .menu-toggle {
        display: block;
    }
    .nav-links {
        width: 100%;
        flex-direction: column;
        display: none;
    }
    .nav-links.active {
        display: flex;
    }
}
</style>

<script>
// Toggle menu in mobile
document.getElementById('menu-toggle').addEventListener('click', function() {
    document.getElementById('nav-links').classList.toggle('active');
});
</script>
