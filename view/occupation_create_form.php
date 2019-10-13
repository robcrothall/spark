<h2>Record a new Occupations</h2>

<form action="../ctl/occupation_create.php" method="post">
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>Name</td>
            <td><input type='text' name='name' class='form-control'></td>
        </tr>
        <tr>
            <td>Notes on this occupation</td>
            <td><textarea name='notes' class='form-control'></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Save' class='btn btn-primary' />
                <a href='../ctl/occupation.php' class='btn btn-primary'>Back to Occupationss</a>
            </td>
        </tr>
    </table>
</form>


