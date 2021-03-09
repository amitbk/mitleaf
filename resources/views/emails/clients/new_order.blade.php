@component('mail::message')
# ✌ Congrats {{ $self->name }},

Your order for {{ $firm->name }} of Rs.{{ $bill->amount }} has been successfully completed.

Thanks for investing on your business.
Below is a summary of your recent purchase.

### Order Date:
{{ $bill->created_at }}
### Order No:
{{ $bill->id }}

### Order Details:
@component('mail::table')
| #       | Plan         |  Rate | Expiry |
| ------- |:------------:|  --------:|  --------:|
@foreach($order->firm_plans as $firm_plan)
| {{$loop->index+1}}       | {{$firm_plan->plan->name}} <br> <small> @if(config('amit.plans.social_media_sharing') == $firm_plan->plan_id) - @else {{$firm_plan->qty_per_month}} img/month    @endif </small> | {{config('app.currency')}} {{$firm_plan->order_plan->rate}}      | {{ date('d M, Y', strtotime($firm_plan->date_expiry)) }} <br> <small>({{$firm_plan->date_expiry->diffForHumans()}}) </small> |
@endforeach
@endcomponent



Thanks,<br>
{{ config('app.name') }}
@endcomponent
