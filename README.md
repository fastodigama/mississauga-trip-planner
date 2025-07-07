# 🚌 Mississauga Trip Planner

A PHP and MySQL web application that displays public transit routes, trips, and stops for MiWay (Mississauga's transit system). The application uses GTFS data and displays stops on an interactive map with Leaflet.js.

## 📦 Features

- View a list of all available transit routes.
- Click a route to view its trips and trip times.
- View stops for a specific trip, including:
  - Stop sequence
  - Arrival and departure times
  - Map display of all stop locations

## 🛠️ Technologies Used

- PHP 8.x
- MySQL (GTFS schema)
- HTML5 / CSS3
- JavaScript
- [Leaflet.js](https://leafletjs.com) (for map rendering)
- Google Fonts – Urbanist
- GTFS Data Format

## 🗂️ Project Structure

```text
.
├── index.php               # Homepage
├── routes.php             # Displays all routes
├── routedetails.php       # Displays trips for a selected route
├── trip_stops.php         # Shows stops for a selected trip + map
├── about.php              # About page
├── css/
│   └── style.css          # Main stylesheet
├── connect.php            # DB connection
├── functions.php          # All helper SQL functions
├── README.md              # This file

## Local DEvelopment Setup
git clone https://github.com/fastodigama/mississauga-trip-planner.git
cd mississauga-trip-planner
Import the GTFS database:

Use phpMyAdmin or MySQL CLI to import your miway_general_transit.sql dump.

Update database credentials in connect.php:
$connect = mysqli_connect('localhost', 'root', 'your_password', 'miway_general_transit');
Run it locally with [MAMP/XAMPP/LAMP].

Visit:

http://localhost/mississauga-trip-planner/index.php

## 🗺️ Map Source
Leaflet CDN:
<!-- Source: https://leafletjs.com -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

## 📋 License
This project is for educational purposes only and not affiliated with MiWay or the City of Mississauga.