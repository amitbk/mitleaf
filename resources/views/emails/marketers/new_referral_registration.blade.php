@component('mail::message')
# 🖐 Congrats {{ $self->name }},

{{ $user->name }} registered on MitLeaf from your refferal link.


@component('mail::panel')
  ### 💡 Here are the next steps for you now,
  - Explain benefits of social media presence to {{ $user->name }}
  - Help {{ $user->name }} to create there business profile on MitLeaf
  - Upload a logo for there business
  - Purchase plan for there business
  - And relax, MitLeaf will take care of the rest.
@endcomponent

@component('mail::button', ['url' =>  url("refferals/$user->id?ref=email") ])
📲 Call {{ $user->name }} Now
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
