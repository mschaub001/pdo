<?php

/**
 * Configuration for database connection
 *
 */

$host       = "nohemac.mysql.db.internal";
$username   = "nohemac_wwmadm";
$password   = "WTc5tQMW";
$dbname     = "nohemac_wwm";
$dsn        = "mysql:host=$host;dbname=$dbname";
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              );