<!DOCTYPE html>
<html lang="az">
<head>
    <meta charset="UTF-8">
    <title>Şifrəni Sıfırla</title>
</head>
<body>
<h2>Salam,</h2>
<p>Parolunuzu sıfırlamaq üçün aşağıdakı keçidə klikləyin:</p>
<p>
    <a href="{{ url('company/reset-password?token=' . $token . '&email=' . $email) }}" style="background: #4CAF50; color: white; padding: 10px 15px; text-decoration: none;">
        Parolu Sıfırla
    </a>
</p>
<p>Əgər bu müraciəti siz etməmisinizsə, bu e-poçtu görməzliyə vurun.</p>
</body>
</html>
