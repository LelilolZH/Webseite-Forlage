<?php
    include($_SERVER["DOCUMENT_ROOT"]."/php/functions.php");
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <title><?php echo MainTitle; ?></title>
    <link rel="shortcut icon" href="<?php echo generate_Link("/img/logo.png"); ?>" type="image/png">
    <?php
        server_include_force($_SERVER["DOCUMENT_ROOT"]."/meta/meta.php");
    ?>
    <link rel="stylesheet" type="text/css" href="<?php echo generate_Link("/css/main.css"); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo generate_Link("/css/mobile.css"); ?>" media="only screen and (max-width: 800px)" >
    <?php
        //add here new css or js
    ?>
</head>
<body style="display:none;opacity:0;">
    <div class="app-outher">
        <div class="app-nav-outher">
            <div class="app-nav app-loader" data-src="<?php echo generate_Link("/ajax/modules/navigation.php"); ?>">
                <!-- Navigation will be here -->
            </div>
        </div>
        <div class="app-main app-loader">
            <!-- Redirect will be here -->
        </div>
    </div>
    <script type="text/javascript" src="<?php echo generate_Link("/js/main.php"); ?>"></script>
    <script type="text/javascript" src="<?php echo generate_Link("/js/settings.js"); ?>"></script>
    <script type="text/javascript" src="<?php echo generate_Link("/js/frame.php"); ?>"></script>
</body>
</html>