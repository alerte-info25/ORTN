<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Compte créé</title>
</head>
<body>
    <p>Bonjour {{ $user->prenom }} {{ $user->nom }},</p>

    <p>Votre compte a été créé avec succès sur notre plateforme ORTN.</p>

    <p>Voici vos identifiants :</p>
    <ul>
        <li>Email : {{ $user->email }}</li>
        <li>Mot de passe : {{ $password }}</li>
    </ul>

    <p>Nous vous conseillons de changer votre mot de passe lors de votre première connexion.</p>

    <p>Cordialement,<br>L'équipe ORTN</p>
</body>
</html>
