<!-- resources/views/admin/export/pdf.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <style>
        /* Add your custom styles for the PDF here */
        body {
            font-family: Arial, sans-serif;
        }
        .page-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .page-header img {
            max-width: 150px;
            height: auto;
        }
        .page-title {
            text-align: center;
            font-size: 20px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="page-header">
        <img src="{{ public_path('path/to/your/logo.png') }}" alt="Logo">
    </div>
    <div class="page-title">
        <h2>All User Data</h2>
    </div>
    <table>
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Email</th>
                <th>Username</th>
                <th>City</th>
                <th>Mobile</th>
                <th>Profile Status</th>
                <th>Last Balance</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->firstname }} {{ $user->lastname }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->city }}</td>
                <td>{{ $user->mobile }}</td>
                <td>{{ $user->profile_complete ? 'Active' : 'Inactive' }}</td>
                <td>{{ number_format($user->balance, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
