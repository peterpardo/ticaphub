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
            padding: 5px 5px; 
        }
        td {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1 class="title">Rubrics ({{ $ticap->name }})</h1>
    @foreach ($specs as $spec)
        <h3>{{ $spec->name }}</h3>
        @foreach($spec->awards->where('name', '!=', 'Best Project Adviser') as $award)
            <h4>{{ $award->name }}</h4>
            <table>
                <thead>
                    <tr>
                        <td>Criteria</td>
                        <td>Percentage</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($award->awardRubric->rubric->criteria as $crit)
                    <tr>
                        <td>{{ $crit->name }}</td>
                        <td>{{ $crit->percentage }}%</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td><strong>Total</strong></td>
                        <td><strong>{{ $award->awardRubric->rubric->criteria->sum('percentage') }}%</strong></td>
                    </tr>
                </tbody>
            </table>
        @endforeach
    @endforeach
</body>
</html>