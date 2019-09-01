<?php

include "database-manager.php";

$db_manager = new DBManager();


if ($db_manager->there_is_connection()) {
    $db_manager->append_into_tuples("Notes");
    
    foreach ($db_manager->tuples as $tuple) {
        if ($user == $tuple["name_user"]) {
            echo <<<EOT
            <div class='callout text-center'>
                <p class='menu-text'>Title: {$tuple['title']}</p><p>Note: {$tuple['note']}</p>
                <form method="post" action="hairbook-update.php">
                    <input type="hidden" name="user" value="{$user}">
                    <input type="hidden" name="id" value="{$tuple['id']}">
                    <input type="hidden" name="title" value="{$tuple['title']}">
                    <input type="hidden" name="note" value="{$tuple['note']}">
                    <button type="submit" class='button' style="margin-top: 15px;">Update</button>
                </form>
                <form method="post" action="delete.php">
                    <input type="hidden" name="user" value="{$user}">
                    <input type="hidden" name="id" value="{$tuple['id']}">
                    <input type="hidden" name="title" value="{$tuple['title']}">
                    <input type="hidden" name="note" value="{$tuple['note']}">
                    <button class='button' style="padding: 10px;">Delete</button>
                </form>
            </div>
            EOT;
        }
    }   
}

$db_manager->close_connection();