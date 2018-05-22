<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title><?= $title; ?></title>
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>zurb/css/foundation.min.css">

        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

        <script src="<?= base_url() ?>zurb/js/vendor/jquery.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


    </head>
    <body>
        <div class="grid-container">
            <header>
                <div class="grid-x grid-padding-x">
                  <div class="large-12 cell">
                    <span class=""><a href="<?php echo base_url();?>">Contacts database</a></span>
                  </div>
                </div>
            </header>
            <main>
                <div class="grid-x grid-padding-x">
                  <div class="large-12 cell">
                    <h1><?= $heading; ?></h1>
                  </div>
                </div>
