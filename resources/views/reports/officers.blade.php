<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Officers</title>
    <style>
        .title {
            text-align: center;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin: auto;
        }
        thead {
            font-weight: bold;
            text-align: center;
        }
        thead, tbody, td {
            border: 1px solid black;
            padding: 5px 2px; 
        }
    </style>
</head>
<body>
    <h1 class="title">Officers ({{ $ticap->name }})</h1>
    <table>
        <thead>
            <tr>
                <td>Name</td>
                <td>Position</td>
                <td>Election</td>
            </tr>
        </thead>
        <tbody>
            @foreach($officers as $officer)
            <tr>
                <td>{{ $officer->user->last_name . ', ' . $officer->user->first_name . ' ' . $officer->user->middle_name}}</td>
                <td>{{ $officer->position->name }}</td>
                <td>{{ $officer->election->name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>