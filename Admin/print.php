<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="id">
<head>
<?php
include "db=connection.php";

$query = "SELECT * FROM tour_package WHERE id = ".$_GET['id_package'];
$rs=mysqli_query($con,$query);
$row = mysqli_fetch_array($rs);

?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <?php echo "<title>Paket tour : ".$row['tour_name']." | 2canholiday.com</title>"; ?>

  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="css/bootstrap-formhelpers.css">
  <link rel="stylesheet" href="css/bootstrap-formhelpers.min.css">
  <link rel="stylesheet" href="assets/owl-carousel/owl.carousel.css">
  <link rel="stylesheet" href="assets/owl-carousel/owl.theme.default.css">

   <!-- <link rel="stylesheet" href="OwlCarousel/dist/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="OwlCarousel/dist/assets/owl.carousel.min.css" /> -->

    <!--
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script> -->
      <link href="assets/css/style.css" rel="stylesheet">
      <link href="assets/css/popup.css" type="text/css" rel="stylesheet">
      <link href="assets/css/custom_performa.css" rel="stylesheet">
      <link rel="stylesheet" href="assets/superslides/superslides.css?u=8.23612E-03">
      <script type="text/javascript" src="assets/js/jquery.min.js"></script>
      <script type="text/javascript" src="assets/js/cons-https.js" ></script>
      <script type="text/javascript" src="assets/js/header.js" ></script>
  <!--<script src="OwlCarousel/dist/owl.carousel.min.js"></script>
  <script src="/bower_components/jquery/dist/jquery.js"></script>
  <script src="OwlCarousel/dist/owl.carousel.min.js"></script> -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script src="assets/owl-carousel/owl.carousel.mvc.min.js" ></script>
  <script src="assets/superslides/jquery.easing.js" async></script>
  <script src="assets/superslides/jquery.animate-enhanced.min.js" async></script>
  <script src="assets/superslides/jquery.superslides.min.js"  type="text/javascript" charset="utf-8"></script>
  <script src="assets/superslides/jquery.hammer.min.js" ></script>


  <link rel="stylesheet" href="assets/css/home.css">

  <link href="assets/css/normalize.css" type="text/css" rel="stylesheet">
  <link href="assets/js/jquery/jquery-ui.css" rel="stylesheet">
  <link href="assets/js/jquery/jquery.ui.autocomplete.css" rel="stylesheet">
  <link href="assets/css/alert.css" type="text/css" rel="stylesheet" />
  <link href="assets/css/bootstrap.min.css" type="text/css" rel="stylesheet">

  <link href="assets/css/animate.css" type="text/css" rel="stylesheet">
  <link href="assets/css/style.2.3.5.css" rel="stylesheet">
  <link href="assets/css/popup.1.3.css" type="text/css" rel="stylesheet">
  <link href="assets/css/custom_performa.css" rel="stylesheet">
  <script type="text/javascript" src="assets/js/jquery/jquery.lazyload.min.js" ></script>
  <script type="text/javascript" src="assets/js/jquery/jquery-ui.min.js"></script>
  <script type="text/javascript" src="assets/js/jquery/jquery.ui.autocomplete.js"></script>
  <script type="text/javascript" src="assets/js/main.2.1.7.js?v=2"></script>




 
<!-- End Facebook Pixel Code -->


<style>
/*table, th, td {
  border: 1px solid black;
}*/

.judul{
	color :#000080 !important;
}
.panel-heading .sub_panel_title {
    color: #393939 !important;
    font-weight: 600;
}
.panel-title {
    margin-top: 0;
    margin-bottom: 0;
    font-size: 12px;
    color: inherit;
}
body .content_column {
  padding: 15px;
  margin-right: 10px;
  overflow: hidden;
  border: solid 1px #ddd;
  box-shadow: 3px 5px 0px #d9d9d9; }

@media (max-width: 767px) {
  body .content_column {
    margin-right: 0px; } }
h1 {
  color: #009ada !important; }

.package-name {
  color: #009ada !important;
  font-size: 12px;
  line-height: normal; }

.banner-head-tour {
  display: inline-block;
  position: relative; }
  .banner-head-tour .tagdiscount {
    right: 0;
    top: 0;
    width: 85px; }


.table-price .opsi-tour:not(:last-child) {
  border-bottom: solid 1px #DDD; }


.col_opsi {
  overflow: hidden;
  padding: 5px 20px;
  margin-bottom: 10px;
  border: solid 1px #0b9edb;
  border-radius: 5px;
  box-shadow: 3px 3px 0px #0b9edb; }

#bookingSummary .subtitle {
  font-weight: bolder; }

.content_tour h1 {
  font-size: 12px;
  color: #00008B !important;
  line-height: 30px;
  font-weight: bold;
  margin-top: 0px;
  text-transform: capitalize;
  font-family: "Roboto", "Trebuchet MS"; }


.padl6 .bullet {
  float: left;
  width: 18px; }
.padl6 .text-opsi {
  overflow: hidden; }
  .padl6 .text-opsi .title {
    color: #009ada !important;
    font-weight: bold;
    border-bottom: solid 1px #009ada;
    padding-bottom: 1px;
    line-height: 15px;
    display: inline-block; }

.nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover {
  border: none;
  background-color: transparent !important; }

@media screen and (max-width: 320px) {
  .col_opsi ul li {
    width: 89px; } }
.panel_heading {
  text-align: right; }
  .panel_heading .panel_title a {
    border: 1px solid #222;
    border-radius: 50%;
    padding: 5px 10px;
    font-size: 12px;
    color: #222 !important; }

#home .segment1, #home .segment3 {
  display: none;
  overflow: hidden; }

#menu2 .segment1, #menu2 .segment2 {
  display: none;
  overflow: hidden; }

#menu1 .segment2, #menu1 .segment3 {
  display: none;
  overflow: hidden; }


ul#breadcrumb, h2.title-top {
  padding-left: 15px; }

.all-item img {
  width: auto;
  }


  .title-top {
    margin-left: 10px; }

  .pricingtable .grandtotal {
    text-align: center !important; } }
img {
  width: auto; }

.container-itineraries img {
  padding: 5px 10px; }

.segment2-icon {
  border-radius: 20px;
  background-color: #3ab9e2 !important;
  width: 180px;
  padding: 2px;
  display: inline-block; }

.segment1-icon {
  border-radius: 20px;
  background-color: #f27ea3 !important;
  width: 180px;
  padding: 2px;
  display: inline-block; }

.qty {
  display: inline-block;
  padding-left: 10px; }

.date-select {
  display: inline-block; }

.form-group select {
  padding: 9px 15px;
  border-radius: 5px;
  z-index: 1; }

.segment3-icon {
  border-radius: 20px;
  background-color: #bfd028 !important;
  width: 180px;
  padding: 2px;
  display: inline-block; }

.paxtogo {
  background-color: #009ada !important;
  height: 20px;
  color: #FFFFFF !important;
  line-height: 20px;
  font-weight: bold;
  font-size: 12px;
  border: solid 1px #00578f !important;
  padding: 0 10px;
  display: inline-block !important;
  vertical-align: middle; }

.fleft {
  float: left; }

.table-price > tbody > tr > td {
  padding: 10px 10px 0px 0px; }

.pricingtable {
  border-spacing: 1px;
  border-collapse: separate; }

.pricingtable select {
  width: 100%;
  height: 24px;
  padding: 0 0 0 15px;
  font-size: 12px; }

#grandtotal {
  line-height: 38px; }

input.btnchange {
  background-color: #b73030 !important;
  border: 0px;
  border-bottom: 1px solid #b73030;
  width: 120px;
  height: 25px;
  display: inline-block;
  color: #FFFFFF !important;
  font-size: 9px;
  -webkit-border-radius: 15px;
  -moz-border-radius: 15px;
  border-radius: 15px;
  background-image: url(../i/bg-chroomconfig.png);
  white-space: normal;
  background-repeat: no-repeat;
  line-height: 9px;
  padding-left: 15px;
  padding-top: 2px; }

.starting {
  font-size: 12px;
  font-weight: normal; }

.btnRed, .btnRed:hover {
  background-color: #b73030 !important;
  border: 0;
  border-bottom: 2px solid #b73030;
  border: 0px;
  padding: 5px 10px;
  margin-top: 0px;
  display: inline-block;
  color: #FFFFFF !important;
  font-size: 12px;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px; }

.btnRed.btn-large {
  padding: 8px 20px;
  text-align: center;
  font-size: 12px; }

.email-Icon-detail:hover {
  background-color: #F6989F !important; }

.email-Icon-detail {
  background-color: #FFAFB5;
  padding-left: 7px;
  padding-right: 7px; }

.detail-icon-cont {
  font-size: 12px;
  padding: 6px;
  border-radius: 3px;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  color: #ffffff; }

.DetailName {
  padding-top: 0px;
  border-bottom: 3px double #e4e4e4;
  padding: 10px;
  padding-top: 5px;
  padding-left: 20px;
  color: #8a8a8a !important;
  font-weight: bold;
  font-size: 12px;
  line-height: normal !important; }

.itinerariesCont {
  color: #222222 !important;
  font-weight: bold;
  height: 40px;
  font-size: 12px;
  line-height: 40px;
  overflow: hidden; }
  .itinerariesCont .block-itiner {
    padding-left: 10px;
    margin-left: 80px;
    background-color: #e4e4e4 !important;
    min-height: 32px;
    line-height: normal;
    vertical-align: middle;
    display: table-cell;
    height: 40px; }
  .itinerariesCont .DayItin {
    color: red !important;
    margin-right: 5px;
    float: left;
    height: 100%;
    line-height: 40px;
    text-align: center; }

@media screen and (max-width: 767px) {
  .itinerariesCont .block-itiner {
    margin-left: 100px;
    padding-left: 0;
    font-size: 12px;
    text-align: right; } }

@media (min-width: 320px) and (max-width: 767px) {
  .table-price .opsi-tour {
    padding-left: 0px; }

  .label-desc {
    margin-top: 0; }

  .date-select {
    display: inherit; }

  }
.itineraryItem img {
  margin-right: 10px;
  clear: both; }

.detailList {
  margin: 15px; }
  .detailList ul {
    margin-left: 20px;
    list-style-type: disc;
    list-style-position: inside; }

.detailList ul > li {
  list-style: disc !important; }

.line {
  margin: 10px 0 10px 0;
  border-bottom: solid 1px #dadada;
  height: 0; }

ul.otherPackage li {
  padding-left: 0px;
  border-bottom: 1px solid #e4e4e4; }

.tagpromo-list {
  margin-top: -25px;
  margin-left: 0; }

.price-detail {
  border: solid 1px #ddd;
  text-align: center; }
  .price-detail .btn {
    width: 100%;
    margin: 5px 0; }

.detail-right-panel {
  background-color: #FFF !important;
  z-index: 4;
  padding-left: 0; }
  .detail-right-panel .share {
    width: 100%;
    display: block;
    text-align: center;
    line-height: 36px; }
  .detail-right-panel .print, .detail-right-panel .sendtofriend {
    width: 49%;
    text-align: center;
    display: inline-block;
    line-height: 36px;
    font-size: 12px; }
  .detail-right-panel .print {
    border-right: solid 1px #ddd; }

.package-review {
  text-align: center; }
  .package-review h2 {
    margin: 10px 0 0;
    color: #009ada;
    font-size: 12px;
    font-weight: bold;
    line-height: normal; }
  .package-review .rating {
    font-size: 12px;
    color: #009ada;
    font-weight: bold;
    line-height: 35px; }
  .package-review .scale {
    font-size: 10px;
    font-weight: bold;
    line-height: 10px; }
  .package-review .count {
    color: #009ada; }

.bg-rating {
  height: 13px;
  background-color: #ededed; }

.ratingfill {
  height: 13px;
  background-color: #009ada;
  display: block; }

div.star-rating {
  background: url(../i/rating.png) no-repeat 0 0px;
  display: inline-block;
  width: 20px;
  height: 20px;
  vertical-align: middle;
  background-size: 20px;
  background-position: 0 0px;
  border: 0; }

div.star-rating-on {
  background-position: 0 -20px !important; }

.reviewlist {
  border-left: solid 1px #ddd;
  border-top: 0;
  min-height: 250px; }
  .reviewlist p {
    margin: 5px 0 10px; }

@media only screen and (max-width: 767px) {
  .reviewlist {
    border-left: 0;
    border-top: solid 1px #ddd;
    padding-top: 10px; } }


.box-border {
  border: solid 1px #ddd;
  border-top: solid 1px transparent;
  background: #fcfcfc;
  box-shadow: inset 0px -10px 10px -5px rgba(230, 230, 230, 0.8); }

.content_tour .panel-default {
  border: solid 1px #ddd;
  margin-right: 10px; }
.content_tour .panel-heading {
  border: 0; }
.content_tour .panel-collapse .panel-body {
  padding-left: 15px !important;
  padding-right: 15px !important; }
.content_tour .panel-default.active .sub_panel_title:after {
  content: "\f106"; }
.content_tour .panel-default.active .panel-heading {
  margin-top: 10px;
  border-bottom: double  #ddd; }

@media (max-width: 767px) {
  .divCollapse .panel-default {
    margin-right: 0px; } }
#divAvailability ul.nav li {
  float: left;
  line-height: 36px;
  border: 0 !important; }
  #divAvailability ul.nav li a {
    display: inline-block;
    border: solid 1px #DDD;
    border-radius: 5px;
    margin-left: 5px;
    text-align: center; }
  #divAvailability ul.nav li a.active {
    color: #FFF !important;
    background-color: #009ada !important; }
  #divAvailability ul.nav li select {
    display: none; }
#divAvailability label {
  margin-right: 5px; }

@media (min-width: 768px) {
  #divAvailability .form-group label {
    margin-left: 5px; } }
@media only screen and (max-width: 767px) {
  #divAvailability ul.nav li a {
    display: none; }
  #divAvailability ul.nav li select {
    display: inline;
    border-radius: 5px;
    margin-left: 5px; } }
#booksummary {
  background-color: #FFF;
  z-index: 4;
  border: solid 1px #DDD;
  box-shadow: 3px 5px 0px #d9d9d9; }
  #booksummary .collapse.in {
    display: block !important; }

#bedconfig {
  display: inline-block; }

#pricedetail {
  border-bottom: solid 1px #DDD; }

.displayStatic {
  position: static !important; }




.optionTitle h2 {
  font-size: 12px;
  line-height: 14px;
  color: #009ada !important;
  margin: 0 0 2px 0; }

@media only screen and (min-width: 768px) {
  .optionTitle {
    float: left; }

  .optionSelect {
    float: right; } }
@media only screen and (max-width: 768px) {
  .panel-title {
    text-align: left; } }
@media only screen and (max-width: 767px) {



.summary-package .btn_large {
  margin-bottom: 10px; }

.drawer {
  border-bottom: solid 10px #009ada;
  background-color: transparent; }
  .drawer a {
    display: inline-block;
    width: 50px;
    height: 25px;
    background-color: #009ada !important;
    border-top-left-radius: 25px;
    border-top-right-radius: 25px;
    color: #FFF !important;
    font-size: 12px;
    vertical-align: bottom; }

@media only screen and (max-width: 767px) {
  .detail-right-panel {
    position: static !important;
    padding-left: 15px; }

  #booksummary {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    max-height: calc(100% - 45px);
    overflow-y: auto;
    background-color: transparent;
    border: 0; }
    #booksummary #bookingSummary {
      display: none; }

  .summary-package {
    background-color: #e8f6fc; }
    .summary-package .fa {
      font-size: 12px; }
    .summary-package #grandtotal {
      line-height: 34px; }

    .summary-package .t-price {
      vertical-align: middle;
      line-height: 44px; } }


</style>


<script>

  function printURL(url,x,y) {
    url = url+"?"+"id="+x+"&"+"id_package="+y;
    var printWindow = window.open( url);
    printWindow.print();
};
</script>

</head>
<body>

<div id="wrapper">
<div id="content-page">
<div class="container" >
<button class="button" style="border:0px; background-color: transparent;"><p style="margin:5 5 5 25;font-family: Verdana, Arial, Helvetica;font-size: 65%;color: #333333;">
<img src="https://www.2canholiday.com/assets/i/printpage.gif" width="16" height="16" border="0" align="absmiddle" style="cursor:pointer"><a style="cursor:pointer" onClick="printURL('printitinerary.php',<?php echo $_GET['id']; ?>,<?php echo $_GET['id_package']; ?>)">PRINT ITINERARY </a></p></button>

<button class="button" style="border:0px; background-color: transparent;"><p style="margin:5 5 5 25;font-family: Verdana, Arial, Helvetica;font-size: 65%;color: #333333;">
<img src="https://www.2canholiday.com/assets/i/printpage.gif" width="16" height="16" border="0" align="absmiddle" style="cursor:pointer"><a style="cursor:pointer" onClick="printURL('printprice.php',<?php echo $_GET['id']; ?>,<?php echo $_GET['id_package']; ?>)">PRINT PRICE </a></p></button>

<button class="button" style="border:0px; background-color: transparent;"><p style="margin:5 5 5 25;font-family: Verdana, Arial, Helvetica;font-size: 65%;color: #333333;">
<img src="https://www.2canholiday.com/assets/i/printpage.gif" width="16" height="16" border="0" align="absmiddle" style="cursor:pointer"><a style="cursor:pointer" onClick="printURL('printall.php',<?php echo $_GET['id']; ?>,<?php echo $_GET['id_package']; ?>)">PRINT ALL </a></p></button>
</div>
</div>
</div>
<!-- <table width="100%" border="0" cellspacing="0" cellpadding="0" >
	<tr>
		<td align="center"><img src="assets/i/performalogo.png" border="0" vspace="10" height="30%"></td>
	</tr>
</table> -->
<div id="wrapper">
<div id="content-page">
<div class="container" >
	<div class="content_tour" itemscope itemtype="http://schema.org/Product">
        
		<!--<div id="row">
		    <div class="banner-head-tour">
        <picture>
        <?php 
          // echo $row['name'];
          // echo "
          // <source srcset='https://2canholiday.com/".$row['img']."' media='(max-width:640px)'>
          
          // <source srcset='https://2canholiday.com/".$row['img_head']."'>
          
          // <img src='https://2canholiday.com/".$row['img']."' class='img-responsive' />
          // ";
        ?>
      </picture>
      <div class=tag-promo>
      
    </div>
    <div class="tagpromo tagpromo-list" style="background:url('assets/i/tour-package.png') no-repeat scroll 0 0;"></div>
  </div>
	
        </div>-->
                              <div class="col_opsi">
                                <div class=scrollPanel>
                                  <div class="content">
                                   <div class="row">
                                    <img src="assets/i/copLogo4.png">
                                    <div style="margin-left:2%;">

                                      <?php
                                      echo "<div class= title_detail_tour>
                                      <br>
                                      <center><h1 style='font-size:25px;'>".$row['tour_name']."
                                      </h1></center></br>
                                      <div class='desc'>
                                      <p itemprop='description'><p style='font-size:14px;'>".$row['description']."<br></p></p>
                                      </div>
                                      </div>";

                                      $duration = $row['duration_tour'] - 1;

                                      echo"<div class='desc' style='font-size:12px;padding-bottom:1%;'>
                                      <div class='bold'><strong>Tour Detail</strong></div>
                                      <div>
                                      <table width='100%' class='table-book'>
                                      <tr>
                                      <td width='100'>Tour Duration</td>
                                      <td width='10'> : </td>
                                      <td>".$duration." malam</td>

                                      <td width='100'>Flight</td>
                                      <td> : </td>
                                      <td valign='top' align='left'>Belum termasuk
                                      </td>

                                      </tr>
                                      <tr>
                                      <td width='100'>Minumum Pax</td>
                                      <td> : </td>
                                      <td>".$row['minperson']." orang</td>

                                      <td width='100'>Departure</td>
                                      <td> : </td>
                                      <td>".$row['departure']."</td>
                                      </tr>
                                      <tr>
                                      <td width='100'>Category</td>
                                      <td> : </td>
                                      <td>".$row['category']."</td>
                                      <td width='100'>Tour Type</td>
                                      <td> : </td>
                                      <td>".$row['tour_type']."</td>
                                      </tr>

                                      </table>
                                      </div>
                                      </div>";

                                      $query_itinerary2 = "SELECT * FROM itinerary WHERE tour_package =".$row['id']." ORDER BY day ASC";
                                      $rs_itinerary2=mysqli_query($con,$query_itinerary2);
                                      $countImg = 0;

                                       echo "<div class='class='col-xs-12 col-sm-6 col-md-4 col-lg-4'>
                                       <div class='img-wrapper'>";
                                      while ($row_itinerary2 = mysqli_fetch_array($rs_itinerary2)) {
                                       
                                        if($row_itinerary2['img']!='' && $countImg!=5){
                                          echo "<img src='".$row_itinerary2['img']."' style='height:100px;width:200px;margin-right:10px'>";
                                          $countImg = $countImg + 1;
                                        }
                                        

                                      }
                                      echo "</div></br>
                                        </div>";
                                      echo "</div></br>";
                                      ?>


                                    </div>
                                  </div>

                <div class=container-fluid style='padding-bottom:20px;'>
    
					                   
                        
				                                
                            <div class="col_opsi">
                            	
                            <div class="panel-heading">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseItin">
                                <h2 class="panel-title sub_panel_title" style="font-size:12px;">
                                    ITINERARIES
                                </h2>
                                </a>
                            </div>
                            <div id="collapseItin" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <table >   
                                       <?php

                                          $query_itinerary = "SELECT * FROM itinerary WHERE tour_package =".$row['id']." ORDER BY day ASC";
                                          $rs_itinerary=mysqli_query($con,$query_itinerary);

                                          echo $query_itinerary;
                                    
                                           while ($row_itinerary = mysqli_fetch_array($rs_itinerary)) {
                                            $bld = '';
                                            if($row_itinerary['breakfast']!=0 or $row_itinerary['lunch']!=0 or $row_itinerary['dinner']!=0){
                                              $bld = $bld . " (";
                                            }
                                            
                                            if($row_itinerary['breakfast']!=0){
                                              $bld = $bld . " B";
                                            }else{
                                              $bld = $bld . '';
                                            }

                                            if($row_itinerary['lunch']!=0){
                                              $bld = $bld . " + L";
                                            }else{
                                              $bld = $bld . '';
                                            }

                                            if($row_itinerary['dinner']!=0){
                                              $bld = $bld . " + D ";
                                            }else{
                                              $bld = $bld . '';
                                            }
                                            if($row_itinerary['breakfast']!=0 or $row_itinerary['lunch']!=0 or $row_itinerary['dinner']!=0){
                                              $bld = $bld . " )";
                                            }
                                                        echo"<tr>
                                                            <td style='margin-top:-10px;'>
                                                            <div class='itinerariesCont' style='margin-top:-5px;'>
                                                                <div class='DayItin' style='font-size:12px;'>Day ".$row_itinerary['day']." - ".$row_itinerary['name'].$bld."</div>
                                                            </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><p style='font-size:12px; margin-top:-15px;'>".$row_itinerary['description']."</p>
                                                            </td>
                                                        </tr>";
                                                        }
                                                       ?> 
                                                    </table>
                                                </div>
                                            </div>
                                     
                                        <?php
                                          $query_inclusion = "SELECT * FROM inclusion WHERE tour_package =".$row['id'];
                                          $rs_inclusion=mysqli_query($con,$query_inclusion);
                                          $row_inclusion = mysqli_fetch_array($rs_inclusion);

                                          $query_exclusion = "SELECT * FROM exclusion WHERE tour_package =".$row['id'];
                                          $rs_exclusion=mysqli_query($con,$query_exclusion);
                                          $row_exclusion = mysqli_fetch_array($rs_exclusion);
                                          $query_termsandconditions = "SELECT * FROM termsandconditions WHERE tour_package =".$row['id'];
                                          $rs_termsandconditions=mysqli_query($con,$query_termsandconditions);
                                          $row_termsandconditions = mysqli_fetch_array($rs_termsandconditions);
                                        ?>

                                          <?php
                          $query_package = "SELECT * FROM tour_price_package WHERE tour_package = ".$row['id'];
                          $rs_package=mysqli_query($con,$query_package);
                          
                          $cekS=0;
                          $cekB=0;
                          $cekD=0;
                          while ($row_package = mysqli_fetch_array($rs_package)) {
                            if($row_package['price_package']==1){
                              $cekS=1;
                            }elseif($row_package['price_package']==2){
                              $cekB=1;
                            }else{
                              $cekD=1;
                            }

                          } ?> 
                              

                           

                            <div class="container-fluid" style="margin-top:1%;padding-bottom: 5%;">

                            <?php 

                              if($cekS==1 or $cekB==1 or $cekD==1){
                               echo "<div class='bold' style='font-size: 12px;margin-top: 5px;'><strong>Pilihan Harga :</strong></div>";
                              }
                            ?>  
                              <div id="home" class="tab-pane fade in active">

                                <form name="formOption"> <div class="container-fluid
                                  table-price" style="color:#555555 !important;font-size:12px;"> <?php $query_price =
                                  "SELECT * FROM price_package";
                                  $rs_price=mysqli_query($con,$query_price); $countx=0;
                                  while($row_price = mysqli_fetch_array($rs_price)){ $countx =
                                    $countx + 1; $tempx = "row price_package".$row_price['id'];
                                     if($countx<2){ 
                                      echo "<div class='".$tempx."'id='pricePackage".$row_price['id']."'>"; }
                                      else{ 
                                        echo "<divclass='".$tempx."' id='pricePackage".$row_price['id']."' style='display:none;'>"; 
                                      } 
                                    $query_price_package = "SELECT * FROM tour_price_package WHERE tour_package = ".$row['id'];

                                    $rs_price_package=mysqli_query($con,$query_price_package);
                                    $title = "";
                                    $countTitle = 1;
                                    while ($row_package = mysqli_fetch_array($rs_price_package)) {
                                      
                                      if($cekS!=0 or $cekB!=0 or $cekD!=0){
                                        if($row_package['price_package']==1){
                                          $title = "Super Save ".$countTitle; 
                                        }elseif($row_package['price_package']==2){
                                          $title = "Best Deal ".$countTitle; 
                                        }else{
                                          $title = "Deluxe ".$countTitle; 
                                        }

                                        $query_price_detail = "SELECT * FROM tour_price_detail WHERE tour_price_package = ".$row_package['id'];
                                        $rs_price_detail=mysqli_query($con,$query_price_detail);
                                        


                                        echo"<table >
                                        

                                        <div class='text-opsi'>
                                        <tr style='text-align:left'>
                                        <strong class='judul'>".$title." - ".$row_package['name']."</strong>)

                                        </tr>";

                                        echo"<div >

                                        <div class=container-fluid>
                                        <tr>";
                                        $tempSelect=0;
                                        while($row_price_detail = mysqli_fetch_array($rs_price_detail) and $tempSelect!=3){
                                          $query_range = "SELECT * FROM performa_price_range";
                                          $rs_range=mysqli_query($con,$query_range);
                                          $pId = 0;

                                          while($row_range = mysqli_fetch_array($rs_range)){
                                            if($row_range['price2']==1){
                                              if($row_price_detail['price']<=$row_range['price1']){
                                                $pId = $row_range['id'];
                                              }
                                            }else if($row_range['price2']==0){
                                              if($row_price_detail['price']>=$row_range['price1']){
                                                $pId = $row_range['id'];
                                              }

                                            }else{
                                              if($row_price_detail['price']>$row_range['price1'] && $row_price_detail['price']<=$row_range['price2']){
                                                $pId = $row_range['id'];
                                              }

                                            }
                                          }
                                          $query_performa = "SELECT * FROM performa_price WHERE performa_price_range=".$pId." AND tour_package = ".$row['id'];
                                          $rs_performa=mysqli_query($con,$query_performa);
                                          $row_performa = mysqli_fetch_array($rs_performa);

                                          $query_k = "SELECT * FROM kurs_bank WHERE id = ".$row_price_detail['kurs'];
                                          $rs_k=mysqli_query($con,$query_k);
                                          $row_k = mysqli_fetch_array($rs_k);

                                          $query_kurs = "SELECT * FROM kurs_live WHERE name LIKE '".$row_k['name']."'";
                                          $rs_kurs=mysqli_query($con,$query_kurs);
                                          $row_kurs = mysqli_fetch_array($rs_kurs);

                                          if(!isset($row_kurs['name'])){
                                            $value_kurs = 1;
                                          }else{
                                            $value_kurs = $row_kurs['jual'];
                                          }

                                          $tempPerforma = 0;
                                          $totalPrice = 0;

                                          if($row_performa['option_price'] == 1){
                                            $tempPerforma = $row_performa['persentase'] * ($row_price_detail['price']*$value_kurs) / 100;
                                          }elseif ($row_performa['option_price'] == 2) {
                                            $tempPerforma = $row_performa['nominal'];
                                          }else{
                                            $tempPerforma = $row_performa['agentcom'];
                                          }
                                          $totalPrice = ($row_price_detail['price']*$value_kurs) + $tempPerforma;

                                          echo "<td>
                                          <div class=fleft>
                                          <div class='paxtogo' style='color:black !important;' name='paxtogo".$countTitle."' id='paxtogo".$tempSelect."' value=".$row_price_detail['price'].">".$row_price_detail['person']." TO GO</div>

                                          </div>
                                          <div style='margin-left:60px;font-size:13px;'>Starting (/pax nett): <span style='color:red !important;'>IDR ".number_format($totalPrice, 0, ".", ".")."</span>

                                          </div>

                                          </td>";
                                          $tempSelect = $tempSelect+1;
                                        }

                                        echo"</tr></div>";

                                      }
                                      $countTitle = $countTitle + 1;
                                      echo "</div></table>";
                                    }
                                  

                                  }

                                  ?>
                                    </div>

                                  </div>
                            
                              
                                
                                    <div class="panel panel-default active">
                                        <div class="panel-heading">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseInclusion">
                                            <h2 class="panel-title sub_panel_title" style="font-size: 12px;">
                                               INCLUSIONS
                                            </h2>
                                            </a>
                                        </div>
                                        <div id="collapseInclusion" class="detailList panel-collapse collapse in">
                                            <p></p><ul>
                                              <?php
                                                $splits = explode("\n", $row_inclusion['name']);
                                                foreach($splits as $name) {
                                                    echo "<li style='font-size:10px;'>".$name."</li>";
                                                }
                                              ?>
                                            </ul><p></p>

                                        </div>
                                   
                                    
                                 
                                        <div class="panel-heading">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseExclusion">
                                            <h2 class="panel-title sub_panel_title" style="font-size: 12px;">
                                                EXCLUSIONS
                                            </h2>
                                            </a>
                                        </div>
                                        <div id="collapseExclusion" class="detailList panel-collapse collapse in">
                                            <p></p><ul>
                                               <?php
                                                $splits = explode("\n", $row_exclusion['name']);
                                                foreach($splits as $name) {
                                                    echo "<li style='font-size:10px;'>".$name."</li>";
                                                }
                                              ?>
                                            </ul><p></p>

                                        </div>
                                	
	                        	        
                                        <?php
                                        echo "<div class='panel-heading'>
                                        <a data-toggle='collapse' data-parent='#accordion' href='#collapseRemark'>
                                        <h2 class='panel-title sub_panel_title' style='font-size: 12px;'>
                                        Remarks
                                        </h2>
                                        </a>
                                        </div>
                                        <div id='collapseRemark' class='detailList panel-collapse collapse in'>";
                                        $query_remark = "SELECT * FROM remark WHERE tour_package =".$row['id'];
                                        $rs_remark=mysqli_query($con,$query_remark);

                                        while($row_remark = mysqli_fetch_array($rs_remark)){
                                          echo"<p style='font-size:10px;'>".$row_remark['title']." : </p><ul>";
                                          $splits = explode("\n", $row_remark['description']);
                                          foreach($splits as $name) {
                                            echo "<li style='font-size:10px;'>".$name."</li>";
                                          }
                                          echo"</ul><p></p>";
                                        }

                                        echo"</div>";
                                        ?>
                                    
                                        <div class="panel-heading">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTerm">
                                            <h2 class="panel-title sub_panel_title" style="font-size: 12px;">
                                                TERMS AND CONDITIONS
                                            </h2>
                                            </a>
                                        </div>
                                        <div id="collapseTerm" class="detailList panel-collapse collapse in">
                                            <p></p><ul>
                                              <?php
                                               $splits = explode("\n", $row_termsandconditions['name']);
                                                foreach($splits as $name) {
                                                    echo "<li style='font-size:10px;'>".$name."</li>";
                                                }
                                              ?>
                                            </ul><p></p>

                                        </div>
                                    </div>
	                                        	
                         
               
		    </div>
		    <br />
		    </div>
		</div>
		

    </div>
</div>
</div>
</div>
</div>
</div> <!--End Wrapper-->

</body>
</html>