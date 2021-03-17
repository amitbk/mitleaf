@component('mail::message')
# ✌ Congrats {{ $self->name }},

Your order for {{ $firm->name }} of Rs.{{ $bill->amount }} has been successfully completed.

Thanks for investing on your business.
Below is a summary of your recent purchase.

### Order Date:
{{ $bill->created_at }}
### Order No:
{{ $bill->id }}


Thanks,<br>
{{ config('app.name') }}

<small> If you don't want to receive this mails, Click <a href="{{url('/unsubscribe')}}">here</a> to Unsubscribe.</small>
@endcomponent
