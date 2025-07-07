<?php
// Include database connection and helper functions
require("connect.php");
require("functions.php");

// Get the route ID from the query string
$route_id = $_GET['id'];

// Fetch trips and route info from the database using helper functions
$trips = getTripTimes($connect, $route_id);
$route = getRouteInfo($connect, $route_id);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Route Details</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
     <!-- Page Header and Navigation -->
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
<!-- Main Content Section -->
<main id="main-content">
    <section id="main-section">
        <h1>Route Details</h1>
        <?php
        // Fetch the first trip to check if there are any trips for this route
        $firstTrip = mysqli_fetch_assoc($trips);
        ?>
       <?php if ($firstTrip): ?>
         <!-- Display route short name and long name -->
            <h2>Route <?= $route['route_short_name'] ?? 'Unknown' ?>: <?= $route['route_long_name'] ?? '' ?></h2>
        <?php else: ?>
             <!-- Message shown if no trips are found for the route -->
            <p style="color:red;">No trips found for this route.</p>
        <?php endif; ?>


             <!-- Table showing trips related to this route -->
        <h3>Trips for this Route</h3>
            <table>
                <thead>
                    <tr>
                    <th>Direction Headsign</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>View</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($trips)) : ?>
                    <tr>
                         <!-- Display trip information -->
                        <td><?php echo $row['trip_headsign']; ?></td>
                        <td><?php echo $row['start_time']; ?></td>
                        <td><?php echo $row['end_time']; ?></td>
                        <!-- Link to view trip stops, passing trip_id and trip_headsign in the URL -->
                        <td><a href="trip_stops.php?trip_id=<?php echo $row['trip_id']; ?> &trip_headsign=<?php echo $row['trip_headsign']; ?>">View</a></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
                </table>





    </section>


</main>
</body>
</html>