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
    <h1 class="title">Capstone Groups ({{ $ticap->name }})</h1>
    <table>
        <thead>
            <tr>
                <td>Group Name</td>
                <td>Student Name</td>
                <td>School</td>
                <td>Specialization</td>
            </tr>
        </thead>
        <tbody>
            @foreach($groups as $group)
                @foreach($group->userGroups as $userGroup)
                <tr>
                    <td>{{ $group->name}}</td>
                    <td>{{ $userGroup->user->last_name . ', ' . $userGroup->user->first_name . ' ' . $userGroup->user->middle_name}}</td>
                    <td>{{ $group->specialization->school->name }}</td>
                    <td>{{ $group->specialization->name }}</td>
                </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</body>
</html>