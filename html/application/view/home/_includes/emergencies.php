<?php
if( $GLOBALS['hasEmergency'])
{
    $currentEmergency = $emergency->getCurrent();
?>
<div class="alert alert-danger fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <span><strong> <?php echo $currentEmergency->titre;?> : </strong>
    <a href="<?php echo $currentEmergency->lien;?>"> <?php echo $currentEmergency->info;?> </a></span>
</div>
<?php
}
?>
