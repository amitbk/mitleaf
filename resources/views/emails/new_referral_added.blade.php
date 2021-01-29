@component('mail::message')
# Hey {{ $self->name }}!
Congrats, {{$user->name}} joined from your referral link.

## Boomerang
"I threw a boomerang a few years ago...I now live in constant fear."

## Crazy Grandpa
"My grandfather has the heart of a lion and a lifetime ban at the zoo."

@component('mail::button', ['url' => '/'])
View My Profile
@endcomponent

Always Laughing,<br>
Dino Cajic
@endcomponent
