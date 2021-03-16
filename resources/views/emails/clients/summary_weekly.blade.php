@component('mail::message')
# ✅ Hey {{ $self->name }},
Here is your weekly summary report of the most important activities on MitLeaf for your businesses.


@component('mail::button', ['url' => '/'])
Visit MitLeaf
@endcomponent

Thanks,<br>
{{ config('app.name') }}

<small> If you don't want to receive this mails, Click <a href="{{url('/unsubscribe')}}">here</a> to Unsubscribe.</small>
@endcomponent
