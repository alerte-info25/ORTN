<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <h2>Nouveau message de contact</h2>

    <p><strong>Nom :</strong> {{ $data['last_name'] }} {{ $data['first_name'] }}</p>
    <p><strong>Email :</strong> {{ $data['email'] }}</p>
    <p><strong>Téléphone :</strong> {{ $data['phone'] ?? 'Non renseigné' }}</p>
    <p><strong>Sujet :</strong> {{ $data['subject'] }}</p>
    <p><strong>Message :</strong></p>
    <p>{{ $data['message'] }}</p>
    
</body>
</html>