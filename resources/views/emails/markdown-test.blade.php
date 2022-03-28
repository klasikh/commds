
@component('mail::message')
# Nouvelle demande

Bonjour monsieur/madame, j'ai redigé une demande que je vous envoie afin que vous puissiez voir si j'ai respecté les différents critères de rédaction de demande. Vous pouvez accéder à cette demande en cliquant sur le lien qui se trouve en bas.

@component('mail::button', ['url' => $url])
Cliquez ici
@endcomponent

<br>
Cordialement, {{ $data['surname'] . ' ' . $data['name'] }}
@endcomponent
