@component('mail::message')
# 🖐 Hi {{ $self->name }},

@component('mail::panel')
Your payment of Rs. {{ $bill->amount }} has been processed today and will be deposited in your bank account within 2 working days.
@endcomponent


Thank you for being in a partnership with MitLeaf.

We hope for more strong partnership with you in future.


Thanks,<br>
{{ config('app.name') }}

<small> If you don't want to receive this mails, Click <a href="{{url('/unsubscribe')}}">here</a> to Unsubscribe.</small>
@endcomponent
