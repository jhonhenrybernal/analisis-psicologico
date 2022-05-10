@component('mail::message')
Gracias por confiar en nosotros

Para realizar nuestra valoración se necesita el siguiente codigo.
{{ $data['code'] }}


@component('mail::button', ['url' =>   $data['url']])
Ir pagina
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent