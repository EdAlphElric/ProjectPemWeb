<?php
/**
* 
*/
class Test extends CI_Controller
{
	
	function index()
	{
		echo $_SESSION['username'];
	}
}
?>