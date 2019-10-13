<div class="container">
<p>
To change your password, you need to enter your current password, then your new password twice.
If your current password is correct, and the two entries of your new password match exactly, 
your password will be changed.
</p>
<form action="password.php" method="post">
    <fieldset>
        <div class="form-group">
        		Current Password:<br>
            <input autofocus class="form-control" name="old_pwd" placeholder="Current password" type="password"/>
        </div>
        <div class="form-group">
        		New password:<br>
            <input class="form-control" name="new_pwd1" placeholder="New password" type="password"/>
        </div>
        <div class="form-group">
        		New password again:<br>
            <input class="form-control" name="new_pwd2" placeholder="New password again" type="password"/>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-default">Change Password</button>
        </div>
    </fieldset>
</form>
<br/>
</div>
