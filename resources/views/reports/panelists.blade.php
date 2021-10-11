<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Panelists</title>
    <style>
        .title {
            text-align: center;
            margin-bottom: 1rem;
        }
        .sub-title {
            margin-bottom: 1rem;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            /* margin: auto; */
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
    <h1 class="title">{{ $ticap->name }} Panelists</h1>
    <table>
        <thead>
            <tr>
                <td>Specialization</td>
                <td>Panelist</td>
            </tr>
        </thead>
        <tbody>
            @foreach($specs as $spec)
                @foreach($spec->panelists as $panelist)
                    <tr>
                        <td>{{ $spec->name}} - {{ $spec->school->name }}</td>
                        <td>{{ $panelist->user->first_name }} {{ $panelist->user->middle_name }} {{ $panelist->user->last_name }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</body>
</html>