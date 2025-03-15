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
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>

    <!-- Custom Theme files -->
    <!-- <link href="css/style.css" rel="stylesheet" type="text/css" media="all" /> -->
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all" />
    <!-- //Custom Theme files -->

    <!-- web font -->
    <link href="//fonts.googleapis.com/css?family=Hind:300,400,500,600,700" rel="stylesheet">
    <!-- //web font -->

</head>

<body>
    <div class="login-bg">
        <div class="login-card shadow">
            <h2 class="mb-4 text-center">Welcome Back!</h2>
            <form action="cek.php" method="post">
                <div class="mb-3 input-group">
                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                    <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                </div>
                <div class="mb-3 input-group">
                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <div class="form-check text-start mb-3">
                    <input type="checkbox" class="form-check-input" id="rememberMe" checked>
                    <label class="form-check-label" for="rememberMe">Keep me logged in</label>
                </div>
                <button type="submit" class="btn btn-primary w-100">Log In</button>
                <div class="mt-3 text-center">
                    <a href="#" class="text-decoration-none" onclick="showForgotPassword()">Forgot Password?</a> |
                    <a href="#" class="text-decoration-none" onclick="showRegister()">New User? Register</a>
                </div>
            </form>
        </div>
    </div>

    <script src='//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
    <script src="//m.servedby-buysellads.com/monetization.js" type="text/javascript"></script>
    <script>
        (function() {
            if (typeof _bsa !== 'undefined' && _bsa) {
                // format, zoneKey, segment:value, options
                _bsa.init('flexbar', 'CKYI627U', 'placement:w3layoutscom');
            }
        })();
    </script>
    <script>
        (function() {
            if (typeof _bsa !== 'undefined' && _bsa) {
                // format, zoneKey, segment:value, options
                _bsa.init('fancybar', 'CKYDL2JN', 'placement:demo');
            }
        })();
    </script>
    <script>
        (function() {
            if (typeof _bsa !== 'undefined' && _bsa) {
                // format, zoneKey, segment:value, options
                _bsa.init('stickybox', 'CKYI653J', 'placement:w3layoutscom');
            }
        })();
    </script>
    <script type="text/javascript" src="//services.bilsyndication.com/adv1/?d=353" defer="" async=""></script>
    <script>
        var vitag = vitag || {};
        vitag.gdprShowConsentTool = false;
        vitag.outStreamConfig = {
            type: "slider",
            position: "left"
        };
    </script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-125810435-1"></script>
    <script>
        $(document).ready(function() {
            $("#formsignup").hide();
            $("#formforgotpassword").hide();
            $("#myPopup").hide();

        });

        function hideshow(x) {
            if (x == 1) {
                $("#formsignin").hide();
                $("#formsignup").show();
                $("#formforgotpassword").hide();
            } else if (x == 2) {
                $("#formsignin").show();
                $("#formsignup").hide();
                $("#formforgotpassword").hide();
            } else {
                $("#formsignin").hide();
                $("#formsignup").hide();
                $("#formforgotpassword").show();
            }
        }

        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-125810435-1');
    </script>
    <script>
        (function(i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function() {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
        ga('create', 'UA-30027142-1', 'w3layouts.com');
        ga('send', 'pageview');
    </script>

</html>

<style>
    .login-bg {
        min-height: 100vh;
        background: linear-gradient(135deg, #007bff, #6610f2);
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .login-card {
        background: #fff;
        border-radius: 10px;
        padding: 2rem;
        width: 100%;
        max-width: 400px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    /* Input Field Styling */
    .input-group-text {
        background-color: #FFCA10;
        border: none;
        color: #02335B;
    }

    .form-control:focus {
        border-color: #FFCA10;
        box-shadow: 0 0 5px rgba(255, 202, 16, 0.7);
    }

    /* Button Styling */
    .btn-primary {
        background-color: #FFCA10;
        border: none;
        color: #02335B;
        font-weight: bold;
        transition: all 0.3s;
    }

    .btn-primary:hover {
        background-color: #e0af0b;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .login-card {
            width: 90%;
        }
    }
</style>