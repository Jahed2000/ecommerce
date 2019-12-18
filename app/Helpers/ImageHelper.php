<?php

namespace App\Helpers;

use App\Models\User;
use App\Helpers\GravatarHelper;

/**
 * 
 */
class ImageHelper
{
	
	public static function getUserImage($id)
	{
		$user = User::find($id);
		$avatar_image = "";
		if (!is_null($user)) {
			
			if ($user->avatar==NULL) {
				//return gravatar image
				if (GravatarHelper::validate_gravatar($user->email) ) {
					$avatar_url = GravatarHelper::gravatar_image($user->email,100);
				} else{
					//when thers no gravatar image
					$avatar_url = url('images/defaults/user.png');
				}
				

			} else{
				//return user uploaded image
				$avatar_url = url('images/defaults/'.$user->avatar);
			}

		} else{
			return redirect('/');
		}

		return $avatar_url;
	}
	
}