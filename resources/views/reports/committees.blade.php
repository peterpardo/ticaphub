<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Capstone Groups</title>
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
    <h1 class="title">TICaP Committees ({{ $ticap->name }})</h1>
    <table>
        <thead>
            <tr>
                <td>Committee Head</td>
                <td>Committee Name</td>
                <td>School</td>
                <td>Specialization</td>
            </tr>
        </thead>
        <tbody>
            @foreach($committees as $committee)
                <tr>
                    <td>{{ $committee->name}}</td>
                    <td>{{ $committee->user->last_name . ', ' . $committee->user->first_name . ' ' . $committee->user->middle_name}}</td>
                    <td>{{ $committee->user->userSpecialization->specialization->school->name }}</td>
                    <td>{{ $committee->user->userSpecialization->specialization->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>