@component('mail::message')
# Introduction

The body of your message.

@component('mail::button', ['url' => $accept['url'], 'color' => 'green'])
{{ $accept['value'] }}
@endcomponent

@component('mail::button', ['url' => $reject['url'], 'color' => 'red'])
    {{ $reject['value'] }}
@endcomponent

@component('mail::panel')
    This is the panel content.
@endcomponent

@component('mail::table')
    | Laravel       | Table         | Example  |
    | ------------- |:-------------:| --------:|
    | Col 2 is      | Centered      | $10      |
    | Col 3 is      | Right-Aligned | $20      |
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
