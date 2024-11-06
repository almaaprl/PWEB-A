<!DOCTYPE html>
<html>

<head>
    <title>ETS</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div class="navbar">
        <div class="logo">
            <a href="index.php">S<span>MDP.</span></a>
        </div>

        <ul class="nav-links">
            <li><a href="index.php" class="active">Home</a></li>
            <li><a href="read.php">Data</a></li>
            <li><a href="insert.php">Add Data</a></li>
            <a class="logout-btn" href="../index.html">Logout</a>
        </ul>

    </div>

    <script>
        function toggleNavbar() {
            var navbar = document.getElementById("navbar");
            if (navbar.className === "navbar") {
                navbar.className += " responsive";
            } else {
                navbar.className = "navbar";
            }
        }
    </script>
</body>

</html>
