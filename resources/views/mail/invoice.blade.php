@component('mail::message')
# Seller : {{ $seller->name }}
Email : {{ $seller->email }}

***Invoice send at***: {{ $invoice->sended_at }}
@component('mail::panel')
- Invoice for : {{ $customer->name }}
- Number : {{ $invoice->number }}
- Email : {{ $customer->email }}
- Phone : {{ $customer->phone }}
- Address : {{ $customer->address }}
@endcomponent

## Object
This is your invoice number {{ $invoice->number }} for the quotation number #
{{ $quotation->number }}.

## Price
{{ $quotation->price }}€

Thanks,<br>
{{ config('app.name') }}
@endcomponent
