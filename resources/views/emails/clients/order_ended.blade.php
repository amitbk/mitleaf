@component('mail::message')
# 🔴 Amit, Your plan for {{ $firm->name }} is expired on {{ date('d M, Y', strtotime($order->date_expiry) ) }}!

👀 Your business should get in front of your clients and customers every day.

🙏 But unfortunately MitLeaf will not be able to create valuable posts for your business from {{ date('d M, Y', strtotime($order->date_expiry) ) }}.

💰 It's not expenses, it's wise investment on your business.
Kindly invest again, so MitLeaf can start creating graphics for FLYMIT.


@component('mail::button', ['url' => url("plans?firm_id=$firm->id&ref=email") ])
Renew Again
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
