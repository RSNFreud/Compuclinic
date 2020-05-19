<?php
include('../admin/php/config.php');
ini_set ('display_errors', 'on');
ini_set ('log_errors', 'on');
ini_set ('display_startup_errors', 'on');
ini_set ('error_reporting', E_ALL);

$stmt = $pdo->query("SELECT name, rating, message, status FROM testimonials");
$testimonials = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($testimonials as $dataitem) {
    if($dataitem['status'] == 'approved') {
        if($dataitem['rating'] == '1') {
            $rating = '<i class="fas fa-star fill"></i>';
        }
        if($dataitem['rating'] == '2') {
            $rating = '<i class="fas fa-star fill"></i><i class="fas fa-star fill"></i>';
        }
        if($dataitem['rating'] == '3') {
            $rating = '<i class="fas fa-star fill"></i><i class="fas fa-star fill"></i><i class="fas fa-star fill"></i>';
        }
        if($dataitem['rating'] == '4') {
            $rating = '<i class="fas fa-star fill"></i><i class="fas fa-star fill"></i><i class="fas fa-star fill"></i><i class="fas fa-star fill"></i>';
        }
        if($dataitem['rating'] == '5') {
            $rating = '<i class="fas fa-star fill"></i><i class="fas fa-star fill"></i><i class="fas fa-star fill"></i><i class="fas fa-star fill"></i><i class="fas fa-star fill"></i>';
        }
        echo '<div class="box">
                    <div class="score">'. $rating .'</div>
                    <div class="message">'. $dataitem["message"] .'</div>
                    <div class="author">- '. $dataitem["name"] .'</div>
                </div>';
    }
}
?>
