<?php
require_once('Toast.php');

class Securite_test extends Toast
{
	function __construct()
	{
		parent::Toast(__FILE__); // Remember this
		$this->load->library('securite');
	}

	function test_crypt_difference()
	{
		// Test code goes here
		$mdp = "lapin";
		$this->_assert_false($this->securite->crypt($mdp)===$mdp);
		$this->message = "Mdp crypte different du mdp initial ";
	}
	
	function test_crypt_null()
	{
		// Test code goes here
		$mdp = NULL;
		$this->_assert_empty($this->securite->crypt($mdp));
		$this->message = "Mdp initial null ";
	}
	
	function test_crypt_vide()
	{
		// Test code goes here
		$mdp = "";
		$this->_assert_empty($this->securite->crypt($mdp));
		$this->message = "Mdp initial vide ";
	}
	
	function test_crypt_egalite()
	{
		// Test code goes here
		$mdp = "AZERTYUIOPQSDFGHJKLMWXCVBN";
		$mdp2 = "AZERTYUIOPQSDFGHJKLMWXCVBN";
		$this->_assert_equals($this->securite->crypt($mdp),$this->securite->crypt($mdp2));
		$this->message = "Deux mots de passe egals.";
	}
}