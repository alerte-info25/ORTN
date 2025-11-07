<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Bienvenue sur ORTN</title>
</head>
<body style="margin:0; padding:0; font-family: Arial, sans-serif; background:#000000;">

  <table align="center" width="100%" cellpadding="0" cellspacing="0" border="0" style="max-width:600px; margin:auto; background:#ffffff; border-radius:8px; overflow:hidden;">
    <tr>
      <td align="center" bgcolor="#d60000" style="padding:30px; color:#ffffff;">
        <h1 style="margin:0; font-size:28px;">ORTN</h1>
        <p style="margin:5px 0 0; font-size:16px;">Plateforme numérique intégrée</p>
      </td>
    </tr>

    <tr>
      <td style="padding:30px; text-align:center;">
        <h2 style="color:#d60000;">Bienvenue {{ $user->prenom }} {{ $user->nom }} !</h2>
        <p style="color:#333333; font-size:15px; line-height:1.5;">
          Nous sommes ravis de vous accueillir dans la communauté <strong>ORTN</strong>.<br>
          Votre aventure musicale et médiatique commence maintenant !
        </p>
      </td>
    </tr>

    <tr>
      <td style="padding:20px 30px; background:#f4f4f4;">
        <h3 style="margin-top:0; font-size:16px; color:#000000;">Vos informations</h3>
        <p style="margin:5px 0;"><strong>Date :</strong> {{ now()->format('d/m/Y à H:i') }}</p>
        <p style="margin:5px 0;"><strong>Email :</strong> {{ $user->email }}</p>
        <p style="margin:5px 0;"><strong>Genre :</strong> {{ $user->genre->libelle }}</p>
        @if($user->localite)
        <p style="margin:5px 0;"><strong>Localité :</strong> {{ $user->localite->libelle }}</p>
        @endif
      </td>
    </tr>

    <tr>
      <td align="center" style="padding:30px;">
        <p style="font-size:16px; color:#000000;">Découvrez toutes les fonctionnalités de votre compte :</p>
        <a href="{{ url('/') }}" 
           style="display:inline-block; background:#d60000; color:#fff; padding:12px 24px; text-decoration:none; border-radius:4px; font-weight:bold;">
            Découvrir ORTN
        </a>
      </td>
    </tr>

    <!-- Footer -->
    <tr>
      <td align="center" bgcolor="#000000" style="padding:20px; color:#cccccc; font-size:12px;">
        © {{ date('Y') }} ORTN — COMORES <br>
      </td>
    </tr>
  </table>

</body>
</html>
