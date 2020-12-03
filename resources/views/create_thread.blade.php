<!DOCTYPE html>
<html>
<head>
<title>Student Management | Add</title>
</head>
<body>
<form action = "" method = "post">
	<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
	<table>
	<tr>
	<td>is</td>
	<td><input type='number' name='first_name' /></td>
	

	<tr>
	<td>title</td>
	<td><input type='text' name='first_name' /></td>
	
	<tr>
	<td>body</td>
	<td><input type="text" name='last_name' placeholder="LM" /></td>
	</tr>
	
	<tr>
	<td>latest reply</td>
	<td><input type="text" name='int(10) unsigned' placeholder="latest reply" /></td>
	</tr>

	<tr>
	<td>forum id</td>
	<td><input type="text" name='int(10) unsigned' placeholder="LM" /></td>
	</tr>

	<tr>
	<td>user id</td>
	<td><input type="text" name='int(10) unsigned' placeholder="LM" /></td>
	</tr>	

	<tr>
	<td colspan = '2'>
	<input type = 'submit' value = "Add student"/>
	</td>
	</tr>
	</table>
</form>
</body>
</html>


        