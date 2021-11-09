<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    *{
    font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
}
.certificate {
    border: 15px solid #DA0037;
    padding: 22px;
    border-radius: 10px;
    position: relative;
    background: #222831;
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
    color: #EEEEEE;
}

.certificate-subtitle {
    text-align: center;
    font-size: 16px;
    letter-spacing: 2px;
    font-weight: 900;
    color: #EEEEEE;
}

.student-name {
    font-size: 20px;
    font-weight: bold;
    text-decoration: underline;
    color: #EDEDED;
}

.student-name h1 {
    color: #EDEDED;
    font-weight: 200;
}

.about-certificate {
    text-align: center;
    font-size: 16px;
    letter-spacing: 2px;
    font-weight: 900;
    color: #EDEDED;
}

.award-name {
    text-align: center;
    font-size: 16px;
    letter-spacing: 2px;
    font-weight: 900;
    color: #DA0037;
}


h3 {
    font-weight: 200;
    font-size: 16px;
    color: green;
}


.certificate-content {
    margin: 0 auto;
    width: 750px;
}


.topic-description {
    text-align: center;
}
.flex-around{
    display: flex;
    justify-content: space-evenly;
    margin-top: 2em;
    color: #EDEDED;
    font-weight: 800;
}
</style>
<body>
<div class="certificate-container">
    <div class="certificate">
        <div class="certificate-body">
            <p class="certificate-title">Certificate of Recognition</p>
            <p class="certificate-subtitle">This certificate is presented to</p>
            <div class="student-name">
                <h1>Miguel Bryan B. Pajarillo</h1>
            </div>
            <div class="about-certificate">
                <p>
                    Information Technology - WMA
                </p>
            </div>
            <div class="award-name">
                <p>
                    TOP PERFORMING STUDENT FOR SY2020-2021
                </p>
            </div>
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
</body>
</html>
