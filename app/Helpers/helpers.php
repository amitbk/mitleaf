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

function slack($message, $channel)
{
    $ch = curl_init("https://slack.com/api/chat.postMessage");
    $data = http_build_query([
        "token" => "xoxp-1717043147858-1729745094273-1717394740131-3b48049f3c9762b975a842d0cbfa099b",
    	"channel" => $channel, //"#mychannel",
    	"text" => $message, //"Hello, Foo-Bar channel message.",
    	"username" => "kadam.amit03",
    ]);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($ch);
    curl_close($ch);

    return $result;
}
