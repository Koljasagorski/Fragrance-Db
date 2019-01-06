
<?php

include('postcomment');
?>


<div class="container-fluid"style="width:50%;">

<div class="panel panel-default">
<div class="panel-heading">Comment on this release</div>
  <div class="panel-body">
  	<form action="postcomment.php" method="post">
  	  <div class="form-group">
	    <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Name">
	  </div>
	  <div class="form-group">
	    <textarea name="subject" class="form-control" rows="5"></textarea>
	  </div>
	  <button type="submit" class="btn btn-primary">Submit</button>
	  <input type="text" name="random" class="form-control" id="exampleInputEmail1" value="<?php $rid; ?>">
	</form>
  </div>
</div>

