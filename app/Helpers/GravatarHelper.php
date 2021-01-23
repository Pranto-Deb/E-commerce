<?php
namespace App\Helpers;
/**
 * GravatarHelper
 */
class GravatarHelper
{
	public static function validate_gravatar($email){
		$hash = md5($email);
		$uri = 'http://www.gravatar.com/avatar/'.$hash.'?d=404';
		$headers = @get_headers($uri);
		if (!preg_match("|200|", $headers[0])){
			$hash_valid_avatar = False;
		}
		else{
			$hash_valid_avatar = True;
		}
		return $hash_valid_avatar;
	}

	public static function gravatar_image($email, $size=0, $d=""){
		$hash = md5($email);
		$image_url= 'http://www.gravatar.com/avatar/'.$hash.'?s='.$size.'&d='.$d;
		return $image_url;
	}
}