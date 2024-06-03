<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Mail to user</title>
    <style></style>
</head>

<body>
    <div id="email" style="width:600px;">

        <!-- Header -->
        <table role="presentation" border="0" cellspacing="0" width="100%">

            <tr>Dear Applicant,</tr><br><br>
        </table>

        <!-- Body -->
        <table role="presentation" border="0" cellspacing="0" width="100%">  

            <tr>
                You can login with following details:
            </tr><br><br>
            <tr><strong>Password:</strong> {{ $password }}</tr><br><br>
            <tr>
                <strong>Email:</strong> {{ $email }}
            </tr><br><br>
            <tr><strong>Phone:</strong> {{ $phoneNumber }}</tr><br><br>
            <tr>Thanks</tr><br>
            <tr>Support Team</tr><br><br>
        </table>
    </div>
</body>

</html>
