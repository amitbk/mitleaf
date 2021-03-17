@component('mail::message')
# 🖐 Greetings {{ $self->name }},

We are so excited to welcome you to the MitLeaf family!

Every single one of us is here for you to help you reach new heights with your social media management.

## 💡 To learn more about MitLeaf, check our Getting Started Guide.

@component('mail::button', ['url' => url('/start') ])
Getting Started Guide
@endcomponent

If you have any questions at any stage of your journey, we are here to help.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
