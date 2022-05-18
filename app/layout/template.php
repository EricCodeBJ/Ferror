<?php ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/style_light.css">
    <link rel="stylesheet" href="../assets/libs/Enlighterjs/css/enlighterjs.min.css" />
</head>

<body class="theme-light">

    <!-- Top Alert -->
    <p class="top-alert alert-error">
        <img src="../assets/icons/alert-circle.svg" alt="icon" />
        <span>PHP: [Warning] has occurred</span>
    </p>

    <!-- Table of error ddescription -->
    <table style="border-top-left-radius: 0px; border-top-right-radius: 0px" class="table tableDesciption">
        <tr>
            <th>Message</th>
            <td class="text-red clickable">Undefined array key 1, eos omnis quam doloremque!</td>
        </tr>
        <tr>
            <th>Fichier</th>
            <td><a href="Users\CEDRIC\Desktop\Tp PHP\Exception\sample\index.php" target="_blank">Users\CEDRIC\Desktop\Tp PHP\Exception\sample\index.php</a></td>
        </tr>
        <tr>
            <th>Ligne N°</th>
            <td>122</td>
        </tr>
        <tr>
            <th>Code d'erreur</th>
            <td>404</td>
        </tr>
        <tr>
            <th>Type</th>
            <td><span class="btn btn-error">FATAL</span></td>
        </tr>
    </table>

    <!-- Table of contents -->
    <div class="table tableContent">
        <div class="menu">
            <ul>
                <li class="active">index.php:40</li>
                <li>$_GET</li>
                <li>$_POST</li>
                <li>$_FILES</li>
                <li>$_SERVER</li>
                <li>$_SESSION</li>
                <li>$_REQUEST</li>
                <li>$GLOBALS</li>
                <li>$_ENV</li>

            </ul>
        </div>
        <div class="content">
            <!-- Code to hghlight !-->
            <pre data-enlighter-language="json" data-enlighter-indent="2" data-enlighter-theme="bootstrap4" data-enlighter-highlight="1">
                    {
                        "glossary": {
                            "title": "example glossary",
                            "GlossDiv": {
                                "GlossList": {
                                    "GlossEntry": {
                                        "ID": "SGML",
                                        "Acronym": "SGML",
                                        "GlossDef": {
                                            "para": "A meta-markup language, used to create markup languages such as DocBook.",
                                        },
                                        "GlossSee": "markup"
                                    }
                                }
                            }
                        }
                    }
                </pre>
        </div>

        <script src="../assets/js/script.js"></script>
        <script type="text/javascript" src="../assets/libs/Enlighterjs/js/enlighterjs.min.js"></script>
        <script type="text/javascript">
            EnlighterJS.init('pre', 'code');
        </script>
</body>

</html>