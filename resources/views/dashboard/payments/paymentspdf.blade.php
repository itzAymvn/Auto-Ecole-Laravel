<!-- dashboard/payments/pdf.blade.php -->

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }

        .header {
            border-bottom: 1px solid black;
            padding-bottom: 10px;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            margin: 0;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            padding: 10px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Auto-école</h1>
        <p>Date: {{ date('Y-m-d') }}</p>
    </div>

    <div>
        <h2>Les informations de l'utilisateur</h2>
        <p>Le nom complet: {{ $user->name }}</p>
        <p>Adresse e-mail: {{ $user->email }}</p>
        <p>Numéro de téléphone: {{ $user->phone }}</p>
    </div>

    <h2>L'historique des paiements</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Le montant de l'objectif</th>
                <th>Montant reçu</th>
                <th>Montant restant à payer</th>
                <th>Paiement effectué le</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payments as $payment)
                <tr>
                    <td>{{ $payment->id }}</td>
                    <td>{{ $payment->goal_amount }}</td>
                    <td>{{ $payment->amount_paid }}</td>
                    <td>{{ $payment->remaining_amount }}</td>
                    <td>{{ $payment->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Auto-école</p>
    </div>
</body>

</html>
