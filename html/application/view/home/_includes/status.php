<?php
    $display = $user->getStatusDisplay();
?>
<div class="alert <?php echo $display['class']; ?> fade in text-centered">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <span ><strong><?php echo $display['alert_msg']; ?></strong> <?php echo $display['full_msg']; ?></span>
</div>