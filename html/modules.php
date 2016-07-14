<?php

defined('_JEXEC') or die;

function modChrome_modulehouseimg($module, &$params, &$attribs){
?>
	<div class="house-wrap">
       <?php echo $module->content; ?>




<?php
}
?>


        <?php



function modChrome_modulehousecategories($module, &$params, &$attribs){
?>

       <?php echo $module->content; ?>
</div>



<?php
}
?>





<?php

defined('_JEXEC') or die;

function modChrome_testleft($module, &$params, &$attribs){
?>
	<div class="about-us">
            <div class="why-we about-blocks">
                <span class="light-img"></span>


                <?php echo $module->content; ?>

            </div>
            <div class="company about-blocks">
                <span class="list-img"></span>


<?php
}
?>


        <?php



function modChrome_testright($module, &$params, &$attribs){
?>

       <?php echo $module->content; ?>
</div>
        </div>



<?php
}
?>


<!--=======================================================-->

<?php

function modChrome_clients($module, &$params, &$attribs){
?>
	<div class="clients">
        <div class="nbs-flexisel-container">
            <h2><?php echo $module->title; ?></h2>
            <div class="nbs-flexisel-inner">
                <?php echo $module->content; ?>
            </div>
        </div>
        <div class="slider-shadow-inset"></div>
    </div>

<?php
}
?>

<!--=======================================================-->

<?php

function modChrome_zakazbtn($module, &$params, &$attribs){
?>
	<div class="zakaz-btn-wrapper">
        <div class="zakaz-black-window"></div>
        <div class="zakaz-central-block">
            <?php echo $module->content; ?>
            <span id="zakaz-close"></span>
        </div>

    </div>

<?php
}






function modChrome_slider($module, &$params, &$attribs) {
?>
<div class="accordion_slider">
<ul id="accordion-slider">
    <li class="slide-1">
    	<?php
			$lang = JFactory::getLanguage();
			$lang = $lang->getTag();

			if($lang == 'uk-UA') {
			    echo '<h3>Новинки:</h3>';
                $link = '/uanovinki';
                $viewall = "Дивитися ще";
			}
			elseif($lang == 'en-GB') {
			    echo '<h3>Novelty:</h3>';
                $link = '/newprod';
                $viewall = "See more";
			}
			elseif($lang == 'ru-RU') {
			   echo '<h3>Новинки:</h3>';
                $link = '/novinki';
                $viewall = "Смотреть еще";
			}
		?>

        <div class="body">
<?php
$document = &JFactory::getDocument();
$renderer = $document->loadRenderer('modules');
$options = array('style' => 'none');
$position = 'slide-1';
echo $renderer->render($position, $options, null);

$cat = JRequest::getInt('virtuemart_category_id');



?>
            <a class="btn" href="<?=$link;?>?cat=<?=$cat;?>&limit=300"><?=$viewall;?></a>
        </div>

    </li>
    <li class="slide-2">
        <?php
			$lang = JFactory::getLanguage();
			$lang = $lang->getTag();

			if($lang == 'uk-UA') {
			    echo '<h3>Топ продажів:</h3>';
                $link = '/topua';
                $viewall = "Дивитися ще";
			}
			elseif($lang == 'en-GB') {
			    echo '<h3>Top sales:</h3>';
                $link = '/topen';
			}
			elseif($lang == 'ru-RU') {
			   echo '<h3>Топ продаж:</h3>';
                $link = '/top';
			}
		?>
        <div class="body">
<?php
$document = &JFactory::getDocument();
$renderer = $document->loadRenderer('modules');
$options = array('style' => 'none');
$position = 'slide-2';
echo $renderer->render($position, $options, null);
?>
            <a class="btn" href="<?=$link;?>?cat=<?=$cat;?>&limit=300"><?=$viewall;?></a>
        </div>

    </li>
    <li class="slide-3">
        <?php
			$lang = JFactory::getLanguage();
			$lang = $lang->getTag();

			if($lang == 'uk-UA') {
			    echo '<h3>Розпродаж:</h3>';
                $link = '/salesua';
			}
			elseif($lang == 'en-GB') {
			    echo '<h3>Sale:</h3>';
                $link = '/salesen';
			}
			elseif($lang == 'ru-RU') {
			   echo '<h3>Распродажа:</h3>';
                $link = '/sales';
			}
		?>
        <div class="body">
<?php
$document = &JFactory::getDocument();
$renderer = $document->loadRenderer('modules');
$options = array('style' => 'none');
$position = 'slide-3';
echo $renderer->render($position, $options, null);
?>
            <a class="btn" href="<?=$link;?>?cat=<?=$cat;?>&limit=300"><?=$viewall;?></a>
        </div>

    </li>
</ul>
</div>





<?php
}
?>

<?php
function modChrome_searchvm($module, &$params, &$attribs){
?>
	<div class="searchvm">
		<?php echo $module->content; ?>
		<div class="clear"></div>
	</div>
<?php
}
?>


<?php
function modChrome_brands($module, &$params, &$attribs){
?>
<div class="moduletable">
	<?php
		$lang = JFactory::getLanguage();
		$lang = $lang->getTag();

		if($lang == 'uk-UA') {
		    echo '<h3>Бренди:</h3>';
		}
		elseif($lang == 'en-GB') {
		    echo '<h3>Brands</h3>';
		}
		elseif($lang == 'ru-RU') {
		   echo '<h3>Бренды:</h3>';
		}
	?>

	<?php echo $module->content; ?>
</div>

<?php
}
?>

<?php
function modChrome_usfulinfo($module, &$params, &$attribs){
?>
<div class="moduletable">
	<?php
	$lang = JFactory::getLanguage();
	$lang = $lang->getTag();

	if($lang == 'uk-UA') {
	    echo '<h2>Корисна інформація</h2>';
	}
	elseif($lang == 'en-GB') {
	    echo '<h2>Helpful information</h2>';
	}
	elseif($lang == 'ru-RU') {
	   echo '<h2>Полезная информация</h2>';
	}
	?>

	<?php echo $module->content; ?>
</div>

<?php
}
?>