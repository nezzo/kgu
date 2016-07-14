<?php defined( '_JEXEC' ) or die; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru-ru" lang="ru-ru" dir="ltr">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
    <jdoc:include type="head" />
    <link type="text/css" rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/system.css" />
    <link  type="text/css" rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/general.css" />
    <link type="text/css" rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/style.css"  />
    <link type="text/css" rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/slider.css" />

    
    <link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/owl.carousel.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/media.css"  />
    <script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/jquery.js"></script>
    <script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/burger.js" type="text/javascript"></script>
    <script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/owl.carousel.js"></script>
    <script type="text/javascript">
		function appear() {
			if(op < 1) {
				op += 0.1;
				wObj.style.opacity = op;
				wObj.style.filter='alpha(opacity='+op*100+')';
				t = setTimeout('appear()', 30);
			}
		}

		jQuery(document).ready(function($){
			$('.submit_hid').click(function(){
				$('#mod_virtuemart_search').addClass('mod_virtuemart_search_act');
				//$('.submit_wrp input').css('display','block');
				//$(this).css('display','none');
					
			});
			
			    
			/*ТУТ ПРИЧИНА В ПОИСКЕ НАДО НАСТРОИТЬ ВЫЗОВ ФУНКЦИИ ПОД ДЖЕЙКВЕРИ*/
			/*
			$('.submit_hid').toggle(
			    function(e){
					$('#mod_virtuemart_search').addClass('mod_virtuemart_search_act');
					//$('#mod_virtuemart_search').animate({width: 'toggle'});
					//$('.submit_wrp input').css('display','block');
					//$(this).css('display','none');
					alert(111);
			    },
			    function(e){
			    	$('#mod_virtuemart_search').removeClass('mod_virtuemart_search_act');
			    }
			);
			*/

			$('#mod_virtuemart_search').keyup(function(){
            	$('.submit_hid').css('display','none');
            	$('.submit_wrp input').css('display','block');
			});

			var owl = $(".slid_prod_top");
		
	    owl.owlCarousel({

	      items : 6, //10 items above 1000px browser width
	      itemsDesktop : [1000,5], //5 items between 1000px and 901px
	      itemsDesktopSmall : [900,3], // 3 items betweem 900px and 601px
	      itemsTablet: [600,2], //2 items between 600 and 0;
	      itemsMobile : false // itemsMobile disabled - inherit from itemsTablet option

	      });


	      // Custom Navigation Events
	      $(".next").click(function(){
	        owl.trigger('owl.next');
	      })
	      $(".prev").click(function(){
	        owl.trigger('owl.prev');
	      })
	      $(".play").click(function(){
	        owl.trigger('owl.play',1000);
	      })
	      $(".stop").click(function(){
	        owl.trigger('owl.stop');
	      })

	      $('.under_height').parent().css('margin-bottom','0px');

	      $('.under_height_soln').parent().css('height','600px');
	      $('.under_height_soln').parent().css('margin-bottom','0px');
	      $('.under_height_soln').prev().css('height','75%');
	      $('.under_height_soln').prev().css('top','18%');


		});
	</script>

<?php

$lang = JFactory::getLanguage();
$lang = $lang->getTag();

if($lang == 'uk-UA') {
    $logo = 'logo-ukr';
    $lider = 'lider_ukr';
}
elseif($lang == 'en-GB') {
    $logo = 'logo-ukr';
    $lider = 'lider_eng';
}
elseif($lang == 'ru-RU') {
    $logo = 'logo-rus';
    $lider = 'lider_rus';
}
else {
    $logo = ' ';
}


?>

<?php
	//print_r ($_SERVER['REQUEST_URI']) ;
	if($_SERVER['REQUEST_URI'] == "/" || $_SERVER['REQUEST_URI'] == "/uk/" || $_SERVER['REQUEST_URI'] == "/en/") {
?>

		<style>
			.searchvm {
				top: 18px;
			}
		</style>

<?php
	}
?>

</head>
    <body>

        <header>
            <div class="header-bg"></div>
            <div class="container">
                <div class="header">

                    <div class="logo">
                        <a href="/" class="logo-img <?php echo $logo ?>"></a>
                        <div class="logo-text">
                            <jdoc:include type="modules" name="logo-text" />
                            <jdoc:include type="modules" name="slogan" />
                            <jdoc:include type="modules" name="license" />

                        </div>
                    </div>
                    <div class="right-side">
                        <jdoc:include type="modules" name="langwich" />

                        <div class="lider">
                            <img src="images/<?php echo $lider ?>.png" />
                        </div>
                    </div>

                </div>
            </div>
        </header>

        <div class="menu-wrap">
        <nav class="nav">
	<a class="toggle-nav" href="#">Меню &#9776;</a>
	<div class="nav-mobile">
            <jdoc:include type="modules" name="top-menu" />
            </div>
            </nav>
       </div>

		<div class="under_menu">
			<jdoc:include type="modules" name="slider_menu_top" />
	        <jdoc:include type="modules" name="breadcrumb" />
			<jdoc:include type="modules" name="search" style="searchvm" />
		</div>




            <jdoc:include type="modules" name="house-img" style="modulehouseimg" />
            <jdoc:include type="modules" name="house-categories" style="modulehousecategories" />




                <jdoc:include type="modules" name="about-us-left" style="testleft" />

                <jdoc:include type="modules" name="about-us-right" style="testright" />

        <jdoc:include type="modules" name="clients" style="clients" />

        <jdoc:include type="modules" name="sertificates" />




        <div class="main">

            <jdoc:include type="modules" name="top-center" style="xhtml" />

            <jdoc:include type="modules" name="slider" style="slider" />


            <jdoc:include type="message" />
            <jdoc:include type="component" />

            <jdoc:include type="modules" name="content" style="usfulinfo" />


            <jdoc:include type="modules" name="bottom-center" style="xhtml" />

        </div>




        <footer>
            <div class="footer-wrap">
                <div class="footer">
                    <div class="footer-section foot-left">
                        <jdoc:include type="modules" name="footer-address" />
                    </div>
                    <div class="footer-section foot-center">
                        <div class="left-contact">
                            <jdoc:include type="modules" name="footer-phones-left" />
                        </div>
                        <div class="right-contact">
                            <jdoc:include type="modules" name="footer-phones-right" />
                        </div>
                    </div>
                    <div class="footer-section foot-right">
                        <jdoc:include type="modules" name="footer-time-work" />
                    </div>
                    <div class="e-mail">
                        <jdoc:include type="modules" name="email-down" />
                    </div>

                </div>
            </div>
        </footer>



        <jdoc:include type="modules" name="zakaz-btn" style="zakazbtn" />




        <script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/jquery.flexisel.js"></script>


        <script type="text/javascript">

//jQuery(window).load(function() {        
jQuery(document).ready(function() {
    jQuery("#flexiselDemo1").flexisel();
    jQuery("#flexiselDemo2").flexisel({
        enableResponsiveBreakpoints: true,
        responsiveBreakpoints: {
            portrait: {
                changePoint:480,
                visibleItems: 1
            },
            landscape: {
                changePoint:640,
                visibleItems: 2
            },
            tablet: {
                changePoint:768,
                visibleItems: 3
            }
        }
    });

    jQuery("#flexiselDemo3").flexisel({
        visibleItems: 5,
        animationSpeed: 1000,
        autoPlay: true,
        autoPlaySpeed: 3000,
        pauseOnHover: true,
        enableResponsiveBreakpoints: true,
        responsiveBreakpoints: {
            portrait: {
                changePoint:480,
                visibleItems: 1
            },
            landscape: {
                changePoint:640,
                visibleItems: 2
            },
            tablet: {
                changePoint:768,
                visibleItems: 3
            }
        }
    });

    jQuery("#flexiselDemo4").flexisel({
        clone:false
    });





});
</script>

		<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/jquery.zaccordion.js"></script>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $("#accordion-slider").zAccordion({
                    easing: null,
                    timeout: 5500,
                    slideWidth: 600,
                    width: 1000,
                    height: 300,
                    auto: false,
                    trigger: 'mouseover'
                });


                //$(".accordion_slider ul").last().addClass('hide');
            });
        </script>

        <script>

            jQuery(document).ready(function($) {

                $(".product-zakaz .custom").click(function() {
                    $(".zakaz-black-window").addClass("zakaz-black-window-hover");

                    $(".zakaz-central-block").addClass("zakaz-central-block-hover");

                    $("#zakaz-close").addClass("zakaz-close-hover");

                    $('html, body').css('overflow', 'hidden');

                });

                $("#zakaz-close").click(function() {
                    $(".zakaz-black-window").removeClass("zakaz-black-window-hover");

                    $(".zakaz-central-block").removeClass("zakaz-central-block-hover");

                    $(this).removeClass("zakaz-close-hover");

                    $('html, body').css('overflow', 'auto');
                });

                $(".zakaz-black-window").click(function() {
                    $(".zakaz-central-block").removeClass("zakaz-central-block-hover");
                    $("#zakaz-close").removeClass("zakaz-close-hover");
                    $(this).removeClass("zakaz-black-window-hover");
                    $('html, body').css('overflow', 'auto');
                });

            });




        </script>
        <script>

            jQuery(document).ready(function($) {
                var $vm_category = $('.newsflash_module').siblings('.category-view');
                $vm_category.addClass('category-in-second-page');
                var $category_inside = $vm_category.children('.category-view');
                $category_inside.addClass('close');


                $('.cutom_map iframe html').bind('onscroll', function() {
                    return false;

                });


            });

        </script>
        <!-- BEGIN JIVOSITE CODE {literal} -->
        <script type='text/javascript'>
            (function(){ var widget_id = 'fyXlSVdciH';var d=document;var w=window;function l(){
                var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();</script>
        <!-- {/literal} END JIVOSITE CODE -->
            
  <!-- Yandex.Metrika counter -->
<script src="https://mc.yandex.ru/metrika/watch.js" type="text/javascript"></script>
<script type="text/javascript">
try {
    var yaCounter36996430 = new Ya.Metrika({
        id:36996430,
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true,
        trackHash:true
    });
} catch(e) { }
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/36996430" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
      <!-- Start FastcallAgent code -->
<script type="text/javascript">
var fca_code = 'bde3dfc5a057abb8bf802be2eb47b13e';
(function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true; po.charset = 'utf-8';
    po.src = '//ua.cdn.fastcallagent.com/tracker.min.js?_='+Date.now();
    var s = document.getElementsByTagName('script')[0];
    if (s) { s.parentNode.insertBefore(po, s); }
    else { s = document.getElementsByTagName('head')[0]; s.appendChild(po); }
})();
</script>
<!-- End FastcallAgent code -->
      <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-78515125-1', 'auto');
  ga('send', 'pageview');

</script>
  </body>
</html>