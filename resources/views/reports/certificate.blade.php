<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate</title>
</head>
<style>
*{
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
.certificate {
    border: 15px solid green;
    padding: 22px;
    /* width: auto; */
    position: relative;
}

.certificate::after {
    content: '';
    top: 0px;
    left: 0px;
    bottom: 0px;
    right: 0px;
    position: absolute;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    opacity: 0.1;
    width: fit-content;
}

.certificate-title {
    text-align: center;   
    font-size: 20px;
    letter-spacing: 5px;
}

.certificate-body {
    text-align: center;
}

h1 {
    font-weight: 200;
    font-size: 30px;
    color: green;
}

h3 {
    font-weight: 200;
    font-size: 16px;
    color: green;
}

.student-name {
    font-size: 20px;
    font-weight: bold;
    text-decoration: underline;
}

.certificate-content {
    margin: 0 auto;
    width: 750px;
}

.about-certificate {
    width: 380px;
    margin: 0 auto;
}

.topic-description {
    text-align: center;
}

.flex-around{
    /* display: flex;
    justify-content: space-evenly; */
    margin-top: 5em;
}
</style>

<body>
    @foreach($specs as $spec)
        @foreach($spec->awards as $award)
            @foreach($award->groupWinners as $winner)
                <div class="certificate-container">
                    <div class="certificate">
                        <div class="water-mark-overlay"></div>
                        <div class="certificate-header">
                        </div>
                        <div class="certificate-body">
                        
                            <p class="certificate-title"><strong>FEU TECH (Technology Innovation in Capstone Project)</strong></p>
                            <p class="certificate-title"><strong>{{ $ticap->name }}</strong></p>
                            <h1>{{ $award->name }}</h1>
                            <h3>{{ $spec->name }} ({{ $spec->school->name }})</h3>
                            <div class="about-certificate">
                                <p>
                                    This certificate is presented to
                                </p>
                            </div>
                            <p class="student-name">{{ $winner->group->name }}</p>
                            <div class="certificate-content">
                            </div>
                            <div class="certificate-footer text-muted">
                                <div class="">
                                    <div class="">
                                        <div class="flex-around">
                                            <div class="">
                                                <p>
                                                    <p>Mr. Hientjie N. Vicente<br>WMA/SMBA Course Adviser</p>
                                                </p>
                                            </div>
                                            <div class="">
                                                <p>Dr. Ace C. Lagman<br>IT Director</p>
                                            </div>
                                            <div class="">
                                                <p>
                                                    <p>Dr. Maria Rona L. Perez<br>AGD/DA Course Adviser</p>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach 

            @foreach($award->individualWinners as $winner)
                <div class="certificate-container">
                    <div class="certificate">
                        <div class="water-mark-overlay"></div>
                        <div class="certificate-header">
                        </div>
                        <div class="certificate-body">
                        
                            <p class="certificate-title"><strong>FEU TECH (Technology Innovation in Capstone Project)</strong></p>
                            <p class="certificate-title"><strong>{{ $ticap->name }}</strong></p>
                            <h1>{{ $award->name }}</h1>
                            <h3>{{ $spec->name }} ({{ $spec->school->name }})</h3>
                            <div class="about-certificate">
                                <p>
                                    This certificate is presented to
                                </p>
                            </div>
                            <p class="student-name">{{ $winner->group->name }}</p>
                            <p class="student-name">{{ $winner->name }}</p>
                            <div class="certificate-content">
                            </div>
                            <div class="certificate-footer text-muted">
                                <div class="">
                                    <div class="">
                                        <p>Dr. Ace C. Lagma<br>IT Director</p>
                                    </div>
                                    <div class="">
                                        <div class="">
                                            <div class="">
                                                <p>
                                                    <p>Mr. Hientjie N. Vicente<br>WMA/SMBA Course Adviser</p>
                                                </p>
                                            </div>
                                            <div class="">
                                                <p>
                                                    <p>Dr. Maria Rona L. Perez<br>AGD/DA Course Adviser</p>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endforeach
    @endforeach 
</body>
</html>
