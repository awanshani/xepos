@component('mail::message')
    # Hello {{$model->name}},

    Thanks for Registering as a {{$type}} in our site!

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
