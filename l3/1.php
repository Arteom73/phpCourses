<?php

session_start();

if (empty($_SESSION['count'])) {
   $_SESSION['count'] = 1;
} else {
   $_SESSION['count']++;
}
?>

<p>
��� �������� ������������ <?php echo $_SESSION['count']; ?> ���.
</p>
