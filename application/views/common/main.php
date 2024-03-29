<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>CD JSON Generator</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="json form formatted from structured dataset">
        <meta name="author" content="irwan ibrahim">
        <link rel="shortcut icon" href="<?php echo SITE_ASSET; ?>/assets/favicon-JSON.ico" type="image/x-icon">
        <link href="<?php echo SITE_ASSET; ?>/assets/css/main.css" rel="stylesheet" />
        <link href="<?php echo SITE_ASSET; ?>/assets/library/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="<?php echo SITE_ASSET; ?>/assets/library/summernote/summernote.css" rel="stylesheet">
        <link href="<?php echo SITE_ASSET; ?>/assets/library/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
        <link href='<?php echo SITE_ASSET; ?>/assets/library/datepicker/css/datepicker.css' rel="stylesheet" />
        <link href="<?php echo SITE_ASSET; ?>/assets/library/DataTables/datatables.min.css" rel="stylesheet" type="text/css" />
        <link href="//use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous"  rel="stylesheet">
        <script src="<?php echo SITE_ASSET; ?>/assets/library/ajax/jquery/2.1.4/jquery.js"></script>
        <script src="<?php echo SITE_ASSET; ?>/assets/library/bootstrap/js/bootstrap.js"></script>
        <script src="<?php echo SITE_ASSET; ?>/assets/library/summernote/summernote.js"></script>
        <script src="<?php echo SITE_ASSET; ?>/assets/library/sweetalert/sweetalert.min.js"></script>
        <script src="<?php echo SITE_ASSET; ?>/assets/library/DataTables/datatables.min.js" type="text/javascript" ></script>
        <?php echo $vars; ?>
        <style>
            #json_view { white-space: pre; font-family: monospace; }
        </style>
    </head>

    <?php if (PROJECT_PATH === 'cd' || PROJECT_PATH === 'rispac'): ?>
        <body>
            <nav class="navbar navbar-default navbar-fixed-top">
                <div class="container-fluid">
                    <ul class="nav navbar-nav re">
                        <li><a href='<?php echo SITE_ROOT; ?>/formview/generate-json-format'>Generate JSON Format</a></li>
                    </ul>
                </div>
            </nav>
        </body>
    <?php elseif ((PROJECT_PATH == 'prod' || PROJECT_PATH == 'uat' || PROJECT_PATH == 'stg')): ?>
        <body>
            <nav class="navbar navbar-default navbar-fixed-top">
                <div class="container-fluid">
                    <ul class="nav navbar-nav">
                        <li><a href="<?php echo SITE_ROOT; ?>">List Of Documents</a></li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" >Create New Form
                                <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo SITE_ROOT; ?>/formview/new-section">Add New Section</a></li>
                                <li><a href="<?php echo SITE_ROOT; ?>/formview/new-element">Add New Element</a></li>
                                <li><a href="<?php echo SITE_ROOT; ?>/formview/new-predefine">Add New Multiple Answer</a></li>
                                <li><a href="<?php echo SITE_ROOT; ?>/formview/new-ncp-method">Add New Nursing Care Plan</a></li>
                                <li><a href="<?php echo SITE_ROOT; ?>/formview/new-pds-method">Add New Patient Disease Summary</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </body>
    <?php else: ?>
        <body>
            <nav class="navbar navbar-default navbar-fixed-top">
                <div class="container-fluid">
                    <ul class="nav navbar-nav">
                        <li><a href='<?php echo SITE_ROOT; ?>/formview/generate-json-format'>Generate JSON Format</a></li>
                    </ul>
                </div>
            </nav>
        </body>
        <?php endif;