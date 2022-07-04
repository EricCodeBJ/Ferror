<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="<?php echo $data["extra"]["basename"]; ?>">
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="assets/libs/Enlighterjs/css/enlighterjs.min.css" />
    <link ref="icon" href="assets/icons/logoFerror.png" />
    <title>Ferror | <?php echo $data["errorType"] . " " . $data["errorMessage"]; ?></title>
</head>

<body class="theme-light">
    <!-- Table of error: Header -->
    <p class="top-alert alert-error">
        <img src="assets/icons/alert-circle.svg" alt="icon" />
        <span>PHP: [<?php echo $data["errorType"]; ?>] has occurred</span>
    </p>

    <!-- Table of error: Description -->
    <table style="border-top-left-radius: 0px; border-top-right-radius: 0px" class="table tableDesciption">
        <tr>
            <th>Type</th>
            <td>
                <span class="btn btn-error"><?php echo $data["errorType"]; ?></span>
            </td>
        </tr>
        <tr>
            <th>Code</th>
            <td style="color:red">
                <?php echo $data["errorCode"]; ?>
            </td>
        </tr>
        <tr class="table-row-message">
            <th>Message</th>
            <td style="text-decoration: none; color:red; font-size: 1.2rem;">
                <div style="padding-right:37px">
                    <span><?php echo $data["errorMessage"]; ?></span>
                    <!-- This textarea is used to help me copy the error code 
                            He has no utility in the front, why i have hidden this -->
                    <textarea id="errorMessage" style="opacity: 0; width: 0; height: 0">
                            <?php echo "PHP " . $data["errorType"] . " " . $data["errorMessage"]; ?>
                        </textarea>
                </div>
                <div class="iconBloc">
                    <img src="assets/icons/copy-icon.png" alt="copy-icon" title="copy">
                    <span id="copySpan">copy</span>
                </div>
            </td>
        </tr>
        <tr>
            <th>File</th>
            <td class="clickable" style="color:blue; cursor: default"><a href="javascript:void(0);"><?php echo $data["errorFile"]; ?></a></td>
        </tr>
        <tr>
            <th>Line</th>
            <td style="color:red"><?php echo $data["errorLine"]; ?></td>
        </tr>
    </table>

    <!-- Table of data: Glbobals, data... -->
    <div class="table tableContent">
        <div class="menu">
            <ul>
                <div class="menuSubTitle activeTitleMenu">
                    <li data-target-global='errorFile' class="active"> <b>File </b> <br /> <span class="menuSubSubTitle"><?php echo $data["extra"]["fileNameOnLine"]; ?></span></li>
                </div>
                <div class="menuSubTitle">
                    <li data-target-global='all-variables'> <b>Variables </b> <br /> <span class="menuSubSubTitle"><?php echo $data["extra"]["gblobalUserMenuVariables"]; ?></span></li>
                </div>
                <div class="menuSubTitle">
                    <li data-target-global='all-constantes'> <b>Constantes </b> <br /> <span class="menuSubSubTitle"><?php echo $data["extra"]["gblobalUserMenuConstantes"]; ?></span></li>
                </div>
                <div class="menuSubTitle mneuGlobales">
                    <p id="globalParagraphe">Globals</p>
                    <?php echo $data["extra"]["globalMenus"]; ?>
                </div>
            </ul>
        </div>
        <div class="content">
            <!-- Code to hghlight !-->
            <div class="codeBlock visible" data-globals="errorFile">
                <pre data-enlighter-language="php" data-enlighter-lineoffset="  <?php echo $data["extra"]["fileOffset"]; ?>" data-enlighter-indent="2" data-enlighter-theme="bootstrap4" data-enlighter-highlight="<?php echo $data["errorLine"]; ?>"><?php echo htmlentities($data["extra"]["fileContent"]); ?></pre>
            </div>
            <?php echo $data["extra"]["globalDatas"]; ?>
            <?php echo $data["extra"]["gblobalUserDatas"]; ?>
            <?php echo $data["extra"]["gblobalUserDatasConstantes"]; ?>
        </div>
    </div>

    <script type="text/javascript" src="assets/libs/Enlighterjs/js/enlighterjs.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>