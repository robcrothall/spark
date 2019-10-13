<?php

	$_SESSION["module"] = $_SERVER["PHP_SELF"];
	$rec_id = htmlspecialchars(strip_tags($_SESSION["rec_id"]));
	$data = query("select * from ship where id = ?", $rec_id); 
	$ship = $data[0]["ship_name"]; 
	$notes = $data[0]["notes"];
	$user_id = $data[0]["user_id"];
	$changed = $data[0]["changed"];
	$data = query("select username from users where id = ?", $user_id);
	$username = $data[0]["username"];
?>
<h2>Update a ship</h2>

<form action="../ctl/ship_update.php" method="post">
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>Name</td> 
            <input type="hidden" id="rec_id" name="rec_id" value="<?php echo $ship_id; ?>" /></td>
            <td><input type='text' name='name' class='form-control' value='<?php echo $ship; ?>' /></td>
        </tr>
        <tr>
            <td>Notes on this ship</td>
            <td><textarea name='notes' class='form-control'><?php echo $notes; ?></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Save' class='btn btn-primary' />
                <a href='ship.php' class='btn btn-primary'>Back to ship</a>
            </td>
        </tr>
    </table>
</form>


