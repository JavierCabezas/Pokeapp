<?php
/**
 * This file contains global functions for all the aplication. 
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
	if (($i >= $lower_boundary) && ($i <= $upper_boundary)){
		return true;
	}else{
		return false;
	}
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
 * @return string the number with the added zeros.
 */
function addZeros($i){
	return sprintf('%03d', $i);
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