<?
setcookie("online", false, time() + (60 * 60), "/");
setcookie("username", "", time() + (60 * 60), "/");

flashNotice("You have been signed out of your account!");
redirect($_SERVER['HTTP_REFERER']);