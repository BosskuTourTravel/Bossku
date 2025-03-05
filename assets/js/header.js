function sendContactUs(btn)
{
    var url=g_DomainName+'/win32/sendContactus.asp?send=1';
    if($('#txtname').val()=='')
    {
        alert("Isi nama Anda!");
        $('#txtname').focus();
        return false;
    }
    else
        url+="&txtname=" + $('#txtname').val();
    if($('#txtemail').val()=='')
    {
        alert("Isi email Anda!");
        $('#txtemail').focus();
        return false;
    }
    else
        url+="&txtemail=" + $('#txtemail').val();
    if($('#txtphone').val()=='')
    {
        alert("Isi nomor telepon Anda!");
        $('#txtphone').focus();
        return false;
    }
    else
        url+="&txtphone=" + $('#txtphone').val();
    if($('#txtdestination').val()=='')
    {
        alert("Isi destinasi yang Anda minati!");
        $('#txtdestination').focus();
        return false;
    }
    else
        url+="&txtdestination=" + $('#txtdestination').val();
    url+="&referer=" + escape(window.location.href);
	url+="&captcha="+ grecaptcha.getResponse();
    btn.html("Sending...");
    $.get(url,function(msg){
        if(msg=="")
        {
            $('#divthankyou').show();
            $('#formcallus').hide();
            var image = new Image(1, 1); 
            image.src = "//www.googleadservices.com/pagead/conversion/1000404444/?label=2v4bCO6lmHoQ3OuD3QM&script=0";
        }
        else
        {
            btn.val("SEND NOW");
            alert(msg);
        }
    });    
        
}

function checkSubscribe() {
	if(document.formSubscribe.txtEmailSubscribe.value=="" || document.formSubscribe.txtEmailSubscribe.value=="enter your email") {
        alert("Isi Email Anda!");
        document.formSubscribe.txtEmailSubscribe.focus();
        return false;
    }
    return true;
}
function checkSubscribeM() {
	if(document.formSubscribeM.txtEmailSubscribe.value=="" || document.formSubscribeM.txtEmailSubscribe.value=="enter your email") {
        alert("Isi Email Anda!");
        document.formSubscribeM.txtEmailSubscribe.focus();
        return false;
    }
    return true;
}

function toogleMenuNav()
{
    if($('#navbar').hasClass('in'))
    {
        $('.navbar-toggle').html('<span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>').css('padding','9px 10px');
    }
    else
    {
        $('.navbar-toggle').html('<img src='+g_DomainName+'/assets/i/ico-close.png style="width:20px" vspace=5>').css('padding','0 10px');
    }
    $('#dropdown-contact').removeClass('open');
     $('#icon-contact').html('<img src='+g_DomainName+'/assets/i/icon-call-white.png>');
    var windowHeight=$(window).height(); 
    if(windowHeight<532) $('body').toggleClass('overflow');
    $('#navbar').toggleClass('in');
    $('#navbar').css('max-height',windowHeight-$('.header-mobile').height()+'px');
}

function toggleContact()
{
    if($('#dropdown-contact').hasClass('open'))
        $('#icon-contact').html('<img src='+g_DomainName+'/assets/i/icon-call-white.png>');
    else
        $('#icon-contact').html('<img src='+g_DomainName+'/assets/i/ico-close.png id=imgContact style="width:20px;margin-top:12px">');
    $('#navbar').removeClass('in');
    $('.navbar-toggle').html('<span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>').css('padding','9px 10px');
    var windowHeight=$(window).height(); 
    if(windowHeight<773) $('body').toggleClass('overflow');
    $('#dropdown-contact').toggleClass('open');
    $('.dropdown-contact .content-brief').css('max-height',windowHeight-$('.header-mobile').height()+'px');
}

function closeMenuNav()
{
    $('#navbar').removeClass('in');
    $('.navbar-toggle').html('<span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>').css('padding','9px 10px');
}

function closeContact()
{
    $('#dropdown-contact').removeClass('open');
    $('#icon-contact').html('<img src='+g_DomainName+'/assets/i/icon-call-white.png>');
}

$( window ).resize(function() {
    $('#navbar').css('max-height',$(window).height()-$('.header-mobile').height()+'px');
    $('.dropdown-contact .content-brief').css('max-height',$(window).height()-$('.header-mobile').height()+'px');
});

$(document).ready(function(){

	$('body').on("click", function (e) {
	    if(!$(e.target).hasClass('navbar-toggle') && !$(e.target).hasClass('icon-bar') && e.target.id!='imgContact' && typeof $(e.target).attr('data-toggle')=='undefined')
	    {
	        if($('#navbar').hasClass('in')) 
	        {
	            closeMenuNav();
	        }
	        if($('#dropdown-contact').hasClass('open')) 
	        {
	            closeContact();
	        }
	        $('body').removeClass('overflow');
	    }
	}); 
	$(".navbar-mobile ul.collapse").on('show.bs.collapse', function(){
    	$(this).parent().addClass('active');
    }).on('hide.bs.collapse', function(){
    	$(this).parent().removeClass('active');
    });
	$('.dropdown-contact .dropdown-menu').on("click.bs.dropdown", function (e) { 
	    console.log($(e.target).parents("div.phone-number"));
	    if($(e.target).parents("div.phone-number").length==0 || /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)==false)
	    {
	        e.stopPropagation(); e.preventDefault();
	    }
	    
	}); 
});
