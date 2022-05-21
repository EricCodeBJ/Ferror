<?php
$basename = "http://" . $_SERVER["HTTP_HOST"] . str_replace($_SERVER['DOCUMENT_ROOT'], '', __DIR__);

$filename = $data["errorFile"];
$fileNameOnLine = $filename . ":" . $data["errorLine"];

// File name and Error line concatenation without exceeding 25 character
if (strlen($fileNameOnLine) >= 25) {
    $fileNameOnLine =  "..." . substr($filename, strlen($filename) - (21 - strlen($data["errorLine"])), strlen($filename) - 1) . ":" . $data["errorLine"];
}

// Get file content around the error
$fileContent = "";
$handle = fopen($data["errorFile"], "r");
$fileOffset = -1;
if ($handle) {
    $currentLine = 1;
    while (($line = fgets($handle)) !== false) {
        if ($currentLine >= intval($data["errorLine"]) - 15 && $currentLine <= intval($data["errorLine"]) + 15) {
            $fileOffset = $fileOffset == -1 ? $currentLine : $fileOffset;
            $fileContent .= $line;
        }
        $currentLine++;
    }
    fclose($handle);
} else {
    $fileOffset = 0;
}

// Get Globals to Menu => data
$globalMenus = "";
$globalDatas = "";
foreach ($GLOBALS as $key => $values) {
    $globalMenus .= "<li data-target-global='$key'>$$key</li>";
    $globalDatas .= '<div data-globals="' . $key . '" class="codeBlock invisible"> <pre data-enlighter-language="json"  data-enlighter-indent="2" data-enlighter-theme="bootstrap4">' . json_encode($values, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</pre></div>';
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="<?php echo $basename; ?>" target="_blank">
    <style>
        :root {
            --eerie-black: #272848;
            --battleship-grey: #898C8Aff;
            --gainsboro: #DFE0E0ff;
            --gray2: #ebecf0;
            --cultured: #F4F5F7ff;
            --white: #FEFEFEff;
            --black: #010101ff;
            --black-2: #121c42;
            --royal-blue-light: #575beb;
            --active: #FFFFFF;
            --burnt-orange: #BE5317ff;
            --tart-orange: #ff695d;
            --shadow: #d8e1e8;
        }


        :root {
            --font-black: "black";
            --font-bold: "bold";
            --font-extrabold: "extrabold";
            --font-light: "light";
            --font-extralight: "extralight";
            --font-medium: "medium";
            --font-regular: "regular";
            --font-semibold: "semibold";
            --font-thin: "thin";
        }


        @font-face {
            font-family: "black";
            src: url("layout/assets/font/inter/black.ttf");
        }

        @font-face {
            font-family: "bold";
            src: url("layout/assets/font/inter/interbold.ttf");
        }

        @font-face {
            font-family: "extrabold";
            src: url("layout/assets/font/inter/interextrabold.ttf");
        }

        @font-face {
            font-family: "light";
            src: url("layout/assets/font/inter/interlight.ttf");
        }

        @font-face {
            font-family: "extralight";
            src: url("layout/assets/font/inter/interextralight.ttf");
        }

        @font-face {
            font-family: "medium";
            src: url("layout/assets/font/inter/intermedium.ttf") format("truetype");
        }

        @font-face {
            font-family: "regular";
            src: url("layout/assets/font/inter/interregular.ttf") format("truetype");
        }

        @font-face {
            font-family: "semibold";
            src: url("layout/assets/font/inter/intersemibold.ttf");
        }

        @font-face {
            font-family: "thin";
            src: url("layout/assets/font/inter/interthin.ttf");
        }


        body {
            width: 90%;
            margin: 10px auto;
            overflow-x: hidden;
            font-size: 1rem;
            font-family: var(--font-regular);
        }

        .theme-light {
            background: var(--cultured);
            color: var(--black-2);
        }

        .theme-night {
            background: var(--black);
            color: var(--white);
        }

        .text-red {
            color: var(--tart-orange);
        }

        .clickable {
            text-decoration: underline;
            cursor: pointer;
        }

        ul {
            list-style: none;
            margin: 0px;
            padding: 0px;
        }

        .btn-error {
            background-color: var(--tart-orange);
        }

        .invisible {
            display: none;
        }

        .visible {
            display: block;
        }

        /* Top Alert */
        .top-alert {
            display: flex;
            align-items: center;
            background-color: var(--eerie-black);
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
            padding: 12px;
            color: white;
            margin-bottom: 0px;
            font-family: var(--font-semibold);
        }

        .top-alert img {
            width: 20px;
            margin-right: 7px
        }


        /* Table error description */
        .table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            background: var(--white);
            border-radius: 5px;
            overflow: hidden;
            margin-bottom: 20px;
        }

        tr,
        th,
        td {
            padding: 12px;
            margin: 0;
        }

        .tableDesciption th {
            font-family: var(--font-thin);
            white-space: nowrap;
            min-width: 100px;
            max-width: 150px;
        }

        .tableDesciption td {
            font-family: var(--font-medium);
            font-size: 1rem;
        }


        /* Table of Content */
        .tableContent {
            display: flex;
        }

        .tableContent .menu {
            font-family: var(--font-regular);
            font-size: 1rem;
            white-space: nowrap;
            width: fit-content;
            width: 275px;
            background-color: var(--gray2);
        }

        .tableContent .menu ul li {
            padding: 15px;
            font-family: var(--font-regular);
            opacity: .7;
            cursor: pointer;
        }

        .content {
            width: inherit;
        }

        .active {
            background: var(--active);
            font-family: var(--font-medium) !important;
            opacity: 1 !important;
            position: relative;
            color: var(--royal-blue-light);
        }

        .active::before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            width: 5px;
            height: 48px;
            background-color: var(--royal-blue-light);
        }

        .btn {
            padding: 5px;
            border-radius: 5px;
            color: white;
        }

        .btn-exception {
            background-color: var(--burnt-orange);
        }
    </style>
    <style>
        .table {
            background: var(--white);
            box-shadow: 0 2px 8px var(--shadow);
            border: 1px solid var(--gainsboro);
        }

        tr,
        th,
        td,
        .tableContent .menu {
            border: 1px solid var(--gainsboro);
        }
    </style>

    <link rel="stylesheet" href="layout/assets/libs/Enlighterjs/css/enlighterjs.min.css" />
</head>

<body class="theme-light">

    <!-- Top Alert -->
    <p class="top-alert alert-error">
        <img src="layout/assets/icons/alert-circle.svg" alt="icon" />
        <span>PHP: [<?php echo $data["errorType"]; ?>] has occurred</span>
    </p>

    <!-- Table of error ddescription -->
    <table style="border-top-left-radius: 0px; border-top-right-radius: 0px" class="table tableDesciption">
        <tr>
            <th>Type</th>
            <td><span class="btn btn-error"><?php echo $data["errorType"]; ?></span></td>
        </tr>
        <tr>
            <th>Message</th>
            <td style="text-decoration: none; color:red"><?php echo $data["errorMessage"]; ?></td>
        </tr>
        <tr>
            <th>File</th>
            <td class="clickable" style="color:blue; cursor: default"><?php echo $data["errorFile"]; ?></a></td>
        </tr>

    </table>

    <!-- Table of contents -->
    <div class="table tableContent">
        <div class="menu">
            <ul>
                <li data-target-global='errorFile' class="active"><?php echo $fileNameOnLine; ?></li>
                <?php echo $globalMenus; ?>
            </ul>
        </div>
        <div class="content">
            <!-- Code to hghlight !-->
            <div class="codeBlock visible" data-globals="errorFile">
                <pre data-enlighter-language="php" data-enlighter-lineoffset="<?php echo $fileOffset; ?>" data-enlighter-indent="2" data-enlighter-theme="bootstrap4" data-enlighter-highlight="<?php echo $data["errorLine"]; ?>"><?php echo htmlentities($fileContent); ?></pre>
            </div>
            <?php echo $globalDatas; ?>
        </div>

    </div>

    <script src="<?php echo $basename; ?>/assets/js/script.js"></script>
    <script type="text/javascript" src="<?php echo $basename; ?>/assets/libs/Enlighterjs/js/enlighterjs.min.js"></script>
    <script type="text/javascript">
        EnlighterJS.init('pre', 'code');
    </script>
    <script type="text/javascript">
        window.addEventListener("load", () => {
            let menuItem = document.querySelectorAll(".menu ul li");
            let codeBlocks = document.querySelectorAll(".codeBlock");

            menuItem.forEach((list) => {
                list.addEventListener("click", () => {
                    // Unactive all element before procedd
                    menuItem.forEach((element) => {
                        element.classList.remove("active");
                    });
                    // hide All element
                    codeBlocks.forEach((codeBlock) => {
                        codeBlock.classList.replace("visible", "invisible");
                    })

                    // Active target menu
                    list.classList.add("active");
                    // load target Data;
                    let el = document.querySelector(".codeBlock[data-globals='" + list.dataset.targetGlobal + "']");
                    console.log(el);
                    el.classList.replace("invisible", "visible");
                })
            });
        })
    </script>
</body>

</html>