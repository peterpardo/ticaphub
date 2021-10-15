<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Awardees</title>
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
    <h1 class="title">{{ $ticap->name }} Winners</h1>
    @foreach($specs as $spec)
        <h3 class="sub-title">{{ $spec->name }}</h3>

        <h4>Student Choice Award</h4>
        <table>
            <thead>
                <tr>
                    <td>Award</td>
                    <td>Group</td>
                </tr>
            </thead>
            <tbody>
                @foreach($spec->studentChoiceAwards as $winner)
                    <tr>
                        <td>{{ $winner->name}}</td>
                        <td>{{ $winner->group->name}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h4>Individual Awards</h4>
        <table>
            <thead>
                <tr>
                    <td>Award</td>
                    <td>Group</td>
                    <td>Awardee</td>
                </tr>
            </thead>
            <tbody>
                @foreach($spec->awards->where('type', 'individual') as $award)
                    @foreach($award->individualWinners as $winner)
                        <tr>
                            <td>{{ $award->name}}</td>
                            <td>{{ $winner->group->name}}</td>
                            <td>{{ $winner->name }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>

        <h4>Group Awards</h4>
        @foreach($spec->awards->where('type', 'group') as $award)
            <table>
                <thead>
                    <tr>
                        <td>Award</td>
                        <td>Group</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($award->groupWinners as $winner)
                        <tr>
                            <td>{{ $award->name}}</td>
                            <td>{{ $winner->group->name}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach
    @endforeach
</body>
</html>