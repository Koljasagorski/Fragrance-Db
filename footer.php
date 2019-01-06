</div><center>
<div class="footer">
<?php echo $lang['foot_info'] ?>
</div>
</center>
</div>
<center>
<?php
error_reporting(0);
if (isset($_COOKIE['password']) && isset($_COOKIE['aduser']) && $_COOKIE['password'] === $encryptPass && $_COOKIE['aduser'] === $adminUser) {
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$finish = $time;
$total_time = round(($finish - $start), 3);
echo $lang['foot_gen'].'&nbsp;'.$total_time.'&nbsp;'.$lang['foot_gen_sec'].'<br />';
if($total_time < 0.25){
	echo 'Status: <font color="green" title="Everything looks nice and stable!"><b>Low</b></font><br />';}
if($total_time > 0.25 && $total_time < 0.6){
	echo 'Status: <font color="orange" title="Loadtime are a bit high, just a friendly notice."><b>Medium</b></font><br />'; }
if($total_time > 0.6){
	echo 'Status: <font color="red" title="Something hogs the server!"><b>High!</b></font><br />'; }
}
?>
<?php echo $lang['foot_pwrby'] ?> <a href="https://github.com/SwedishTracker/Fragrance-Db" target="_blank"><img src="/img/poweredby.png" alt=""></a>

</center>
</div>
</body>

</html>
<?php
die();
?>