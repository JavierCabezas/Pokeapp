<?php
/**
 * This file contains useful functions accesible by the entire application.
 * Its inserted by the main index.php file.
 */

/**
 * This function checks if a number its in a certain range of numbers.
 * @param $i the number to compare.
 * @param $lower_boundary the lower boundary.
 * @param $upper_boundary the upper boundary.
 * @return boolean true if its in the range and false otherwise. 
 */
function its_in_between($i, $lower_boundary, $upper_boundary){
	return (($i >= $lower_boundary) && ($i <= $upper_boundary));
}
/**
 * This function beautifys a string. This meaning using correct capitalization and replacing - for spaces. This is used for the database
 * terms since they are saved in lowercase and separated by - (Ex: special-attack)
 * @param $s the string to beautify
 * @return string the string beutified.
 */
function beautify($s){
	return str_replace('-', ' ', ucfirst($s));
}

/**
 * This function adds up to two zeros to the number (Ex: 1 to 001 and 90 to 090). 
 * @param $i the integer used to add zeros.
 * @param $n the number of zeros (default its 3)
 * @return string the number with the added zeros.
 */
function addZeros($i, $n = 3){
	return sprintf('%0'.$n.'d', $i);
}

/**
 * 	This function retuns +(number) if the integer given is positive. Ex: +6 for 6.
 *	@param $i the number to check
 *	@return string the number with the sign.	
 */
function signify($i){
	if($i>0)
		return "+".$i;
	else
		return $i;
}

/**
 * Returns the image directory.
 */
function imageDir(){
	return Yii::app()->baseUrl."/images";
}

/**
 *	In case the number given by argument has a decimal part != from 0 returns the next integer. Ex: roundUp(6.0) = 6, roundUp(3.1) = 4.
 *	@param $i the number to roundUp
 *	@return integer the number rounded up.	
 */
function roundUp($i){
	if(intval($i) == $i)
		return $i;
	else
		return (intval($i)+1);
}

/**
 * 	Generates a random password from 5 to 10 characters long.
 */
function generatePassword(){
	$rand = rand(5, 10);
	return substr(md5(uniqid(mt_rand(), true)), 0, $rand);	
}

/** 
 *	Returns an array with each one of the generations intended for a dropdown list.
 *	@return array in the format of array('id_generation' => 'generation name')
 */
function arrayGenerations()
{
	return array('1' => 'Primera', '2' => 'Segunda', '3' => 'Tercera', '4' => 'Cuarta', '5' => 'Quinta', '6' => 'Sexta');
}

function limpiar($in)
{
	$out = str_replace('Á', 'A', $in);
	$out = str_replace('É', 'E', $out);
	$out = str_replace('Í', 'I', $out);
	$out = str_replace('Ó', 'O', $out);
	$out = str_replace('Ú', 'U', $out);
	return $out;
}