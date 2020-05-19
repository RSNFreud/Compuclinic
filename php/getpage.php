<?php
include ('../admin/php/config.php');
ini_set ('display_errors', 'on');
ini_set ('log_errors', 'on');
ini_set ('display_startup_errors', 'on');
ini_set ('error_reporting', E_ALL);
$pagename = $_GET['pagename'];
$stmt = $pdo->query("SELECT pagecontent, pagename FROM pages WHERE pagename='$pagename'");
$content = $stmt->fetch(PDO::FETCH_ASSOC);

echo $content["pagecontent"];?>
