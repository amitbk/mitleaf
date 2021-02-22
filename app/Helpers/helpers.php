<?php
use App\Option;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

function flash($message, $level = 'info')
{
		session()->flash('message',$message);
		session()->flash('message_level',$level);
}

function domain()
{
	return $domain=$_SERVER['HTTP_HOST'];
}


function getFirm()
{
	return array(
								'name' => env('APP_NAME', null),
								'description' => env('APP_DESC', null),
								'logo' => env('APP_LOGO', null),
								'logo_sq' => env('APP_LOGO_SQ', null),
							);
}
