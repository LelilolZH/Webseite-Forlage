<?php
    include($_SERVER["DOCUMENT_ROOT"]."/php/functions.php");
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <?php
        server_include_force($_SERVER["DOCUMENT_ROOT"]."/meta/meta.php");
    ?>
    <title><?php echo MainTitle; ?></title>
    <link rel="shortcut icon" href="<?php echo generate_Link("/img/logo.svg"); ?>" type="image/svg+xml">
    <link rel="stylesheet" type="text/css" href="<?php echo generate_Link("/css/main.css"); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo generate_Link("/css/mobile.css"); ?>" media="only screen and (max-width: 800px)" >
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Overpass:wght@600&display=swap" rel="stylesheet">  
</head>
<body style="display:none;opacity:0;">
    <div class="app-outher">
        <div class="app-nav-outher">
            <div class="app-nav">
                Navigation here
            </div>
        </div>
        <div class="app-main">
            Main content here
        </div>
    </div>
    <script src="<?php echo generate_Link("/js/main.js"); ?>"></script>
    <script src="<?php echo generate_Link("/js/frame.js"); ?>"></script>
</body>
</html>