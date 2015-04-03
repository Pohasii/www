<?php
$result = call("SELECT * FROM `tournaments` ORDER BY `date` DESC");
$title = "Главная страница";
$content = index('tournaments',$result);