<?php
//mysql-srv59637.ht-systems.ru
//localhost
//config file
$db = mysql_connect("localhost", "srv59637_tur", "qwerqwer1234");
mysql_select_db("srv59637_tur");
$db = mysql_connect("localhost", "root", "");
mysql_select_db("tur");
mysql_unbuffered_query("SET `character_set_client` = 'utf8';");
mysql_unbuffered_query("SET `character_set_results` = 'utf8';"); 
mysql_unbuffered_query("SET `collation_connection` = 'utf8_general_ci';"); 