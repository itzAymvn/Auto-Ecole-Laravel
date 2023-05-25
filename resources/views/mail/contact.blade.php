<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Nouveau message de contact</title>
    <style>
        /* Email body styles */
        body {
            font-family: Arial, sans-serif;
            font-size: 16px;
            line-height: 1.5;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        /* Email container styles */
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        /* Email header styles */
        .email-header {
            padding: 20px;
            background-color: #f8f8f8;
            text-align: center;
            border-bottom: 1px solid #cccccc;
        }

        .email-header h1 {
            margin: 0;
            font-size: 28px;
            color: #333333;
        }

        /* Email body styles */
        .email-body {
            padding: 20px;
        }

        .email-body h2 {
            margin-top: 0;
            font-size: 20px;
            color: #333333;
        }

        /* Table styles */
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background-color: #f8f8f8;
            font-weight: bold;
            color: #333333;
        }

        td {
            border-top: 1px solid #cccccc;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Nouveau message de contact</h1>
        </div>
        <div class="email-body">
            <h2>Informations de contact</h2>
            <table>
                <tr>
                    <th>Nom:</th>
                    <td>{{ $mailData['name'] }}</td>
                </tr>
                <tr>
                    <th>L'adresse électronique:</th>
                    <td>{{ $mailData['email'] }}</td>
                </tr>
                <tr>
                    <th>Le sujet:</th>
                    <td>{{ $mailData['subject'] }}</td>
                </tr>
                <tr>
                    <th>Le message:</th>
                    <td>{{ $mailData['message'] }}</td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>
