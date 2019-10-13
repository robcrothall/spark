<p class="lead text-danger">
    Sorry!
</p>
<p class="text-danger">
   <?= htmlspecialchars($message) ?>
   <?php
   	$message = '';
	?>
</p>

<a href="javascript:history.go(-1);" class='btn btn-primary'>Back</a>
