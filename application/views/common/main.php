<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>CD Document JSON Generator</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="json form formatted from structured dataset">
        <meta name="author" content="irwan ibrahim">

        <link href="<?php echo SITE_ROOT; ?>/assets/css/main.css" rel="stylesheet" />
        <link href="<?php echo SITE_ROOT; ?>/assets/library/bootstrap/css/bootstrap.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script> 
        <script src="<?php echo SITE_ROOT; ?>/assets/library/bootstrap/js/bootstrap.js"></script> 
        <link href="<?php echo SITE_ROOT; ?>/assets/library/summernote/summernote.css" rel="stylesheet">
        <script src="<?php echo SITE_ROOT; ?>/assets/library/summernote/summernote.js"></script>
        <script src="<?php echo SITE_ROOT; ?>/assets/library/sweetalert/sweetalert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo SITE_ROOT; ?>/assets/library/sweetalert/sweetalert.css">
        <link href='<?php echo SITE_ROOT;?>/assets/library/datepicker/css/datepicker.css' rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="<?php echo SITE_ROOT;?>/assets/library/DataTables/datatables.min.css"/>
        <script type="text/javascript" src="<?php echo SITE_ROOT;?>/assets/library/DataTables/datatables.min.js"></script>
        <?php echo $vars;?>
        <style>
            #json_view { white-space: pre; font-family: monospace; }
        </style>
    </head>

    <body>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo SITE_ROOT; ?>">List Of Documents</a></li>
                    <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo SITE_ROOT; ?>/formview/new-form">Create New Form
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="<?php echo SITE_ROOT; ?>/formview/new-form">Add New Form</a></li>
                      <li><a href="<?php echo SITE_ROOT; ?>/formview/new-section">Add New Section</a></li>
                      <li><a href="<?php echo SITE_ROOT; ?>/formview/new-element">Add New Element</a></li>
                      <li><a href="<?php echo SITE_ROOT; ?>/formview/form-builder">Form Builder</a></li>
                    </ul>
                    </li>
                    <li class="hidden"><a href="<?php echo SITE_ROOT; ?>/formview/sql-raw-data">SQL Raw Data</a></li>
                    <li><a href='<?php echo SITE_ROOT; ?>/formview/generate-json-format'>Generate JSON Format</a></li>
                </ul>
            </div>
        </nav>
    </body>