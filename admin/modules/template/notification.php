<?php
$notification = getNotification();
if($notification != false){ ?>
<script>
    notify("<?=$notification['msg']?>","<?=$notification['type']?>");
</script>
<?php } ?>
