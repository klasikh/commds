@component('mail::message')
# Nouvelle demande

{{ $data['content'] }}

@component('mail::button', ['url' => $url])
Cliquez ici
@endcomponent

@endcomponent
