<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>CD Document JSON Generator</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="json form formatted from structured dataset">
        <meta name="author" content="irwan ibrahim">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->


        <link href="<?php echo SITE_ROOT; ?>/assets/css/main.css" rel="stylesheet" />

        <link href="<?php echo SITE_ROOT; ?>/assets/library/bootstrap/css/bootstrap.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script> 

        <script src="<?php echo SITE_ROOT; ?>/assets/library/bootstrap/js/bootstrap.js"></script> 
        <link href="<?php echo SITE_ROOT; ?>/assets/library/summernote/summernote.css" rel="stylesheet">
        <script src="<?php echo SITE_ROOT; ?>/assets/library/summernote/summernote.js"></script>
        <script src="<?php echo SITE_ROOT; ?>/assets/library/sweetalert/sweetalert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo SITE_ROOT; ?>/assets/library/sweetalert/sweetalert.css">
        <link href='<?php echo SITE_ROOT;?>/assets/library/datepicker/css/datepicker.css' rel="stylesheet" />
        <?php echo $vars;?>
        <style>
            #json_view { white-space: pre; font-family: monospace; }
        </style>

    </head>

    <body>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand">CD JSON FORMATTER</a>
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo SITE_ROOT; ?>">List Of Documents</a></li>
                    <li><a href="<?php echo SITE_ROOT; ?>/formview/new-form">Create New Form</a></li>
                    <li><a href="<?php echo SITE_ROOT; ?>/formview/sql-raw-data">SQL Raw Data</a></li>
                    <li><a href='<?php echo SITE_ROOT; ?>/formview/generate-json-format'>Generate JSON Format</a></li>
<!--                    <li><a href='<?php echo SITE_ROOT; ?>/formview/testing-page'>Testing page</a></li>-->
                </ul>
            </div>
        </nav>
        <div class="container-fluid">


