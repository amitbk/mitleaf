@component('mail::message')
# 🔴 Amit, Your plan for {{ $firm->name }} is about to expire in {{$order->date_expiry->diffForHumans()}}.

📢 Regular status updates gives you a chance to connect with your customers daily.

🎨 MitLeaf creates valuable graphics for {{ $firm->name }} automatically on decided schedule.

✈ Renew your plan now to continue this awesome service.

@component('mail::button', ['url' => url("plans?firm_id=$firm->id&ref=email") ])
Renew Now
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
