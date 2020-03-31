<?php
/**
 * Ip address of the machine
 */
#$ipAddress = "50.0.10.10";
$ipAddress = "127.0.0.1";
/**
 * Apache port to listen to the request (80, 8080, 81 whatever you prefer)
 */
$port = 80;
/**
 * DocumentRoot (/var/www/vhosts for example without the last trailing slash
 */
#$documentRoot = "/var/www/vhosts";
$documentRoot = "D:/vhosts";
/**
 * Domain Alias (dev.$domain, $domain.dev for example, whatever you are going to use in your host file)
 */
$alias = "test";
/**
 * Web server
 * only works with Apache and Ngnix for now
 * comment one or the other, never leave both uncommented, the app will assume Apache as default.
 */
# $webServer = "Ngnix";
$webServer = "Apache";
/**
 * If Ngnix is selected, choose your configured fcgi port
 */
$fcgiPort = 9000; // default port is 9000

/**
 * OS, to select if you are on a *NIX based system or Windowze
 * If left as "null", it will assume you are running a *NIX based os
 * and load templates for that OS.
 */

$operatingSystem = "w";
#$os = null;

/**
 * Frameworks:
 *
 * For now symfony 3 and 4
 */
$framework = 5;
