<?php

session_start();

if (empty($_SESSION['count'])) {
   $_SESSION['count'] = 1;
} else {
   $_SESSION['count']++;
}
?>

<p>
Эта страница отображалась <?php echo $_SESSION['count']; ?> раз.
</p>
