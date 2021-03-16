@component('mail::message')
# ✌ Congrats {{ $self->name }},

You are onboarded!

You are now in official partnership with MitLeaf.

Start promoting MitLeaf today and start earnings!

## 🔗Your personal link to promote:
@component('mail::panel')
{{ config('app.url') }}?ref={{ $self->id }}
@endcomponent




Thanks,<br>
{{ config('app.name') }}

<small> If you don't want to receive this mails, Click <a href="{{url('/unsubscribe')}}">here</a> to Unsubscribe.</small>
@endcomponent
