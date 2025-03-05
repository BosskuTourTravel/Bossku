$(document).ready(function(){

	$('body').on("click", function (e) {
	    if(e.target.id!="FilterArea" && e.target.id!="filtertype" && !$(e.target).hasClass('slctype') 
	        && !$(e.target).hasClass('slcttype') && !$(e.target).hasClass('caret')
	        && !$(e.target).closest("ul").hasClass('slcLocation')
	        && !$(e.target).closest("ul").hasClass('slcType')
	        && !$(e.target).closest("ul").hasClass('nav-tabs'))
	    {
	        $("#DivFilterArea,#DivFilterDate,#DivFilterDeparture").hide();	 
	        //$('body').css('overflow-y','visible');       
	    }
	});	
	loadLazy();
	var imageLoading=new Image(); 
	imageLoading.src=g_DomainName+'/assets/i/loading.gif';
	$(window).scroll(
        {
            previousTop: 0
        }, 
        function () {
            if($(window).width()<768)
            {
                var currentTop = $(window).scrollTop();
                if (currentTop <= this.previousTop ||  currentTop==0) {
                    $('.navbar-logo .logo-mobile,.ico-search-mobile').show();
                    $('div.dropdown-search').addClass('hidden-xs');
                } else {
                    $('.navbar-logo .logo-mobile,.ico-search-mobile').hide();
                    $('div.dropdown-search').removeClass('hidden-xs');
                }
                this.previousTop = currentTop;
            }
        }
    );
	$('.btnSearchBack').on('click',function(){changeTab(2,0)})
});

// JavaScript Document
function changeTab(tab,list){
	$('.searchModal .modal-title label').removeClass("tab-active");
	if(tab == 1){
		$('.panel-destinations,.btnSearchBack').show();
		$('.divSearchDestination').addClass('open');
		$('.panel-holiday,.panel-promo').hide();
		$('div[data-country=dest'+list+']').collapse("show");
	}else if(tab == 2){
		$('.panel-destinations,.btnSearchBack,.panel-promo').hide();
		$('.divSearchDestination').removeClass('open');
		$('.panel-holiday').show();
		$('.panel-holiday .lazy').lazyload();
	}
	else if(tab == 3){
		$('.panel-destinations,.panel-holiday').hide();
		$('.divSearchDestination').addClass('open');
		$('.panel-promo,.btnSearchBack').show();
		$('.panel-promo .lazy').lazyload();
	}
}

function loadLazy() {
	$(".lazy").lazyload();
}



function opendropdown(id) {
	//$('.hide:not(#'+id+')').hide();
	$("#"+id).toggle();
	//opennavdetail('directory');
}




function openWindow(url,name,width,height) {
	var left = (screen.width - width) / 2;
	var top = (screen.height - height) / 4;
	var myFeatures = "toolbar=no,location=no,status=yes,directories=no,menubar=no,scrollbars=yes,resizable=yes,width=" + width + ",height=" + height + ",top=" + top + ",left=" + left;
	//var myFeatures = "toolbar=no,location=no,status=yes,directories=no,menubar=no,scrollbars=yes,resizable=yes,fullscreen=1";
	var myWindow = window.open(url,name,myFeatures);
}



function EscapeURL(str)
{
	var str = str;
	if(str != "" && str != null && str != "null"){
		str = str.replace(/ /g,"-");
		str = str.replace(/&amp/g,"dan");
		str = str.replace(/;/g,"");
		str = str.replace(/&/g,"dan");
		str = str.replace(/,/g,"");
		str = str.replace(/\\/g,"");
		str = str.toLowerCase();
	}
	return str;	
}

function EscapeURL2(str)
{
	var str = str;
	str = str.replace(/ /g,"-");
	str = str.replace(/&amp/g,"dan");
	str = str.replace(/;/g,"");
	str = str.replace(/&/g,"dan");
	str = str.replace(/\\/g,"");
	str = str.toLowerCase();
	return str;	
}

function formatDate(date,type){
	var months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
	var myDays = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
	//console.log(date);
	var date = new Date(date);
	//console.log(date);
	var day = date.getDate();
	var month = date.getMonth();
	var thisDay = date.getDay(),
		thisDay = myDays[thisDay];
	var yy = date.getYear();
	var year = (yy < 1000) ? yy + 1900 : yy;
	
	if(type===1){
		return thisDay + ', ' + day + ' ' + months[month] + ' ' + year;
	}else if(type===2){
		return day + ' ' + months[month] + ' ' + year;
	}
}

function convertDate(date,day){
	//var dateParts = date.split(/(\d{1,2})\/(\d{1,2})\/(\d{4})/);
	//date=dateParts[3] + "-" + dateParts[2] + "-" + dateParts[1];
	var newdate = new Date(date);
	newdate.setDate(newdate.getDate() + parseInt(day));
	return newdate;
}

function textCounter(field,cntfield,maxlimit) {
	if (field.value.length > maxlimit){ // if too long...trim it!
		field.value = field.value.substring(0, maxlimit);
		// otherwise, update 'characters left' counter
	}else{
		cntfield.innerHTML = maxlimit - field.value.length;
	}
}


function toggleMe(id) {
	$(id).slideToggle('slow');
}

function showMe(id) {
	$(id).show();
}

function hideMe(id) {
	$(id).hide();
}
function checktags(chkstr) {
		if (chkstr.indexOf("i>")==-1 && chkstr.indexOf("b>")==-1 && chkstr.indexOf("p>")==-1 && chkstr.indexOf("h1>")==-1 && chkstr.indexOf("h2>")==-1 && chkstr.indexOf("h3>")==-1 && chkstr.indexOf("h4>")==-1 && chkstr.indexOf("h5>")==-1 && chkstr.indexOf("h6>")==-1 && chkstr.indexOf("body>")==-1 && chkstr.indexOf("html>")==-1 && chkstr.indexOf("br>")==-1 && chkstr.indexOf("hr>")==-1 && chkstr.indexOf("font>")==-1 && chkstr.indexOf("script>")==-1 && chkstr.indexOf("-->>")==-1 && chkstr.indexOf("<\!--")==-1 && chkstr.indexOf("form>")==-1 && chkstr.indexOf("div>")==-1 && chkstr.indexOf("u>")==-1 && chkstr.indexOf("ol>")==-1 && chkstr.indexOf("ul>")==-1 && chkstr.indexOf("select>")==-1 && chkstr.indexOf("<input")==-1 && chkstr.indexOf("location.href")==-1 && chkstr.indexOf("response.redirect")==-1 && chkstr.indexOf("<%")==-1 && chkstr.indexOf("http")==-1 && chkstr.indexOf("ftp")==-1 && chkstr.indexOf(".js")==-1 && chkstr.indexOf("%>")==-1)
		{
			return true;
		}
		else
		{
			return false;
		}

}

function checkname(name) {
    if (name.indexOf("wedsite")!=-1 || name.indexOf("website")!=-1 || name.indexOf(".info")!=-1 || name.indexOf(".biz")!=-1 || name.indexOf(".or")!=-1 || name.indexOf(".net")!=-1 || name.indexOf(".co")!=-1 || name.indexOf("www")!=-1 || name.indexOf("@")!=-1 || name.indexOf("neowed")!=-1 || name.indexOf("menaravisi")!=-1 || name.indexOf("weddingku")!=-1 || name.indexOf("test")!=-1 || name.indexOf("hjkl")!=-1 || name.indexOf("yuio")!=-1 || name.indexOf("zxcv")!=-1 || name.indexOf("asdf")!=-1 || name.indexOf("qwer")!=-1 || name.indexOf("#")!=-1 || name.indexOf("%")!=-1 || name.indexOf("&")!=-1 || name.indexOf("*")!=-1 || name.indexOf("/")!=-1)
		return false;
	else
		return true;
}

var numb = /[0-9]/; 
var numbdec = /[0-9.,]/; 
var numbtime = /[0-9:.]/; 
var numbphone = /[0-9()-]/; 
var lwr = /[a-z]/; 
var upr = /[A-Z]/; 
var alpha = /a-zA-Z]/; //not checked 
var alphaNum = /a-zA-Z0-9/; //not checked 
 
function onKeyPressAcceptValues(e, reg){ 
        var key = window.event ? e.keyCode : e.which; 
        //permit backspace, tab, delete, arrow buttons, (key == 0 for arrow keys) 

        if(key == 8 || key == 9 || key == 46 ||(key>32 && key <41 ||key == 0)){ 
                return true; 
        } 
        var keychar = String.fromCharCode(key); 
        return reg.test(keychar); 
} 

function isNumberKey(parm) {return onKeyPressAcceptValues(parm,numb);} 
function isTimeKey(parm) {return onKeyPressAcceptValues(parm,numbtime);} 
function isFloatKey(parm) {return onKeyPressAcceptValues(parm,numbdec);} 
function isPhoneKey(parm) {return onKeyPressAcceptValues(parm,numbphone);} 
function isLowerKey(parm) {return onKeyPressAcceptValues(parm,lwr);} 
function isUpperKey(parm) {return onKeyPressAcceptValues(parm,upr);} 
function isAlphaKey(parm) {return onKeyPressAcceptValues(parm,alpha);} 
function isAlphanumKey(parm) {return onKeyPressAcceptValues(parm,alphaNum);} 


function loadCity(id,divname){
	var strURL= g_Domainname+"/ajax/loadCity.asp?id=" + id;
	$("#"+divname).html(strLoading).load(strURL);	
}

Number.prototype.formatMoney = function(c, d, t){
var n = this, 
    c = isNaN(c = Math.abs(c)) ? 2 : c, 
    d = d == undefined ? "." : d, 
    t = t == undefined ? "," : t, 
    s = n < 0 ? "-" : "", 
    i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", 
    j = (j = i.length) > 3 ? j % 3 : 0;
   return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
 };

function formatPrice(value,symbol){
	if(value != undefined){
			value += '';
			x = value.split('.');
			x1 = x[0];
			x2 = x.length > 1 ? '.' + x[1] : '';
			var rgx = /(\d+)(\d{3})/;
			while (rgx.test(x1)) {
				x1 = x1.replace(rgx, '$1' + '.' + '$2');
			}
			return symbol+' '+x1 + x2;		
	}
}

function kNumber(num) {
    return num > 999 ? (num/1000).toFixed(1) + 'k' : num
}

$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});
function datediff(date1,date2) {
	var one_day=1000*60*60*24
	var date1=date1.split('/');
	var date2=date2.split('/');
	var date1=new Date(date1[2], date1[0]-1, date1[1])
	var date2=new Date(date2[2], date2[0]-1, date2[1])
	//Calculate difference btw the two dates, and convert to days
	datdiff = (Math.ceil((date2.getTime()-date1.getTime())/(one_day)))
	return datdiff;
}

function addDays(date, days) {
    var result = new Date(date);
    result.setDate(result.getDate() + days);
    return result;
}
/*
function addRecord(ID,packageName,URL,valid,img,starting,loc,packageType)
{
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();
    if(dd<10) {
        dd='0'+dd
    } 
    if(mm<10) {
        mm='0'+mm
    } 
    today = yyyy+'-'+mm+'-'+dd;

    const dbPromise = idb.open('yuktravel-store', 1, upgradeDB => {
        upgradeDB.createObjectStore('package', {keyPath: ['id','type']});
    });
    dbPromise.then(db => {
        const tx = db.transaction('package', 'readwrite');
        tx.objectStore('package').put({
            id: ID,
            type:packageType,
            name:packageName,
            url: URL,
            validity:valid,
            imgURL:img,
            startingPrice:starting,
            location:loc,
            createDate:today
            
        });
        return tx.complete;
    });
}
*/
function processCache()
{
	$("img").each(function(){
		addToCache($(this).attr('src'));                
	})
	$(".lazy").each(function(){
		if($(this).attr('data-original')!="")
			addToCache($(this).attr('data-original'));                
	})
	$("link").each(function(){
		var request=$(this).attr('href');
		if(/\.css/.test(request)) addToCache(request);                
	})
	$("script").each(function(){
		var request=$(this).attr('src');
		if(/\.js/.test(request)) addToCache(request);                
	})
}

function addToCache(request)
{
    if(/\undefined/.test(request)==false)
    {
        caches.open('yuktravel-dynamicv2').then(function(cache) {
            fetch(request,{mode:'no-cors'}).then(function(response) {
                cache.put(request, response.clone()).catch(function(error){});
            }).catch(function(error) {
                //console.log('err:'+request);
            });
        })
    }
}

var isNotified=false;
var offlineNotify;
var offlineCheck = function(){
    fetch(g_DomainName+'/services/check.asp')
        .then(function(){
            if(offlineNotify) offlineNotify.close();
            isNotified=false;
        })
        .catch(function(){
            if(!isNotified) {
                isNotified=true;
                if(/\/offline/.test(window.location.href))
                    $("#netStatus").html('Anda sedang tidak terhubung ke internet namun Anda tetap dapat melihat kembali halaman yang pernah Anda buka sebelumnya.')
                else
                    offlineNotify=$.notify('<strong>Anda sedang tidak terhubung ke internet namun Anda tetap dapat melihat kembali halaman yang pernah Anda buka sebelumnya.</strong><br> <a href='+g_DomainName+'/offline class=text-danger>LIHAT</a>', { allow_dismiss: true, delay:30000 });
            }
        })
}

//setInterval(offlineCheck, 5000);