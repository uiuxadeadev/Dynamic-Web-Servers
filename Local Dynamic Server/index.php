<?php $planet = isset($_GET['planet']) ? $_GET['planet'] : 'Earth' ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Hello, World!</title>
    </head>
    <body>
        <h1>Hello, <?php echo $planet;?></h1>
        <p>This is a simple "Hello, <?php echo $planet;?>!" HTML page.</p>

        <footer>
            <p><?php echo sprintf("%s Rocks©  Website %s. All rights reserved.", $planet, date("Y")); ?></p>
        </footer>
    </body>
</html>