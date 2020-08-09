<?php
include('DBCONNECT.php');
error_reporting(0);
$id = $_GET['ID'];

$getpurposesql = "SELECT Purpose FROM userprofiles WHERE ID='$id'";
$getpurpose = mysqli_query($connectionstring,$getpurposesql);

while($purp = mysqli_fetch_assoc($getpurpose)){
    $p = $purp['Purpose'];
}

if($p == 0){
    $link = "JobManiacHomeHIRE.php";
}
if($p == 1){
    $link = "JobManiacHomeFIND.php";
}
?>
<!doctype html>
<html>
<head profile="featured.png">
<meta charset="utf-8">
<title>About QUICKNOKRI.com</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">    
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">     
<link type="text/css" href="Style.css" rel="stylesheet">     
<style>
.logo{
        font-family: 'Lobster', cursive;
    }    
</style>           
</head>

<body>
    <br>
  <center>
    <a href="JobManiacHomeFIND.php"><h1 class="logo">QUICK NOKRI.com</h1></a>
  </center> 
    <br>
    <div style="padding-right: 10vw; padding-left: 10vw;">
    <h3>About This Website: </h3>
    <p>This Website Formerly Named <strong>Job Maniac</strong> is a Job Posting Website that facilitates both an Employer and a Job Seeker. It has all the basics that a website of this type needs to have such as Job Posting/Searching but it also has extra features such as a Quick Job Application and Ability to Save Favorite Job's. As for the Employer, There is an option to Also Feature your Job that enables your job to get a wider exposure by being on the front page of the Job Seekers. Every User has to be Verified In Order to get the best experience. For a Job Seeker a CV and a Profile Picture is a must.</p>
    <hr>
    <h3>About Me: </h3>
    <p>My Name is Ronit Rai and my batch is 2018-5G. This Website was created for the <strong>Aptech Vision 2020</strong></p>
    <div itemscope itemtype='http://schema.org/Person' class='fiverr-seller-widget' style='display: inline-block;'>
     <a itemprop='url' href=https://www.fiverr.com/ronitraj101 rel="nofollow" target="_blank" style='display: inline-block;'>
        <div class='fiverr-seller-content' id='fiverr-seller-widget-content-943c5dae-9b7f-40a9-85ea-697933f978e8' itemprop='contentURL' style='display: none;'></div>
        <div id='fiverr-widget-seller-data' style='display: none;'>
            <div itemprop='name' >ronitraj101</div>
            <div itemscope itemtype='http://schema.org/Organization'><span itemprop='name'>Fiverr</span></div>
            <div itemprop='jobtitle'>Seller</div>
            <div itemprop='description'>Hello , I am a High School Student who has love for Technology and want to use my skills to help out you.

My Experience :
e-Project for Website (TASHA)
i-Project for Desktop Application (College Voting System)
e-Project for Web App called RAD-Airlines
Hospital Management System and JobManiac created using PHP in 2020(Ongoing Project, Can be seen on my GitHub Repository)
Counter Strike Maps & GTA SA Mods
Common and Advanced Tasks such as Installing,Setting Up and Maintenance of Programs such Virtual Machines,Adobe Products,Microsoft Professional Programs,Games and Countless Tools.

</div>
        </div>
    </a>
</div>

<script id='fiverr-seller-widget-script-943c5dae-9b7f-40a9-85ea-697933f978e8' src='https://widgets.fiverr.com/api/v1/seller/ronitraj101?widget_id=943c5dae-9b7f-40a9-85ea-697933f978e8' data-config='{"category_name":"Programming \u0026 Tech"}' async='true' defer='true'></script>
    
    </div>
   


<br><br>    
    
<?php include('footer.php')?>    
</body>
</html>