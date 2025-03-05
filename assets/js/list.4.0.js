$(document).ready(function(){
    locationlist = $('#slclocation').val();
    typelist = $('#slctype').val();
    if (strGroup!=0 || strCountry!=0)
        getNumPages(currentpage,strGroup,strCountry,strCity,strType);
    else
    {
        for(var i=1;i<5;i++)
        {
            $("#packageList"+i).owlCarousel({
                loop:true,
                autoplay:false,
                autoplayTimeout: 5000,
                autoplayHoverPause: true,
                nav:true,
                lazyLoad: true,
                dots:true,
                margin:5,
                responsiveClass:false,
                responsive:{
                  0:{
                    items:1
                  },
                  768:{
                    items:3
                  },
                  960:{
                    items:3
                  },
                  1300:{
                    items:4
                  }
                },
                    afterMove:function(){loadLazy();}
              });
        }
    }
    
    $("#filtertype").click(function(){
        $('.slc-filter').slideUp('fast');
    });

    $("#FilterArea").click(function(){
        $('.slc-filter').not(document.getElementById('DivFilterArea')).slideUp('fast');
        $("#DivFilterArea").slideToggle("fast",function(){
            slideFilter('FilterArea');
        });
    });
    
    $("#FilterPrice").click(function(){
        $('.slc-filter').not(document.getElementById('DivFilterPrice')).slideUp('fast');
        $("#DivFilterPrice").slideToggle("fast",function(){
            slideFilter('FilterPrice');
        });
    });
    
    /*$("#FilterDeparture").click(function(){
        $('.slc-filter').not(document.getElementById('DivFilterDeparture')).slideUp('fast');
        $("#DivFilterDeparture").slideToggle("fast",function(){
            slideFilter('FilterDeparture');
        });
    });
    
    $("#FilterDate").click(function(){
        $('.slc-filter').not(document.getElementById('DivFilterDate')).slideUp('fast');
        $("#DivFilterDate").slideToggle("fast",function(){
            
        });
    });
    $('#btnClearDate').hide();
    
    $("#FilterPrice").click(function(){
        $('.slc-filter').not(document.getElementById('DivFilterPrice')).slideUp('fast');
        $("#DivFilterPrice").slideToggle("fast",function(){
            slideFilter('FilterPrice');
        });
    });
    
    $("#FilterPax").click(function(){
        $('.slc-filter').not(document.getElementById('DivFilterPax')).slideUp('fast');
        $("#DivFilterPax").slideToggle("fast",function(){
            slideFilter('FilterPax');
        });
    });

    $('#dtTravel').dateRangePicker({
            inline: true,
            alwaysOpen:true,
            singleMonth: true,
            showTopbar:false,
            container: '#dtTravelC', 
            startDate:new Date(),
            customArrowPrevSymbol:'<i class="fa fa-chevron-left"></i>',
            customArrowNextSymbol:'<i class="fa fa-chevron-right"></i>'
            
        })
        .on('datepicker-first-date-selected', function(event, obj)
        {
            var dateObj=obj.date1;
            dtCheckIn=dateObj.getUTCFullYear()+'-'+(dateObj.getUTCMonth()+1)+'-'+dateObj.getUTCDate();
            $('#btnClearDate').show();
        })
        .on('datepicker-change',function(event,obj)
        {
            dtCheckIn=obj.value.split(' to ')[0];
            dtCheckOut=obj.value.split(' to ')[1];
            //$('#DivFilterDate').slideUp('slow');
        });
    $('.month-head th.prev').click(function(e){
        var selectedYear=$('table.month-head .year').html();
        var currentYear=(new Date()).getFullYear();
        if(selectedYear>currentYear)
        {
            selectedYear--;
            $('table.month-head .year').html(selectedYear);
            renderDepartureMonth();
        }
    });
    $('.month-head th.next').click(function(e){
        var selectedYear=$('table.month-head .year').html();
        selectedYear++;
        $('table.month-head .year').html(selectedYear);
        renderDepartureMonth();
    })
    
    
    $('.month-cell td').click(function(e){
        var $selectedMonth=$(this).find('div');
        if(!$selectedMonth.hasClass('disabled'))
        {
            $('.month-cell td div').removeClass('selected');
            $selectedMonth.addClass('selected');
            $('#departuremonth').val(('0'+$selectedMonth.attr('id').replace('month-','')).slice(-2));
            $('#departureyear').val($('table.month-head .year').html());
        }
    });
    renderDepartureMonth();
    */    
    $('#DivFilterArea li').click(function(e) {
        
        
    });
    $('#DivFilterDeparture li').click(onFilterAreaClick);
    
    $('#DivFilterType li').click(filterTypeClick);
    
    /*$('#est-price').slider({}).on('slide', function(e){
        var rangePrice=e.value;
        $('#min-price').val(rangePrice[0]);
        $('#max-price').val(rangePrice[1]);
    });
    */
    $( window ).resize(function(){setSticky()});
    setSticky(); 
    
    $('.imageGallery').cycle({
                fx: 'none',
                timeout: 5000,
                delay:  -5000
            });
    /*if (dtCheckIn!='' && dtCheckOut!='')  
        $('#dtTravel').data('dateRangePicker').setDateRange(dtCheckIn,dtCheckOut);*/
    
});

function renderDepartureMonth()
{
    var selectedYear=$('table.month-head .year').html();
    var currentYear=(new Date()).getFullYear();
    $('.month-cell td div').removeClass('selected').removeClass('disabled');
    if($('#departureyear').val()==selectedYear)
    {
        $('#month-'+$('#departuremonth').val()).addClass('selected');
    }
    if(selectedYear==currentYear)
    {
        var currentMonth=(new Date()).getMonth();
        for(var i=0;i<12;i++)
        {
            if(i<currentMonth)
            {
                $('.month-cell td div#month-'+(i+1)).addClass('disabled');
            }
        }
    }
}

function onFilterAreaClick($this)
{
    if(!$this.hasClass('more') && !$this.hasClass('less') && !$this.hasClass('close-btn'))
    {
        var slcLocation = $('#slclocation').val();
        var slcId = $this.data('id');
        var slcNewLocation = "";

        if (slcId == "all") {
            $('#slclocation').val('');
            if ($this.hasClass('selected')){
                $('#DivFilterArea li').removeClass('selected');
            }
            else {
                $('#DivFilterArea li').addClass('selected');
            }
        }
        else {
            var breadcrumb=$('ol.breadcrumb');
            $('ol.breadcrumb li.added').addClass('remove');
            breadcrumb.append('<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb" class="active added hidden"><span itemprop="title">'+titleCase($this.html())+'</span></li>');
            $('#DivFilterArea li').removeClass('selected');
            $('#slclocation').val(slcId);
            $('#DivFilterArea li[data-id="all"]').removeClass('selected');
            $this.addClass('selected');
        }
    }
}

function onFilterDepartureClick($this)
{
    if(!$this.hasClass('more') && !$this.hasClass('less') && !$this.hasClass('close-btn'))
    {
        var slcDeparture = $('#slcdeparture').val();
        var slcId = $this.data('id');
        var slcNewDeparture = "";
        
        if (slcId == "all") {
            $('#slcdeparture').val('');
            if ($this.hasClass('selected')){
                $('#DivFilterDeparture li').removeClass('selected');
            }
            else {
                $('#DivFilterDeparture li').addClass('selected');
            }
        }
        else {
            if ($('#DivFilterDeparture li[data-id="all"]').hasClass('selected')){
                $('#DivFilterDeparture li').removeClass('selected');
            }
            /*if (slcDeparture.indexOf(slcId) >= 0){
                slcNewDeparture = slcDeparture.replace(slcId,'');
            }
            else {
                slcNewDeparture = slcDeparture+','+slcId;
            }
            slcNewDeparture = slcNewDeparture.replace(',,',',');
            if (slcNewDeparture.substring(0, 1)==","){
                slcNewDeparture = slcNewDeparture.substring(1,slcNewDeparture.length);
            }
            if (slcNewDeparture.substring((slcNewDeparture.length)-1, slcNewDeparture.length)==","){
                slcNewDeparture = slcNewDeparture.substring(0,(slcNewDeparture.length)-1);
            }
            $('#slcdeparture').val(slcNewDeparture);*/
            
            $('#DivFilterDeparture li').removeClass('selected');
            $('#slcdeparture').val(slcId);
            
            $('#DivFilterDeparture li[data-id="all"]').removeClass('selected');
            if ($this.hasClass('selected')){
                $this.removeClass('selected');
            }
            else {
                $this.addClass('selected');
            }
        }
        
        
    }
}

function slideFilter(divID)
{
    if($(window).width()<768)
    {
        $('#Div'+divID+' .search-slcLocation').css('max-height',$(window).height()+'px');
        var display=$('#Div'+divID).css('display');
        if(display=='none')
        {
            $('.body-wrapper').css({'overflow-y':'hidden','height':'auto'}).addClass('modal-open');
        }
        else
        {
            $('.body-wrapper').css({'overflow-y':'hidden','height':$(window).height()}).addClass('modal-open');
        }
    }
    else
    {
        var wHeight=$(window).height()-$('#'+divID).offset().top-38;
        var elHeight=$('#Div'+divID+' .slcLocation').height()+10; 
        wHeight+=$(window).scrollTop();
        $('#Div'+divID+' .search-slcLocation').css('max-height',wHeight+'px');
    }
    /*var display=$('#'+divID).css('display');
    if(display=='none')
    {
        $('#'+divID+' i').removeClass('fa-check').addClass('fa-angle-down');
        $('body').removeClass('modal-open');
    }
    else
    {
        $('#'+divID+' i').removeClass('fa-angle-down').addClass('fa-check');
        if(elHeight>wHeight || $(window).width()<768) 
            $('body').addClass('modal-open');
        else
            $('body').removeClass('modal-open');
    }
    var display=$('#Div'+divID).css('display');
    if(display=='none')
    {
        $('.body-wrapper').css({'overflow-y':'hidden','height':'auto'}).addClass('modal-open');
    }
    else
    {
        $('.body-wrapper').css({'overflow-y':'hidden','height':$(window).height()}).addClass('modal-open');
    }*/
}

function setSticky() {
    $(".scrollPanel").trigger("sticky_kit:detach");
    if($(window).width()<768)
    {
        $('.container-breadcrumb').stick_in_parent({parent:$('body'),offset_top:40});
        $('.scrollPanel').stick_in_parent({parent:$('body'),offset_top:80});
    }
    else
    {
        $('.scrollPanel').stick_in_parent({parent:$('body'),offset_top:50});
    }
}

var slcNewType = "";
function filterTypeClick() 
{
    if($(this).attr('data-id')!="")
    {
        var slcType = $('#slctype').val();
        var slcIdType = $(this).data('id');
        if (slcIdType == "all") {
            $('#slctype').val('');
            if ($(this).hasClass('selected')){
                $('#DivFilterType li').removeClass('selected');
            }
            else {
                $('#DivFilterType li').addClass('selected');
            }
        }
        else {
            if (slcNewType==""){
                $('#slctype').val('');
                slcType = $('#slctype').val();
                $('#DivFilterType li').removeClass('selected');
            }
            if (slcType.indexOf(slcIdType) >= 0){
                slcNewType = slcType.replace(slcIdType,'');
            }
            else {
                slcNewType = slcType+','+slcIdType;
            }
            slcNewType = slcNewType.replace(',,',',');
            //console.log(slcNewType.substring(0, 1));
            if (slcNewType.substring(0, 1)==","){
                slcNewType = slcNewType.substring(1,slcNewType.length);
            }
            if (slcNewType.substring((slcNewType.length)-1, slcNewType.length)==","){
                slcNewType = slcNewType.substring(0,(slcNewType.length)-1);
            }
            $('#slctype').val(slcNewType);
            $('#DivFilterType li[data-id="all"]').removeClass('selected');
            if ($(this).hasClass('selected')){
                $(this).removeClass('selected');
            }
            else {
                $(this).addClass('selected');
            }
        }
    }
}
    
setProductHeights  = function()
{   
        //product
        $gridproductitem=$gridproduct.find('.thumbnail-list');
        $gridproductitemarticle=$gridproductitem.find('article');
        $gridproductitemimg=$gridproductitem.find('.imgproduct');
        $gridproductitem.removeAttr("style");
        //$gridproductitem.css("height","auto");
        //$gridproductitem.find('.col-pad').css("height","auto");
        $gridproductitemarticle.css('height','auto');
        //$gridproductitemimg.css('height','auto');
        itemHeight=0;
        itemWidth=$gridproductitem.find(".imgproduct").width();
        itemHeightArticle=0;
        //console.log(itemWidth);
        $($gridproductitem).each(function( index ) {
            // if(itemHeight < parseInt($(this).find("img").outerHeight())){
                // itemHeight=parseInt($(this).find("img").outerHeight());
            // }
            if(itemHeightArticle < parseFloat($(this).find("article").outerHeight())){
                itemHeightArticle=$(this).find("article").outerHeight();
            }
            //console.log(parseInt($(this).outerHeight()));
            //console.log(itemHeight);
            //console.log(index);
        });
        itemHeight=6/9*itemWidth;
        $($gridproductitem).each(function( index ) {
            //$(this).find('.col-pad').css('height',itemHeight);
            //$(this).css('height',itemHeight);
            //$(this).find('.imgproduct').css('height',itemHeight);
            //console.log($(window).width());
            if ($(window).width() >= 750) {
                $(this).find("article").css('height',itemHeightArticle);
            }
        });
    
};
setProductHeights();
$window.on( 'resize', setProductHeights );
$grid.on( 'load', setProductHeights );


function onScroll() {
    var winHeight = window.innerHeight ? window.innerHeight : $window.height(), 
            closeToBottom = ($window.scrollTop() + winHeight > $document.height() - 800);
    //console.log(currentpage+"-"+numPages);
    if (closeToBottom) {
        if (!currentload && numPages>0){
            //console.log(currentpage);
            loadmore(currentpage,strGroup,strCountry,strCity,strType);
            setProductHeights();
        }else{
            if (!currentload) $progressBar.hide();
        }
    }else{
        //$progressBar.hide();
        //console.log("data empty");
    }
}

function loadmore(page,g,c,ct,t){
    $progressBar.show().html('<div class="loading"><div class="spin"></div></div>');
    var nextPages = parseInt(page)+1;
    var prevPages = parseInt(page)-1;
    currentload = true;
    //console.log('c='+c+'&ct='+ct+'&t='+t+'&page='+page+'&ps='+pagesize+'&tf='+typelist+'&lf='+locationlist);
    $.ajax({
        type:'GET',
        url: g_DomainName+'/ajax/productlist.asp',
        data: 'g='+g+'&c='+c+'&ct='+ct+'&t='+t+'&page='+page+'&ps='+pagesize+'&tf='+typelist+'&lf='+locationlist
                /*+'&df='+departurelist+'&checkin='+dtCheckIn+'&checkout='+dtCheckOut
                +'&minprice='+minPrice+'&maxprice='+maxPrice+'&paxadult='+paxAdult
                +'&paxchild='+paxChild+'&dm='+departureMonth*/,
        success:function(response){
            $(".productlist").append(response);
            $('ol.breadcrumb li.remove').remove();
            $('ol.breadcrumb li.added').removeClass('hidden');
            if(page==1)
            {
                if($(window).width()<768)
                {
                    $('.row-filter-bar').slideToggle();
                }
                else
                {
                    /*if($(window).scrollTop()>254)
                    {
                        var fixedNav=69;
                        var isChrome = !!window.chrome && !!window.chrome.webstore;
                        if(isChrome) fixedNav=80;
                        $('html, body').animate({
                                scrollTop: $('.breadcrumb').offset().top-fixedNav
                            }, 1000);
                    }*/
                }
            }
            if(response.substring(0,21)=="<div class=has-error>" || response=="") 
            {
                numPages=0;
                $progressBar.hide();
            }   
            else
                $progressBar.html('<div class="btn-honeymoon"><span id="moreCity">LOAD MORE</span></div>');
            currentpage++;
            currentload = false;
            loadLazy();
            setProductHeights();
            $('.imageGallery').cycle({
                fx: 'none',
                timeout: 5000,
                delay:  -1000
            });
        }
    });
}

function getNumPages(page,g,c,ct,t){
    departurelist = $('#slcdeparture').val();
    locationlist = $('#slclocation').val();
    typelist = $('#slctype').val();
    
    paxAdult=$('#pax-adult').val();
    paxChild=$('#pax-child').val();
    
    minPrice=$('#min-price').val();
    maxPrice=$('#max-price').val();
    
    $.getJSON({
        type:'GET',
        url: g_DomainName+'/ajax/productlistpages.asp',
        data: 'g='+g+'&c='+c+'&ct='+ct+'&t='+t+'&page='+page+'&ps='+pagesize+'&tf='+typelist
                +'&lf='+locationlist/*+'&df='+departurelist+'&checkin='+dtCheckIn+'&checkout='+dtCheckOut
                +'&minprice='+minPrice+'&maxprice='+maxPrice+'&paxadult='+paxAdult
                +'&paxchild='+paxChild+'&dm='+departureMonth*/,
        success:function(response){
            numPages=response.numPages;
            if(numPages <= 0){
                $progressBar.hide();
            }
            var packageSummaries=response.PackageSummaries;
            $('#DivFilterType li').removeClass('selected').attr('data-id','');
            for(var i=0;i<packageSummaries.length;i++)
            {
                switch(packageSummaries[i].PackageType)
                {
                    case 1:
                        if(packageSummaries[i].Qty>0)
                        {
                            $('#DivFilterType li:eq(3)').attr('data-id','hotel-promo');
                            if(typelist=='' || typelist.indexOf('hotel-promo')>=0) $('#DivFilterType li:eq(3)').addClass('selected');
                        }
                        break;
                    case 2:
                        if(packageSummaries[i].Qty>0)
                        {
                            $('#DivFilterType li:eq(0)').attr('data-id','tour-packages');
                            if(typelist=='' || typelist.indexOf('tour-packages')>=0) $('#DivFilterType li:eq(0)').addClass('selected');
                        }
                        break;
                    case 3:
                        if(packageSummaries[i].Qty>0)
                        {
                            $('#DivFilterType li:eq(2)').attr('data-id','activity-day-tour');
                            if(typelist=='' || typelist.indexOf('activity-day-tour')>=0) $('#DivFilterType li:eq(2)').addClass('selected');
                        }
                        break;
                    case 4:
                        if(packageSummaries[i].Qty>0)
                        {
                            $('#DivFilterType li:eq(1)').attr('data-id','travel-ideas');
                            if(typelist=='' || typelist.indexOf('travel-ideas')>=0) $('#DivFilterType li:eq(1)').addClass('selected');
                        }
                        break;
                }
                
            }
            
            var packageLocations=response.PackageLocations;
            $('#DivFilterArea li.lidata').remove();
            var strHTML="";
            for(var i=0;i<packageLocations.length;i++)
            {
                var qty=packageLocations[i].Qty;
                var location=packageLocations[i].Location;
                if (qty>0 && location!="")
                {
                    var strClass="";
                    if(locationlist.toLowerCase().indexOf(EscapeURL(location))>=0 || locationlist=="") strClass="selected";
                    if (i>=9) strClass+=" collapse";
                    if (i==9)
                        strHTML+='<li class="more lidata"><a href="javascript:" onclick="showMoreLocation(\'more\')">SHOW MORE</a></li>';
                    strHTML+='<li class="'+strClass+' lidata" data-id="'+ EscapeURL(location)+'"><a href="javascript:;">'+location.toUpperCase()+'</a></li>';
                }
            }
            $(strHTML).insertAfter('#DivFilterArea li.selectall');
            $('#DivFilterArea li').click(function(){onFilterAreaClick($(this)) })
            
            /*packageDepartures=response.PackageDepartures;
            $('#DivFilterDeparture li.lidata').remove();
            var strHTML="";
            for(var i=0;i<packageDepartures.length;i++)
            {
                var qty=packageDepartures[i].Qty;
                var location=packageDepartures[i].Location;
                if (qty>0 && location!="")
                {
                    var strClass="";
                    if(EscapeURL(location)==departurelist.toLowerCase() || departurelist=="") strClass="selected";
                    if (i>=9) strClass+=" collapse";
                    if (i==9)
                        strHTML+='<li class="more lidata"><a href="javascript:" onclick="showMoreDeparture(\'more\')">SHOW MORE</a></li>';
                    strHTML+='<li class="'+strClass+' lidata" data-id="'+ EscapeURL(location)+'"><a href="javascript:;">'+location.toUpperCase()+' ('+ qty +')</a></li>';
                }
            }
            $(strHTML).insertAfter('#DivFilterDeparture li.selectall');
            strStat="";
            
            for(var i=0;i<packageSummaries.length;i++)
            {
                switch(packageSummaries[i].PackageType)
                {
                    case 1:
                        strStat+="Hotel Package: "+packageSummaries[i].Qty + "<br>";
                        break;
                    case 2:
                        strStat+="Tour Package: "+packageSummaries[i].Qty + "<br>";
                        break;
                    case 3:
                        strStat+="Activity: "+packageSummaries[i].Qty + "<br>";
                        break;
                    case 4:
                        strStat+="Highlight: "+packageSummaries[i].Qty + "<br>";
                        break;
                }
            }
            $('#divStat2').html(strStat);
            
            strStat="";
            var packageLocations=response.PackageLocations
            for(var i=0;i<packageLocations.length;i++)
            {
                strStat+=packageLocations[i].Location + ":"+packageLocations[i].Qty+ "<br>";
            }
            $('#divStat1').html(strStat);
            $('#DivFilterDeparture li').click(function(){onFilterDepartureClick($(this)) });*/
            
            if($(window).width()>767) $('.row-filter-bar').show();
        }
    });
}


function listSearch(){
    //console.log("You have selected the targets - " + typelist.join(","));
    //console.log("You have selected the targets - " + locationlist.join(","));
    $('.slc-filter').slideUp('slow');
    
    if($('#departuremonth').val()!='' && $('#departureyear').val()!='')
    {
        departureMonth=$('#departuremonth').val()+'-'+$('#departureyear').val();
    }
    
    departurelist = $('#slcdeparture').val();
    locationlist = $('#slclocation').val();
    typelist = $('#slctype').val();
    
    paxAdult=$('#pax-adult').val();
    paxChild=$('#pax-child').val();
    
    minPrice=$('#min-price').val();
    maxPrice=$('#max-price').val();
    
    $(".productlist").html('');
    currentpage=1;
    
    if(strCityName != ""){
        vURL=g_DomainName+"/paket-liburan-di-"+strCityName.toLowerCase()+","+strCountryName.toLowerCase();
    }else{
        vURL=g_DomainName+"/paket-liburan-di-"+strCountryName.toLowerCase();
    }
    var argURL='?';
    if( typelist != ''){
        argURL += 'tf='+typelist+'&';
    }
    if( locationlist != ''){
        argURL += 'lf='+locationlist+'&';
        $('#FilterArea').addClass('selected');
    }
    else
        $('#FilterArea').removeClass('selected');
    /*if( departurelist != ''){
        argURL += 'df='+departurelist+'&';
        $('#FilterDeparture').addClass('selected');
    }
    else
        $('#FilterDeparture').removeClass('selected');
    if(dtCheckIn!='')
    {
        argURL += 'checkin='+dtCheckIn+'&';
        $('#FilterDate').addClass('selected');
    }
    else
        $('#FilterDate').removeClass('selected');
    
    if(dtCheckOut!='')
    {
        argURL += 'checkout='+dtCheckOut+'&';
        $('#FilterDate').addClass('selected');
    }
    else
        $('#FilterDate').removeClass('selected');
    
    if(departureMonth!='')
    {
        argURL += 'dm='+departureMonth+'&';
        $('#FilterDate').addClass('selected');
    }
    else
        $('#FilterDate').removeClass('selected');
    
        
    if(paxAdult!='')
    {
        argURL += 'paxadult='+paxAdult+'&';
        $('#FilterPax').addClass('selected');
    }
    else
        $('#FilterPax').removeClass('selected');
        
    if(paxChild!='')
        argURL += 'paxchild='+paxChild+'&'
    
    if(minPrice!=0 && maxPrice!=0)
    {
        argURL += 'minprice='+minPrice+'&maxprice='+maxPrice+'&';
        $('#FilterPrice').addClass('selected');
    }
    else
        $('#FilterPrice').removeClass('selected');
    */
    
    
    vURL += argURL.substring(0,argURL.length-1);
    if (strGroup!=0 || strCountry!=0)
    {
        getNumPages(currentpage,strGroup,strCountry,strCity,strType);
        window.history.pushState('Yuktravel', 'Yuktravel.com', vURL);
        loadmore(currentpage,strGroup,strCountry,strCity,strType);
    }
    else
    {
        window.location.href=vURL;
    }
        
}

$(document).ready(function(){
    //$progressBar.hide();
    if(strGroup!=0 || strCountry!=0)
    {
        $window.bind('scroll', onScroll);
        $(".btn-loadmore").click(function(e) {
            if (!currentload && currentpage <= numPages){
                loadmore(currentpage,strGroup,strCountry,strCity,strType);
                setProductHeights();
            }else{
                $progressBar.hide();
            }
        });
    }
    departurelist = $('#slcdeparture').val();
    locationlist = $('#slclocation').val();
    typelist = $('#slctype').val();
    
    //console.log(numPagesLocation);
    //console.log(numPagesType);
    loadLazy();
    setProductHeights();
});

String.prototype.toProperCase = function () {
    return this.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
};
function showMoreLocation($obj)
{
    $('#DivFilterArea .slcLocation li').toggleClass('in');
    $('#DivFilterArea .slcLocation li.more').toggle();
    slideFilter('FilterArea');
}

function showMoreDeparture($obj)
{
    $('#DivFilterDeparture .slcLocation li').toggleClass('in');
    $('#DivFilterDeparture .slcLocation li.more').toggle();
    slideFilter('FilterDeparture');
}

function clearDate($obj)
{
    dtCheckIn="";
    dtCheckOut="";
    $('#dtTravel').data('dateRangePicker').clear();
    $obj.hide();
}

function titleCase(str) {
   var splitStr = str.toLowerCase().split(' ');
   for (var i = 0; i < splitStr.length; i++) {
       // You do not need to check if i is larger than splitStr length, as your for does that for you
       // Assign it back to the array
       splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
   }
   // Directly return the joined string
   return splitStr.join(' '); 
}