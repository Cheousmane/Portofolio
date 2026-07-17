<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouvelle demande — SID-TECH</title>
</head>
<body style="font-family: Arial, sans-serif; color:#0F2A4A; line-height:1.6;">
    <h2 style="color:#0F2A4A;">Nouvelle demande depuis le site SID-TECH</h2>

    <p><strong>Nom :</strong> {{ $data['name'] }}</p>
    <p><strong>Email :</strong> {{ $data['email'] }}</p>
    <p><strong>Besoin :</strong> {{ $data['service'] ?: 'Non précisé' }}</p>

    <p><strong>Message :</strong></p>
    <p style="white-space: pre-line; background:#F5F7FA; padding:14px; border-radius:8px;">{{ $data['message'] }}</p>
</body>
</html>
