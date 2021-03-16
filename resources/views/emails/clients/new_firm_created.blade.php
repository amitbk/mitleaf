@component('mail::message')
# Congrats {{ $self->name }},

✅ {{$firm->name}} is added as your business on MitLeaf!


@component('mail::panel')
  ## 💡 Next step:
  Connect your facebook page so MitLeaf can start creating meaningful & automated graphics for your business and can also publish it on that page automatically on specified schedule.
@endcomponent

@component('mail::button', ['url' => url("firms/$firm->id/add_fb_page?ref=email")])
✔ Connect Facebook Pages
@endcomponent

Thanks,<br>
{{ config('app.name') }}

<small> If you don't want to receive this mails, Click <a href="{{url('/unsubscribe')}}">here</a> to Unsubscribe.</small>
@endcomponent
