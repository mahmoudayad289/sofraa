@component('mail::message')
# Introduction

your code is :

@component('mail::button', ['url' => ''])
    {{ $code }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
