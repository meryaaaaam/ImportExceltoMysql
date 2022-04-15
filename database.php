<?php
$con=mysqli_connect('localhost','root','','import_excel');

if(mysqli_connect_errno())
{
	echo 'Failed to connect to database'.mysqli_connect_error();
}
?>