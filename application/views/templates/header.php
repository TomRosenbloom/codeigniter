<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title><?= $title; ?></title>
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>zurb/css/foundation.min.css">

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

        <script src="<?= base_url() ?>zurb/js/vendor/jquery.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <style>
        /*  temp location for local styles - really should be adding to app.css and compiling */
            .deactivated td {
                color: LightGray;
            }
            .deactivated td a {
                color: LightGray;
            }
            .deactivated td a:hover {
                color: SteelBlue;
            }

            /* font-awesome icon styles */
            .fas {

            }
            .fa-user-edit {
                color: #3adb76;
            }
            .fa-user-minus {
                color: #ffae00;
            }
            .fa-user-times {
                color: #cc4b37;
            }
            .iconCell { /* table cell that icon inhabits*/
                padding-left: 2px;
                padding-right: 0;
            }
            .deactivated i {
                color: LightGray;
            }
        </style>

    </head>
    <body>
        <div class="grid-container">
            <header>
                <div class="grid-x grid-padding-x">
                    <div class="cell large-6"><a href="<?php echo base_url();?>">Contacts database</a></div>
                    <div class="cell large-6 text-right"><?php echo anchor('logout', 'Logout');?></div>

                </div>
            </header>
            <main>
                <div class="grid-x grid-padding-x">
                  <div class="large-12 cell">
                    <h1><?= $heading; ?></h1>
                  </div>
                </div>
