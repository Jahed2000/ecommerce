<?php

namespace App\Helpers;


/**
 * This class uses gravatar to fetch user images from the email provided by the user,which is to be used as user profile image. For more info http://en.gravatar.com
 */

class GravatarHelper 
{
	
/**
 * function to check if user has gravatr image
 *
 *@param string $email email of user
 *@return boolean true if there is image, false otherwise
 *
 */

	public static function validate_gravatar($email)
	{
		$hash = md5($email);
		//check if url gives 404 error or not
		$uri = 'http://www.gravatar.com/avatar/'.$hash.'?d=404';
		$headers = @get_headers($uri);

		if ( !preg_match("|200|", $headers[0]) ) {
			$has_valid_avatar = FALSE;
		} else{
			$has_valid_avatar = TRUE;
		}

		return $has_valid_avatar;
	}

/**
 * function to return gravatar image url
 *
 *@param string $email email of user
 *@param integer $size size of image
 *@param string $d type of image if not gravatar image(default image)
 *@return string gravatar image url
 *
 */

	public static function gravatar_image($email,$size=0,$d="")
	{
		$hash = md5($email);
		$image_url = 'http://www.gravatar.com/avatar/'. $hash .'?s='. $size .'$d=' .$d ;
		return $image_url;
	}

}