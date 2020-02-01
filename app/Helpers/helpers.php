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
