@component('mail::message')
# ✌ Congrats {{ $self->name }},

You have received a commission of Rs. {{ $bill->amount }} from MitLeaf.

We at MitLeaf are really happy to share this achievement with you.

@component('mail::panel')
## 💡 Opportunities

You have endless opportunities here with MitLeaf.

We have simple formula of earnings, Promote more and Earn more!

If you have any queries regarding earnings, Kindly contact with {{ $referrar->name }} on {{ $referrar->mobile }}
Or you can also contact with us on {{ config('app.contact') }}.

@endcomponent


@component('mail::button', ['url' => url('/earnings')])
Check your earnings on MitLeaf
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
