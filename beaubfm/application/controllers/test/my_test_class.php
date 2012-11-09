<?php
require_once('Toast.php');

class My_test_class extends Toast
{
	function My_test_class()
	{
		parent::Toast(__FILE__); // Remember this
	}

	function test_some_action()
	{
		// Test code goes here
		$my_var = 2 + 2;
		$this->_assert_equals($my_var, 4);
	}

	function test_some_other_action()
	{
		// Test code goes here
		$my_var = true;
		$this->_assert_false($my_var);
	}
}