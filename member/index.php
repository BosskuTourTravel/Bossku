<?php
    session_start();
    session_destroy();
    include "../slug.php";
?>

<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="Slide Login Form template Responsive, Login form web template, Flat Pricing tables, Flat Drop downs Sign up Web Templates, Flat Web Templates, Login sign up Responsive web template, SmartPhone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />

     <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>

    <!-- Custom Theme files -->
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all" />
    <!-- //Custom Theme files -->

    <!-- web font -->
    <link href="//fonts.googleapis.com/css?family=Hind:300,400,500,600,700" rel="stylesheet">
    <!-- //web font -->

</head>
<body>
<script src='//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script><script src="//m.servedby-buysellads.com/monetization.js" type="text/javascript"></script>
<script>
(function(){
    if(typeof _bsa !== 'undefined' && _bsa) {
        // format, zoneKey, segment:value, options
        _bsa.init('flexbar', 'CKYI627U', 'placement:w3layoutscom');
    }
})();
</script>
<script>
(function(){
if(typeof _bsa !== 'undefined' && _bsa) {
    // format, zoneKey, segment:value, options
    _bsa.init('fancybar', 'CKYDL2JN', 'placement:demo');
}
})();
</script>
<script>
(function(){
    if(typeof _bsa !== 'undefined' && _bsa) {
        // format, zoneKey, segment:value, options
        _bsa.init('stickybox', 'CKYI653J', 'placement:w3layoutscom');
    }
})();
</script>
<script type="text/javascript" src="//services.bilsyndication.com/adv1/?d=353" defer="" async=""></script><script> var vitag = vitag || {};vitag.gdprShowConsentTool=false;vitag.outStreamConfig = {type: "slider", position: "left" };</script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-125810435-1"></script>
<script>

    $(document).ready(function(){
        $("#formsignup").hide();
        $("#formforgotpassword").hide();
        $("#myPopup").hide();

    });

    function hideshow(x){
        if(x==1){
            $("#formsignin").hide();
            $("#formsignup").show();
            $("#formforgotpassword").hide();
        }else if(x==2){
            $("#formsignin").show();
            $("#formsignup").hide();
            $("#formforgotpassword").hide();
        }else{
            $("#formsignin").hide();
            $("#formsignup").hide();
            $("#formforgotpassword").show();
        }
    }

  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-125810435-1');
</script><script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-30027142-1', 'w3layouts.com');
  ga('send', 'pageview');
</script>
<body>

<!-- main -->
<div class="w3layouts-main"> 
    <div class="bg-layer">
        <h1>MEMBER FORM</h1>
        <!---728x90--->

        <div class="header-main">
            <div class="main-icon">
                <a href="<?php echo $domain_web ?>"><span class="fa fa-eercast"><img src="../assets/i/performalogo.png" style="padding-left: 10px;"></span></a>
            </div>
            <div class='header-left-bottom' id='formsignin'>
                <form action='cek.php' method='post'>
                    <input name='id' id='id' value='1' type='hidden'>
                    <div class='icon1'>
                        <span class='fa fa-user'></span>
                        <input type='email' name='email' placeholder='Email Address' required=''/>
                    </div>
                    <div class='icon1'>
                        <span class='fa fa-lock'></span>
                        <input type='password' name='password' placeholder='Password' required=''/>
                    </div>
                    <div class='login-check'>
                         <label class='checkbox'><input type='checkbox' name='checkbox' checked=''><i> </i> Keep me logged in</label>
                    </div>
                    <div class='bottom'>
                        <button class='btn'>Log In</button>
                    </div>
                    <div class='links'>
                        <p><a onclick='hideshow(3)'>Forgot Password?</a></p>
                        <p class='right'><a onclick='hideshow(1)'>New User? Register</a></p>
                        <div class='clear'></div>
                    </div>
                </form> 
            </div>

            <div class='header-left-bottom' id='formforgotpassword'>
                <form action='cek.php' method='post'>
                     <input name='id' id='id' value='3' type='hidden'>
                    <div class='icon1'>
                        <span class='fa fa-user'></span>
                        <input type='email' name='email' placeholder='Email Address' required=''/>
                    </div>
                    <div class='bottom'>
                        <button class='btn'>Log In</button>
                    </div>
                     <div class='links'>
                        <p class='right'><a onclick='hideshow(2)'>Already have account?</a></p>
                        <p class='right'><a onclick='hideshow(1)'>New User? Register</a></p>
                        
                        <div class='clear'></div>
                    </div>                  
                </form> 
            </div>

            <div class='header-left-bottom' id='formsignup'>
                <form action='cek.php' method='post'>
                     <input name='id' id='id' value='2' type='hidden'>
                    <div class='icon1'>
                        <span class='fa fa-user'></span>
                        <input type='text' name='name' placeholder='Nama Lengkap' required=''/>
                    </div>
                    <div class='icon1'>
                        <span class='fa fa-address-book'></span>
                        <input type='text' name='address' placeholder='Alamat Lengkap' required=''/>
                    </div>
                    <div class='icon1'>
                        <span class='fa fa-phone'></span>
                        <input type='text' name='phone' placeholder='No Telepon' required=''/>
                    </div>
                    <div class='icon1'>
                        <span class='fa fa-address-card'></span>
                        <input type='email' name='email' placeholder='Email Address' required=''/>
                    </div>
                    <div class='icon1'>
                        <span class='fa fa-lock'></span>
                        <input type='password' name='password' placeholder='Password' required=''/>
                    </div>
                    <div class='login-check'>
                         <label class='checkbox'><input type='checkbox' name='checkbox' checked=''><i> </i> Saya sudah membaca dan setuju <a href=<?php echo $domain_web ?>/conditionofuse style='color: yellow;' class=more target=_blank><u>Terms & Conditions</u></a> dari holidaymyboss.com</label>
                    </div>
                    <div class='bottom'>
                        <button class='btn'>Register</button>
                    </div>
                    <div class='links'>
                        <p><a onclick='hideshow(3)'>Forgot Password?</a></p>
                        <p class='right'><a onclick='hideshow(2)'>Already have account?</a></p>
                        <div class='clear'></div>
                    </div>
                </form> 
            </div>
        <!--     <div class="social">
                <ul>
                    <li>or login using : </li>
                    <li><a href="#" class="facebook"><span class="fa fa-facebook"></span></a></li>
                    <li><a href="#" class="twitter"><span class="fa fa-twitter"></span></a></li>
                    <li><a href="#" class="google"><span class="fa fa-google-plus"></span></a></li>
                </ul>
            </div> -->
        </div>
        <!---728x90--->

   
    </div>
</div>  
<!-- //main -->
  <?php
        if (isset($_GET["err"]) && !empty($_GET["err"])) {
            if($_GET["err"]==1){
                echo "<script>alert('email atau password salah !')</script>";
            }
        }
    ?>

</body>
</html>