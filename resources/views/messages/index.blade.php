<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nouvelle demande</title>
</head>
<body>
    
</body>
</html>
    <h2>Nouvelle demande</h2>
    <p>Bonjour Monsieur le Directeur de la SBEE. Je viens par ce canal pour soumettre une demande.</p>
    {{-- <p>{{ 'Bonjour ' . $data['name'] . ' ' . $data['surname'] }}</p> --}}
    <p>{{ 'Elle est accessible à ce lien. Veuillez cliquez ' . $data['url'] }} pour accéder à ma demande.</p>
    <br>
Cordialement, {{ $data['surname'] . ' ' . $data['name'] }}
