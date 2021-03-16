@component('mail::message')
# Greetings {{ $self->name }},

We are so excited to welcome you to the MitLeaf family!

Every single one of us is here for you to help you reach new heights with your social media management.

## If you don't have clear idea about how MitLeaf can help your business, then let't understand it first,

@component('mail::panel')
  ### Mitleaf will help you,
  - To create meaningful & automated graphics for your business pages on Facebook
  - All graphics will be with your own branding & On a strict schedule

  ### Mitleaf has following categories available,
  - All possible Indian events
  - Daily Page boosters with Quotes and Inspirational graphics
  - Smart Business Kit

  ### How it works?
  - Register your business (You have done that)
  - Select type of your business
  - Select your schedule and plan
  - Thats it, MitLeaf will take care of the rest,
  - MitLeaf will create innovative graphics for your business on schedule, and will inform to you as well.

@endcomponent

To learn more about MitLeaf, check our Getting Started Guide.
If you have any questions at any stage of your journey, we are here to help.

@component('mail::button', ['url' => '/login'])
Login to MitLeaf
@endcomponent

Thanks,<br>
{{ config('app.name') }}

<small> If you don't want to receive this mails, Click <a href="{{url('/unsubscribe')}}">here</a> to Unsubscribe.</small>
@endcomponent
