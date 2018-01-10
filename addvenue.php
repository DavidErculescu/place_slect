<?php
include "functions.php";
$venue['name'] = $_POST['venue_name'] ?? null;
$venue['foods'] = $_POST['venue_foods'] ?? null;
$venue['drinks'] = $_POST['venue_drinks'] ?? null;

if ($venue['name'] != null && $venue['foods'] != null && $venue['drinks'] != null) {
    add_venue($_GET['tkid'], $venue);
}
?>