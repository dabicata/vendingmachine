<?php if (isset($_SESSION['validValues']['validDesc']) || isset($_SESSION['invalidValues']['invalidDesc'])) {
    if (isset($_SESSION['validValues']['validDesc'])) {
        echo $_SESSION['validValues']['validDesc'];
    } else {
        echo $_SESSION['invalidValues']['invalidDesc'];
    }
} ?>