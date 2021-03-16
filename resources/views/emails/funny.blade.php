@component('mail::message')
# Hey {{ $name }}!
This email was sent by events.

## Boomerang
"I threw a boomerang a few years ago...I now live in constant fear."

## Crazy Grandpa
"My grandfather has the heart of a lion and a lifetime ban at the zoo."

@component('mail::button', ['url' => 'http://dinocajic.xyz'])
View My Profile
@endcomponent

Always Laughing,<br>
Dino Cajic

<small> If you don't want to receive this mails, Click <a href="{{url('/unsubscribe')}}">here</a> to Unsubscribe.</small>
@endcomponent
