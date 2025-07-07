<?php

// Function: Get all transit routes
// Returns all rows from the 'routes' table
function getAllRoutes($connect){
    $query = "SELECT * from routes";
    return mysqli_query($connect, $query);
}
// Function: Get trip times for a specific route
// Parameters: database connection, route ID, optional limit (default 10)
// Returns trip_id, headsign, start and end times for each trip on that route
function getTripTimes($connect, $route_id, $limit = 10) {
    $query = "
    SELECT 
        t.trip_id,
        t.trip_headsign,
        MIN(st.departure_time) AS start_time,
        MAX(st.arrival_time) AS end_time
        FROM trips t
        INNER JOIN stop_times st ON t.trip_id = st.trip_id
        WHERE t.route_id = $route_id
        GROUP BY t.trip_id, t.trip_headsign
        ORDER BY start_time
        LIMIT $limit
        ";

    return mysqli_query($connect, $query);
}
// Function: Get details about a single route
// Parameters: database connection, route ID
// Returns a single associative array with route info
function getRouteInfo($connect, $route_id) {
    $query = "SELECT * FROM routes WHERE route_id = $route_id";
    $result = mysqli_query($connect, $query);
    return mysqli_fetch_assoc($result);
}

// Function: Get all stops for a specific trip
// Parameters: database connection, trip ID
// Returns the stop sequence, names, times, and coordinates
function getTripStops($connect, $trip_id) {
    $trip_id = (int)$trip_id;
    $query = "
        SELECT 
            st.stop_sequence,
            s.stop_name,
            st.arrival_time,
            st.departure_time,
            s.stop_lat,
            s.stop_lon
        FROM stop_times st
        INNER JOIN stops s ON st.stop_id = s.stop_id
        WHERE st.trip_id = $trip_id
        ORDER BY st.stop_sequence
    ";
    return mysqli_query($connect, $query);
}



?>
