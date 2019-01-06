
<?php
include('header.php');
?>

<center>
<?php 
echo '
<div class="container-fluid">
<div class="panel panel-default text-left"style="width:50%;">
  <div class="panel-heading">
    <h3 class="panel-title">Welcome to <b><?php $siteName ?></b></h3>
  </div>
  <div class="panel-body">

<b>'.$lang['info_integrity'].'</b><br />'.nl2br($lang['info_integrity_text']).' <a href="https://en.wikipedia.org/wiki/HTTP_cookie" target="_blank" rel="noopener">Wikipedia</a>.
<br /><br /><b>'.$lang['info_releases'].'</b><br />'.nl2br($lang['info_releases_text']).'
<br /><br /><b>'.$lang['info_other'].'</b><br />'.nl2br($lang['info_other_text']).'
<br /><br /><b>'.$lang['info_source'].'</b><br />'.nl2br($lang['info_source_text']).'
<br /><br /><b>'.$lang['info_thanks'].'</b><br />'.nl2br($lang['info_thanks_text']).'

<br /><b>'.$lang['info_mail'].'</b>
  </div>
    </div>
  </div>
</div>
</div>';
?>
</center>
<?php include('footer.php'); ?>