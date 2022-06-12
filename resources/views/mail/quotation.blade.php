@component('mail::message')
# Seller : {{ $seller->name }}
Email : {{ $seller->email }}

***Quotation send at***: {{ $quotation->sended_at }}
@component('mail::panel')
- Quotation for : {{ $customer->name }}
- Number : {{ $quotation->number }}
- Email : {{ $customer->email }}
- Phone : {{ $customer->phone }}
- Address : {{ $customer->address }}
@endcomponent

## Description
{{ $description }}

## Price
{{ $quotation->price }}€

@component('mail::button', ['url' => $accept['url'], 'color' => 'green'])
{{ $accept['value'] }}
@endcomponent

@component('mail::button', ['url' => $reject['url'], 'color' => 'red'])
    {{ $reject['value'] }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
