<?php
include "nav.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="temp.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>

<body>
    <div class="slide-show-container">
        <div class="img-slide-show-container">
            <img class="img-slide-show w3-animate-top" id="img-slide-show" src="background-image.jpg" alt="">
        </div>
        <div class="button-container">
            <div class="slide-show-previous-button" onclick="moveImg(-1)">
                <div class="previous-button-1 right"></div>
            </div>
            <div class="slide-show-next-button" onclick="moveImg(1)">
                <div class="previous-button-1 left"></div>
            </div>
        </div>
    </div>

    <br>
    <div class="container main-content">
        <div class="row">
            <div class="col-sm">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="background-image.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="background-image.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="background-image.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="container main-content">
        <div class="row">
            <div class="col-sm">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="background-image.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="background-image.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="background-image.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <hr>
        <div class="box-1">
            <h3>Our Vision</h3><br>
            <p>As a law enforcement officer, my fundamental duty is to serve the community; to safeguard lives and property; to protect the innocent against deception, the weak against oppression or intimidation and the peaceful against violence or disorder; and to respect the constitutional rights of all to liberty, equality, and justice.
                <br>
                <br>
                I will keep my private life unsullied as an example to all and will behave in a manner that does not bring discredit to me or to my agency. I will maintain courageous calm in the face of danger, scorn or ridicule; develop self-restraint; and be constantly mindful of the welfare of others. Honest in thought and deed both in my personal and official life, I will be exemplary in obeying the law and the regulations of my department. Whatever I see or hear of a confidential nature or that is confided to me in my official capacity will be kept ever secret unless revelation is necessary in the performance of my duty.
                <br>
                <br>
                I will never act officiously or permit personal feelings, prejudices, political beliefs, aspirations, animosities or friendships to influence my decisions. With no compromise for crime and with relentless prosecution of criminals, I will enforce the law courteously and appropriately without fear or favor, malice or ill will, never employing unnecessary force or violence and never accepting gratuities.
            </p>
        </div>
        <div class="box-2">
            <h3>Our Mission</h3><br>
            <p>I recognize the badge of my office as a symbol of public faith, and I accept it as a public trust to be held so long as I am true to the ethics of police service. I will never engage in acts of corruption or bribery, nor will I condone such acts by other police officers. I will cooperate with all legally authorized agencies and their representatives in the pursuit of justice.
                <br>
                <br>
                I know that I alone am responsible for my own standard of professional performance and will take every reasonable opportunity to enhance and improve my level of knowledge and competence.
                <br>
                <br>
                I will constantly strive to achieve these objectives and ideals, dedicating myself before God to my chosen profession… law enforcement.
            </p>
        </div>
    </div>

    <?php
    include 'footer.php'
    ?>


</body>
<script src="temp.js">

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">

</script>

</html>