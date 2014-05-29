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