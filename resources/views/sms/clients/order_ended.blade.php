{{ $self->name }}, Your plan for {{ $firm->name }} is expired on {{ date('d M, Y', strtotime($order->date_expiry) ) }}!
Click here to renew: {{ url("plans?firm_id=$firm->id&ref=email") }}
