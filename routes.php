<?php
// Include the database connection and helper functions
require("connect.php");
require("functions.php");

// Fetch all routes from the database
$routes = getAllRoutes($connect);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiWay Routes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
     <!-- Page Header with Site Name and Navigation -->
    <header id="header">
        <h2 id="site-name">
            <a href="index.php">Mississauga Trip Planner</a>
        </h2>
        <nav id="main-nav" aria-label ="Main Navigation">
            <ul class="inline-menu">
                <li><a href="index.php">Homepage</a></li>
                <li><a href="routes.php"> View All Routes</a></li>
                
                <li><a href="about.php">About</a></li>
            </ul>

        </nav>
</header>
<!-- Main content of the page -->
<main id="main-content">
    <section id="main-section">
         <!-- Page heading -->
        <h1> Select a route for details </h1>

        <!-- Table to display all available routes -->
        <table>
            <thead>
                <tr>
                    <th>Route Number</th>
                    <th>Route Name</th>
                </tr>
                <tbody>
                    <?php 
                     // Loop through each route and create a table row with route info
                    while ($route = mysqli_fetch_assoc($routes)){
                        echo "<tr>";
                        // Route short name (number) links to the route details page
                        echo "<td> <a href='routedetails.php?id=" . $route['route_id'] ."'>" . $route['route_short_name'] . "</a></td>";
                         // Route long name also links to the same details page
                        echo "<td> <a href='routedetails.php?id=" . $route['route_id'] ."'>" . $route['route_long_name'] . "</td>";
                        echo "</a></tr>";
                    } 
                    ?>
            </tbody>
      </table>
    </section>
  </main>
</body>
</html>
