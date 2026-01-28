<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - DayNight Admin</title>
    <script>
        // Prevent flash of white in dark mode - runs before CSS/page render
        if (localStorage.getItem('daynight-theme') === 'carbon') {
            document.documentElement.classList.add('carbon');
        }
    </script>
    <link rel="stylesheet" href="templatemo-daynight-style.css">
    <!--

TemplateMo 608 DayNight Admin

https://templatemo.com/tm-608-daynight-admin

-->
</head>