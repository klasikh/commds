
@component('mail::message')
# Nouvelle demande

Bonjour Monsieur le Directeur de la SBEE. Je viens par ce canal pour soumettre une demande. Elle est accessible à ce lien. 

@component('mail::button', ['url' => $url])
Cliquez ici
@endcomponent

<br>
Cordialement, {{ $data['surname'] . ' ' . $data['name'] }}
@endcomponent
