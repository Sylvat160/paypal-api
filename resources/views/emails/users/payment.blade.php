@component('mail::message')
# Introduction

Votre paiement a été effectué avec succès. <br> Merci pour votre confiance.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
