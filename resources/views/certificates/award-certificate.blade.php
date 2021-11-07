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
    font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
}
.certificate {
    border: 15px solid #393E46;
    padding: 22px;
    border-radius: 10px;
    position: relative;
    background-image: url(https://img.freepik.com/free-photo/hand-painted-watercolor-background-with-sky-clouds-shape_24972-1095.jpg?size=626&ext=jpg);
    background-repeat: no-repeat;
    background-size: cover;
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

.certificate-body {
    text-align: center;
}

.certificate-title {
    text-align: center;   
    font-size: 24px;
    letter-spacing: 5px;
    font-weight: bolder;
    color: #222831;
}

.certificate-subtitle {
    text-align: center;   
    font-size: 16px;
    letter-spacing: 2px;
    font-weight: 900;
    color: #393E46;
}

.student-name {
    font-size: 20px;
    font-weight: bold;
    text-decoration: underline;
}

.student-name h1 {
    color: #222831;
    font-weight: 200;
}

.about-certificate {
    text-align: center;   
    font-size: 16px;
    letter-spacing: 2px;
    font-weight: 900;
    color: #393E46;
}

.award-name {
    text-align: center;   
    font-size: 16px;
    letter-spacing: 2px;
    font-weight: 900;
    color: #00ADB5;
}


h3 {
    font-size: 16px;
    letter-spacing: 2px;
    font-weight: 900;
}


.certificate-content {
    margin: 0 auto;
    width: 750px;
}


.topic-description {
    text-align: center;
}
.flex-around{
    margin-top: 2em;
    color: #222831;
    font-weight: 800;
}
</style>

<body>
    <div class="certificate-container">
        <div class="certificate">
            <div class="certificate-header">
            </div>
            <div class="certificate-body">
                <p class="certificate-title"><strong>{{ $ticap->name }}</strong></p>
                <p class="certificate-subtitle">This certificate is presented to</p>
                <div class="student-name">
                    <h1>{{ $group->name }}</h1>
                </div>
                <h1>{{ $award->name }}</h1>
                <h3>{{ $spec->name }} ({{ $spec->school->name }})</h3>
                <div class="certificate-content">
                </div>
                <div class="certificate-footer text-muted">
                    <div class="">
                        <div class="">
                            <div class="flex-around">
                                <div class="">
                                    <p>
                                        <p>Mr. Heintjie N. Vicente<br>WMA/SMBA Course Adviser</p>
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
</body>
</html>
