<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form 
        action="{{ route('set-ticap-name') }}"
        method="post">
        @csrf
        @error('ticap')
            <span>{{ $message }}</span>
        @enderror
        <label for="">Set ticap name</label>
        <input type="text" name="ticap">

        <button type="submit">Set</button>
    </form>
</body>
</html>
