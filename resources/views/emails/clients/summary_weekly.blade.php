@component('mail::message')
# ✅ Hey {{ $self->name }},
Here is your weekly summary report of the most important activities on MitLeaf for your businesses.


@component('mail::button', ['url' => '/'])
Visit MitLeaf
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
