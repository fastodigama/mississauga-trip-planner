<?php
// Include database connection and helper functions
require("connect.php");
require("functions.php");

// Get trip_id and trip_headsign from the query parameters
$trip_id = $_GET['trip_id'] ?? null;
$trip_headsign = $_GET["trip_headsign"] ?? null;

// Check if trip_id is provided, if not stop execution
if (!$trip_id) {
    echo "No trip ID provided.";
    exit;
}
// Retrieve stop information for the given trip
$stops = getTripStops($connect, $trip_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Trip Stops</title>
    <link rel="stylesheet" href="style.css">

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
</head>
<body>
<!-- Header with site navigation -->
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

    <main id="main-stops">
         <section id="main-section">
            <!-- Heading shows the trip headsign -->
        <h2>Stops for Trip: <?php echo $trip_headsign; ?></h2>

        <?php if (mysqli_num_rows($stops) > 0): ?>
            <!-- Container for both table and map side by side -->
            <div class="trip-info-container">
                <!-- Table on the left -->
                 <div class="trip-table">
                     <table>
                <thead>
                    <tr>
                        <th>Stop Sequence</th>
                        <th>Stop Name</th>
                        <th>Arrival Time</th>
                        <th>Departure Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Reset pointer and loop through the stop results
                    mysqli_data_seek($stops, 0);
                    while ($row = mysqli_fetch_assoc($stops)) :
                    ?>
                        <tr>
                            <td><?php echo $row['stop_sequence']; ?></td>
                            <td><?php echo $row['stop_name']; ?></td>
                            <td><?php echo $row['arrival_time']; ?></td>
                            <td><?php echo $row['departure_time']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>


                 </div>
                 <!-- map on the right -->
                  <div id="map" style="height: 400px;"></div>
            </div>
           
                        

            <!-- Leaflet JS for map functionality -->
            <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
            
            <!-- Leaflet JS (Source: https://leafletjs.com - CDN from unpkg) -->
            <script>
                var stops = [
                    <?php
                      // Prepare a JavaScript array of stops with coordinates
                    mysqli_data_seek($stops, 0); // Reset pointer again for map
                    while ($row = mysqli_fetch_assoc($stops)) {
                        if (!empty($row['stop_lat']) && !empty($row['stop_lon'])) {
                            echo "{lat: {$row['stop_lat']}, lon: {$row['stop_lon']}, name: '" . addslashes($row['stop_name']) . "'},\n";
                        }
                    }
                    ?>
                ];
                    // If we have valid coordinates, initialize the map
                if (stops.length > 0) {
                    var map = L.map('map').setView([stops[0].lat, stops[0].lon], 13);
                    // Add base tile layer from OpenStreetMap
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors'
                    }).addTo(map);
                    // Add markers for each stop
                    stops.forEach(function(stop) {
                        L.marker([stop.lat, stop.lon]).addTo(map)
                            .bindPopup(stop.name);
                    });
                } else {

                    // Message shown if no stops found 
                    document.getElementById('map').innerHTML = '<p style="color:red;">Map could not be displayed: No coordinates available.</p>';
                }
            </script>

        <?php else: ?>
            <p style="color:red;">No stops found for this trip.</p>
        <?php endif; ?>

        <p><a  href="javascript:history.back()">← Back</a></p>
        </section>
    </main>
</body>
</html>
  