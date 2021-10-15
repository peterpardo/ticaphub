<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rubrics</title>
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
    <h1 class="title">Graded Rubrics ({{ $ticap->name }})</h1>
    @foreach ($specs as $spec)
        <h3>{{ $spec->name }}</h3>
        @foreach($spec->awards->where('name', '!=', 'Best Project Adviser') as $award)
            <h4>{{ $award->name }}</h4>
            <table>
                <thead>
                    <tr>
                        <td>Panelists</td>
                        @foreach($spec->groups as $group)
                            <td>{{ $group->name }}</td>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($spec->panelists as $panelist)
                    <tr>
                        <td>{{ $panelist->user->last_name . ' ' . $panelist->user->first_name . ' ' . $panelist->user->middle_name}}</td>
                        @foreach($spec->groups as $group)
                            <td>{{ $group->panelistGrades->where('award_id', $award->id)->where('user_id', $panelist->user->id)->pluck('total_grade')->first() }}</td>
                        @endforeach
                    </tr>
                    @endforeach
                    <tr>
                        <td><strong>Total</strong></td>
                        @foreach($spec->groups as $group)
                            <td>{{ round($group->panelistGrades->where('award_id', $award->id)->avg('total_grade'), 3); }}</td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        @endforeach
    @endforeach
</body>
</html>