<?php
/**
 *
 * Show the product details page
 *
 * @package	VirtueMart
 * @subpackage
 * @author Max Milbers, Eugen Stranz, Max Galt
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2014 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default.php 8715 2015-02-17 08:45:23Z Milbo $
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

/* Let's see if we found the product */
if (empty($this->product)) {
	echo vmText::_('COM_VIRTUEMART_PRODUCT_NOT_FOUND');
	echo '<br /><br />  ' . $this->continue_link_html;
	return;
}

echo shopFunctionsF::renderVmSubLayout('askrecomjs',array('product'=>$this->product));



if(vRequest::getInt('print',false)){ ?>
<body onload="javascript:print();">
<?php } ?>

<div class="productdetails-view productdetails">

    <?php
    // Product Navigation
    if (VmConfig::get('product_navigation', 1)) {
	?>
        <div class="product-neighbours">
	    <?php
	    if (!empty($this->product->neighbours ['previous'][0])) {
		$prev_link = JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $this->product->neighbours ['previous'][0] ['virtuemart_product_id'] . '&virtuemart_category_id=' . $this->product->virtuemart_category_id, FALSE);
		echo JHtml::_('link', $prev_link, $this->product->neighbours ['previous'][0]
			['product_name'], array('rel'=>'prev', 'class' => 'previous-page','data-dynamic-update' => '1'));
	    }
	    if (!empty($this->product->neighbours ['next'][0])) {
		$next_link = JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $this->product->neighbours ['next'][0] ['virtuemart_product_id'] . '&virtuemart_category_id=' . $this->product->virtuemart_category_id, FALSE);
		echo JHtml::_('link', $next_link, $this->product->neighbours ['next'][0] ['product_name'], array('rel'=>'next','class' => 'next-page','data-dynamic-update' => '1'));
	    }
	    ?>
    	<div class="clear"></div>
        </div>
    <?php } // Product Navigation END
    ?>

	<?php // Back To Category Button
	if ($this->product->virtuemart_category_id) {
		$catURL =  JRoute::_('index.php?option=com_virtuemart&view=category&virtuemart_category_id='.$this->product->virtuemart_category_id, FALSE);
		$categoryName = $this->product->category_name ;
	} else {
		$catURL =  JRoute::_('index.php?option=com_virtuemart');
		$categoryName = vmText::_('COM_VIRTUEMART_SHOP_HOME') ;
	}
	?>
	<div class="back-to-category">
    	<a href="<?php echo $catURL ?>" class="product-details" title="<?php echo $categoryName ?>"><?php echo vmText::sprintf('COM_VIRTUEMART_CATEGORY_BACK_TO',$categoryName) ?></a>
	</div>

    <?php // Product Title
    ?>
    <h1><?php echo $this->product->product_name ?></h1>
    <?php // Product Title END
    ?>

    <?php
	$lang = JFactory::getLanguage();
	$lang = $lang->getTag();

	if($lang == 'uk-UA') {
	    echo '<div class="desc_eten">Шановні клієнти, опис цієї моделі, є тільки російською мовою.</div>';
	}
	elseif($lang == 'en-GB') {
    	echo '<div class="desc_eten">Dear customers, the description of this model is only available in Russian.</div>';
	}
	?>

    <?php // afterDisplayTitle Event
    echo $this->product->event->afterDisplayTitle ?>

    <?php
    // Product Edit Link
    echo $this->edit_link;
    // Product Edit Link END
    ?>

    <?php
    // PDF - Print - Email Icon
    if (VmConfig::get('show_emailfriend') || VmConfig::get('show_printicon') || VmConfig::get('pdf_icon')) {
	?>
        <div class="icons">
	    <?php

	    $link = 'index.php?tmpl=component&option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $this->product->virtuemart_product_id;

		echo $this->linkIcon($link . '&format=pdf', 'COM_VIRTUEMART_PDF', 'pdf_button', 'pdf_icon', false);
	    //echo $this->linkIcon($link . '&print=1', 'COM_VIRTUEMART_PRINT', 'printButton', 'show_printicon');
		echo $this->linkIcon($link . '&print=1', 'COM_VIRTUEMART_PRINT', 'printButton', 'show_printicon',false,true,false,'class="printModal"');
		$MailLink = 'index.php?option=com_virtuemart&view=productdetails&task=recommend&virtuemart_product_id=' . $this->product->virtuemart_product_id . '&virtuemart_category_id=' . $this->product->virtuemart_category_id . '&tmpl=component';
	    echo $this->linkIcon($MailLink, 'COM_VIRTUEMART_EMAIL', 'emailButton', 'show_emailfriend', false,true,false,'class="recommened-to-friend"');
	    ?>
    	<div class="clear"></div>
        </div>
    <?php } // PDF - Print - Email Icon END
    ?>

    <?php
    // Product Short Description
    if (!empty($this->product->product_s_desc)) {
	?>

	<?php
    } // Product Short Description END

	echo shopFunctionsF::renderVmSubLayout('customfields',array('product'=>$this->product,'position'=>'ontop'));
    ?>

    <div class="vm-product-container">
	<div class="vm-product-media-container">

	<?php
		$cat_dl = $this->product->categories;

		//print_r($cat_dl);
		if(in_array(623, $cat_dl)){
			//echo '<div class="steker_hit">Хит продаж</div> ';
			echo '<div class="stek_sl"><img src="/templates/kgu/images/tovardnya.png" /></div>';
		}elseif(in_array(307, $cat_dl)){
			//echo '<div class="steker_new">Новинка</div> ';
			echo '<div class="stek_sl"><img src="/templates/kgu/images/novinki.png" /></div>';
		}elseif(in_array(309, $cat_dl)){
			//echo '<div class="steker_sell">Распродажа</div> ';
			echo '<div class="stek_sl"><img src="/templates/kgu/images/rasprodazha.png" /></div>';
		}
	?>

	<?php
		echo $this->loadTemplate('images');

		$count_images = count ($this->product->images);
		if ($count_images > 1) {
			echo $this->loadTemplate('images_additional');
		}
	?>
	<div class="clear"></div>
	</div>



	<div class="vm-product-details-container">
	    <div class="spacer-buy-area">

		<?php
		// TODO in Multi-Vendor not needed at the moment and just would lead to confusion
		/* $link = JRoute::_('index2.php?option=com_virtuemart&view=virtuemart&task=vendorinfo&virtuemart_vendor_id='.$this->product->virtuemart_vendor_id);
		  $text = vmText::_('COM_VIRTUEMART_VENDOR_FORM_INFO_LBL');
		  echo '<span class="bold">'. vmText::_('COM_VIRTUEMART_PRODUCT_DETAILS_VENDOR_LBL'). '</span>'; ?><a class="modal" href="<?php echo $link ?>"><?php echo $text ?></a><br />
		 */
		?>

		<?php
		echo shopFunctionsF::renderVmSubLayout('rating',array('showRating'=>$this->showRating,'product'=>$this->product));

		if (is_array($this->productDisplayShipments)) {
		    foreach ($this->productDisplayShipments as $productDisplayShipment) {
			echo $productDisplayShipment . '<br />';
		    }
		}
		if (is_array($this->productDisplayPayments)) {
		    foreach ($this->productDisplayPayments as $productDisplayPayment) {
			echo $productDisplayPayment . '<br />';
		    }
		}

		//In case you are not happy using everywhere the same price display fromat, just create your own layout
		//in override /html/fields and use as first parameter the name of your file
		echo shopFunctionsF::renderVmSubLayout('prices',array('product'=>$this->product,'currency'=>$this->currency));
		?> <div class="clear"></div><?php
		echo shopFunctionsF::renderVmSubLayout('addtocart',array('product'=>$this->product));

		echo shopFunctionsF::renderVmSubLayout('stockhandle',array('product'=>$this->product));

		// Ask a question about this product
		if (VmConfig::get('ask_question', 0) == 1) {
			$askquestion_url = JRoute::_('index.php?option=com_virtuemart&view=productdetails&task=askquestion&virtuemart_product_id=' . $this->product->virtuemart_product_id . '&virtuemart_category_id=' . $this->product->virtuemart_category_id . '&tmpl=component', FALSE);
			?>
			<div class="ask-a-question">
				<a class="ask-a-question" href="<?php echo $askquestion_url ?>" rel="nofollow" ><?php echo vmText::_('COM_VIRTUEMART_PRODUCT_ENQUIRY_LBL') ?></a>
			</div>
		<?php
		}
		?>

		<?php
		// Manufacturer of the Product
		if (VmConfig::get('show_manufacturers', 1) && !empty($this->product->virtuemart_manufacturer_id)) {
		    echo $this->loadTemplate('manufacturer');
		}
		?>

	    </div>
	</div>
	<div class="clear"></div>


    </div>

    <div class="info_prod_in">
    	<div class="product-dostavka">
			<?php
				$lang = JFactory::getLanguage();
				$lang = $lang->getTag();

				if($lang == 'uk-UA') {
				?>
                	<a target="blank" class="dostavka" href="/dostavka-i-oplata">Доставка</a>
					<a target="blank" class="garantija" href="/garantiya">Гарантия</a>
					<a target="blank" class="credit" href="/kupiti-v-kredit">Кредит</a>
					<a target="blank" class="montag" href="/montazh-i-servis">Монтаж</a>
				<?php
				}
				elseif($lang == 'en-GB') {
				?>
                	<a target="blank" class="dostavka" href="/en/shipping-and-payment">Доставка</a>
					<a target="blank" class="garantija" href="/en/warranty">Гарантия</a>
					<a target="blank" class="credit" href="/en/buy-in-credit">Кредит</a>
					<a target="blank" class="montag" href="/en/installation-and-service">Монтаж</a>
				<?php
				}
				elseif($lang == 'ru-RU') {
				?>
					<a target="blank" class="dostavka" href="/ru/dostavka-i-oplata">Доставка</a>
					<a target="blank" class="garantija" href="/ru/garantiya">Гарантия</a>
					<a target="blank" class="credit" href="/ru/kupit-v-kredit">Кредит</a>
					<a target="blank" class="montag" href="/ru/montazh-i-servis">Монтаж</a>
				<?php
				}
			?>
		</div>



		<div class="product-text-right">
			<?php
				if(isset($this->product->customfieldsSorted)){
			?>
				<table cellspacing="0">
					<tr>
						<td>Модель</td>
						<td>Холод, кВт</td>
						<td>Тепло, кВт</td>
						<td>Цена, грн</td>
					</tr>
					<?php
					$productModel = VmModel::getModel('product');
				    if(!empty($Itemid)){
				        $ItemidStr = '&Itemid='.$Itemid;
				    }
		            asort($this->product->customfieldsSorted['related_products']);
					foreach($this->product->customfieldsSorted['related_products'] as $customfield){
					$relateds = $productModel->getProductSingle($customfield->customfield_value);
					$price_cust = round($relateds->allPrices[0]['product_price']);
					if($price_cust < 1){
						$price_cust ='Уточнить цену';
					}
					echo'<tr>';
					echo '<td>'.$relateds->product_name.'</td>';
					echo '<td>'.$relateds->product_s_desc.'</td>';             /*  */
					echo '<td>'.$relateds->product_desc.'</td>';             /*  */
					echo '<td>'.$price_cust.'</td>';
					echo'</tr>';
					}
					?>
				</table>
            <?php
				} else {
			?>
				<table cellspacing="0">
					<tr>
						<td>Модель</td>
						<td>Цена, грн</td>
					</tr>
					<tr>
						<?php
							$price_cust = round($this->product->prices[product_price]);
								if($price_cust < 1){
								$price_cust ='Уточнить цену';
							}

							if(!empty($this->product->product_box)) {
								$box_prd = '/'.$this->product->product_box;
							}
						?>
						<td><?php echo $this->product->product_name; ?></td>
						<td class="price_new"><?php echo $price_cust.''.$box_prd; ?></td>
					</tr>
				</table>
			 <?php
				}
			?>
			<div class="product-dostavka-zakaz">
				<div class="call-num" onclick="jQuery(this).children().next().slideToggle(200); yaCounter36996430.reachGoal('knopka_zvonok');">
                	<span>Звонить</span>
                	<div>
						<?php
						 jimport( 'joomla.application.module.helper' ); // подключаем нужный класс, один раз на странице, перед первым выводом
						 $module = JModuleHelper::getModules('mobile'); // получаем в массив все модули из заданной позиции
						 $attribs['style'] = 'specpredtov'; // задаём, если нужно, оболочку модулей (module chrome)
						 echo JModuleHelper::renderModule($module[0], $attribs); // выводим первый модуль из заданной позиции
						?>
			    	</div>
                </div>

                <div class="feed_bl">
                	<span onclick="jQuery('#feed_back_up').css({'top':'0px', 'left':'0px'}); wObj=document.getElementById('feed_back_up'); wObj.style.opacity=1; wObj.style.display='block'; op=0; appear();">Обратный звонок</span>
                </div>

				<div class="product-zakaz">
					<a onclick="jQuery('#divwin_call').css({'top':'0px', 'left':'0px'}); wObj=document.getElementById('divwin_call'); wObj.style.opacity=1; wObj.style.display='block'; op=0; appear();">Заказать</a>
				</div>
			</div>

            <div class="obor_disc" style="padding: 10px 0px;">
                * Скидку на оборудование уточняйте по телефону
            </div>

		</div>

		<div class="clear"></div>


		<!--div class="product-short-description">
		    <?php
		    /** @todo Test if content plugins modify the product description */
		    echo $this->product->product_s_desc;
		    ?>
        </div-->

	</div>

	<div class="clear"></div>
<?php


	// event onContentBeforeDisplay
	echo $this->product->event->beforeDisplayContent; ?>

	<?php
	// Product Description
	if (strlen($this->product->product_desc) > 20) {
	    ?>
        <div class="product-description">
	<?php /** @todo Test if content plugins modify the product description */ ?>
    	<span class="title"><?php echo vmText::_('COM_VIRTUEMART_PRODUCT_DESC_TITLE') ?></span>
	<?php echo $this->product->product_desc; ?>
        </div>
	<?php
    }elseif(strlen($this->product->product_desc) < 20 && empty($this->product->customfieldsSorted)){
        $dbo =& JFactory::getDBO();

$qua="SELECT virtuemart_product_id
FROM  `rt1fh_virtuemart_product_customfields`
WHERE  `customfield_value` LIKE  '".$this->product->virtuemart_product_id."'";
        $reso = $dbo->setQuery($qua)->loadObjectList();
        $pareid = $reso[0]->virtuemart_product_id;

        $quades = "SELECT product_desc
FROM  `rt1fh_virtuemart_products_ru_ru`
WHERE  `virtuemart_product_id` =".$pareid;
        $resdes = $dbo->setQuery($quades)->loadObjectList();
        echo $resdes[0]->product_desc;


    }else{

    }
     // Product Description END

	echo shopFunctionsF::renderVmSubLayout('customfields',array('product'=>$this->product,'position'=>'normal'));

    // Product Packaging
    $product_packaging = '';
    if ($this->product->product_box) {
	?>
        <div class="product-box">
	    <?php
	        echo vmText::_('COM_VIRTUEMART_PRODUCT_UNITS_IN_BOX') .$this->product->product_box;
	    ?>
        </div>
    <?php } // Product Packaging END ?>

    <?php
	echo shopFunctionsF::renderVmSubLayout('customfields',array('product'=>$this->product,'position'=>'onbot'));

    echo shopFunctionsF::renderVmSubLayout('customfields',array('product'=>$this->product,'position'=>'related_products','class'=> 'product-related-products','customTitle' => true ));

	echo shopFunctionsF::renderVmSubLayout('customfields',array('product'=>$this->product,'position'=>'related_categories','class'=> 'product-related-categories'));

	?>

<?php // onContentAfterDisplay event
echo $this->product->event->afterDisplayContent;

echo $this->loadTemplate('reviews');

// Show child categories
if (VmConfig::get('showCategory', 1)) {
	echo $this->loadTemplate('showcategory');
}

$j = 'jQuery(document).ready(function($) {
	Virtuemart.product(jQuery("form.product"));

	$("form.js-recalculate").each(function(){
		if ($(this).find(".product-fields").length && !$(this).find(".no-vm-bind").length) {
			var id= $(this).find(\'input[name="virtuemart_product_id[]"]\').val();
			Virtuemart.setproducttype($(this),id);

		}
	});
});';
//vmJsApi::addJScript('recalcReady',$j);

/** GALT
	 * Notice for Template Developers!
	 * Templates must set a Virtuemart.container variable as it takes part in
	 * dynamic content update.
	 * This variable points to a topmost element that holds other content.
	 */
$j = "Virtuemart.container = jQuery('.productdetails-view');
Virtuemart.containerSelector = '.productdetails-view';";

vmJsApi::addJScript('ajaxContent',$j);

echo vmJsApi::writeJS();
?>

		<div class="divwin_order_off" id="feed_back_up">
			<div class="closeButton" onclick="wObj.style.display='none';jQuery('#bgOverlay').empty();"><img src="/templates/kgu/images/vsplyw-close.png" /></div>
			<div class="order_off_tit">Обратный звонок</div>
			<form id="formZakaz" method="post" action="" onsubmit="return myValidationfeed()">
				<div class="order_off_single">
					<label>Ваше имя:</label>
					<input type="text" name="name_feed" value="" />
				</div>

				<div class="order_off_single">
					<label>Ваш телефон <span class="star">*</span>:</label>
					<input type="text" name="phone_feed" value="" />
				</div>

				<input type="submit" value="Отправить" name="order_sub_feed" id="otpravit">
			</form>
		</div>

		<script type="text/javascript">
			function myValidationfeed() {
				var phone_feed = jQuery('#feed_back_up').find('input[name=phone_feed]').val();

				if(phone_feed.length == 0){
					if(phone_feed.length == 0){
						jQuery('input[name=phone_feed]').css('border', '1px solid #FF0000');
					} else {
						jQuery('input[name=phone_feed]').css('border', '1px solid #688F9E');
					}


					return false;
				}
				else {
                    yaCounter36996430.reachGoal('forma_zvonok');
					return true;
				}
			}
		</script>

		<?php
		if( isset($_POST['order_sub_feed']) ) {
			$db_feed =& JFactory::getDBO();
			$sql_feed = "SELECT email FROM #__users WHERE id = 42";
			$res_feed = $db_feed->setQuery($sql_feed)->loadObjectList();
			$mailer_feed = JFactory::getMailer();

			$sender_feed = 'info@kgu.com.ua';


			$mailer_feed->setSender($sender_feed);
			$subject_feed = 'Обратный звонок';
			$mailer_feed->setSubject($subject_feed);


			//$recipient[] = 'alfressko@gmail.com';	// Почтовый ящик администратора
			$recipient_feed[] = 'sergey@kgu.com.ua';
            $recipient_feed[] = 'info@kgu.com.ua';
            $recipient_feed[] = 'oksana@kgu.com.ua';


			$mailer_feed->addRecipient($recipient_feed);



			$body_feed = "<table border='1' cellspacing='10' cellpadding='10'>
			<tr>
			<td colspan='2'>Обратный звонок</td>
			</tr>
			<tr>
			<td>Имя</td>
			<td>".$_POST['name_feed']."</td>
			</tr>
			<tr>
			<td>Телефон</td>
			<td>".$_POST['phone_feed']."</td>
			</tr>
			</table>";


			$mailer_feed->isHTML(true);
			$mailer_feed->setBody($body_feed);

			$send_feed = $mailer_feed->Send();

			if ($send_feed !== true) {
				echo 'Error sending email: '.$send_feed->get('message');
			}
			else {
				echo '<script>alert("Спacибo, Вaш запрос отправлен.");</script>';
			}
		}
		?>


		<div class="divwin_order_off" id="divwin_call">
			<div class="closeButton" onclick="wObj.style.display='none';jQuery('#bgOverlay').empty();"><img src="/templates/kgu/images/vsplyw-close.png" /></div>
			<div class="order_off_tit">Заказ товара</div>
			<form id="formZakaz" method="post" action="" onsubmit="return myValidation()">
				<div class="order_off_single">
					<label>Ваше имя:</label>
					<input type="text" name="name" value="" />
				</div>

				<div class="order_off_single">
					<label>Ваш телефон <span class="star">*</span>:</label>
					<input type="text" name="phone" value="" />
				</div>

				<div class="order_off_single">
					<label>Ваш e-mail:</label>
					<input type="text" name="pocht" value="" />
				</div>

				<div class="order_off_single">
					<label>Ваш адрес:</label>
					<input type="text" name="address" value="" />
				</div>

				<div class="order_off_single">
					<label>Пожелание:</label>
					<input type="text" name="vish" value="" />
				</div>

				<?php
					if(isset($this->product->product_box)){
				?>
						<div class="order_off_single">
							<label>Количество:</label>
							<input type="text" name="koliches" value="" />
						</div>
				<?php
					} else {
				?>
						<input type="hidden" name="koliches" value="1" />
				<?php
					}
				?>

				<?php
					if(isset($this->product->customfieldsSorted)){
				?>
						<div class="order_off_single">
							<label>Выберите модель:</label>
							<select name="prod_change">
								<?php
									foreach($this->product->customfieldsSorted['related_products'] as $customfield){
										$relateds = $productModel->getProductSingle($customfield->customfield_value);
										echo '<option>'.$relateds->product_name.' - '.round($relateds->allPrices[0]['product_price']).'грн.</option>';
									}
								?>
							</select>
						</div>
				<?php
					} else{
				?>
						<input type="hidden" name="prod_change" value="<?php echo $price_cust.'/'.$this->product->product_box; ?>" />
				<?php
					}
				?>

				<input type="submit" value="Заказать" name="order_sub" id="otpravit">
			</form>
		</div>

		<script type="text/javascript">
			function myValidation() {
				var phone = jQuery('#divwin_call').find('input[name=phone]').val();

				if(phone.length == 0){
					if(phone.length == 0){
						jQuery('input[name=phone]').css('border', '1px solid #FF0000');
					} else {
						jQuery('input[name=phone]').css('border', '1px solid #688F9E');
					}


					return false;
				}
				else {
                    yaCounter36996430.reachGoal('knopka_zakazat');
					return true;
				}

			}
		</script>

		<?php
		if( isset($_POST['order_sub']) ) {
			$db =& JFactory::getDBO();
			$sql = "SELECT email FROM #__users WHERE id = 42";
			$res = $db->setQuery($sql)->loadObjectList();
			$mailer = JFactory::getMailer();
			$config = JFactory::getConfig();

			$sender = 'info@kgu.com.ua';


			$mailer->setSender($sender);
			$subject = 'Заказ товара';
			$mailer->setSubject($subject);


			//$recipient[] = 'alfressko@gmail.com';	// Почтовый ящик администратора

            $recipient[] = 'info@kgu.com.ua';
            $recipient[] = 'oksana@kgu.com.ua';
            $recipient[] = $_POST['pocht'];

			$mailer->addRecipient($recipient);


			$sqlmax = "SELECT MAX(number) as num FROM rt1fh_order_numbers";


            $confFile = JPATH_SITE."/configuration.php";
            require_once($confFile);
            $conf = new JConfig();

            $con = new mysqli($conf->host,$conf->user,$conf->password,$conf->db);
            $con->set_charset("utf8");

			$reslast = $db->setQuery($sqlmax)->loadObjectList();
			$fir = (float)$reslast[0]->num;
			$sec = 1;
			$max = $fir + $sec;

			mysqli_query($con,"INSERT INTO rt1fh_order_numbers (number) VALUES (".$max.")");

			$ip = $_SERVER["REMOTE_ADDR"];
			$id = mysqli_query($con, "SELECT virtuemart_order_id FROM rt1fh_virtuemart_orders ORDER BY created_on DESC ");
			$row = mysqli_fetch_array($id);
			$last = (int)($row[0]) + 1;

			$items = mysqli_query($con,"INSERT INTO rt1fh_virtuemart_order_items (virtuemart_order_item_id, virtuemart_order_id, virtuemart_vendor_id,
			virtuemart_product_id, order_item_sku, order_item_name, product_quantity, product_item_price, product_tax, product_basePriceWithTax,
			product_final_price, product_subtotal_discount, product_subtotal_with_tax, order_item_currency, order_status, product_attribute, created_on, created_by, modified_on,
			modified_by, locked_on, locked_by)
			VALUES ('', '".$max."', 1,
			'".$this->product->virtuemart_product_id."', '".$this->product->product_sku."', '".$this->product->product_name."-".$_POST['prod_change']."', ".$_POST['koliches'].",
			'".ceil($this->product->prices[product_price])."', '0.00000', '0.00000', '".$this->product->prices[product_price]."', '0.00000', '0.00000', null, 'P',
			null, '".date('Y-m-d')." ".date('H:i:s')."', 0, '".date('Y-m-d')." ".date('H:i:s')."', 0, '0000-00-00 00:00:00', 0)");

			$orders = mysqli_query($con,"INSERT INTO rt1fh_virtuemart_orders (`virtuemart_order_id`, `virtuemart_user_id`, `virtuemart_vendor_id`,
			`order_number`, `customer_number`, `order_pass`, `order_total`, `order_salesPrice`, `order_billTaxAmount`, `order_billTax`, `order_billDiscountAmount`,
			`order_discountAmount`, `order_subtotal`, `order_tax`, `order_shipment`, `order_shipment_tax`, `order_payment`, `order_payment_tax`,
			`coupon_discount`, `coupon_code`, `order_discount`, `order_currency`, `order_status`, `user_currency_id`, `user_currency_rate`,
			`virtuemart_paymentmethod_id`, `virtuemart_shipmentmethod_id`, `delivery_date`, `order_language`, `ip_address`, `created_on`, `created_by`, `modified_on`,
			`modified_by`, `locked_on`, `locked_by`)
			VALUES ('', 0, 1, '".$max."', '".$max."', 'p_000c', '".ceil($this->product->prices[product_price])."', '111', '0.00000', 0, '0.00000', '0.00000', '".ceil($this->product->prices[product_price])."',
			'0.00000', '0.00', '0.00000', '0.00', '0.00000', '0.00', null, '0.00', 199, 'P', 199, '1.00000', 1, 1, '', '11', '".$ip ."',
			'".date('Y-m-d')." ".date('H:i:s')."', 0, '".date('Y-m-d')." ".date('H:i:s')."', 0, '0000-00-00 00:00:00', 0)");

			$userinfos = mysqli_query($con,"INSERT INTO rt1fh_virtuemart_order_userinfos (virtuemart_order_userinfo_id, virtuemart_order_id, virtuemart_user_id,
			address_type, address_type_name, company, title, last_name, first_name, middle_name, phone_1, phone_2, fax, address_1, address_2, city,
			virtuemart_state_id, virtuemart_country_id, zip, email, agreed, created_on, created_by, modified_on, modified_by, locked_on, locked_by)
			VALUES ('', '".$max."', 0, 'BT', null, null, 'Mr', '".$_POST['name']."', '".$_POST['name']."', null, '".$_POST['phone']."', null, null, '".$_POST['address']."', null, '".$_POST['vish']."',
			0, 220, '0000', '".$_POST['pocht']."', 0, '".date('Y-m-d')." ".date('H:i:s')."', 0, '".date('Y-m-d')." ".date('H:i:s')."', 0, '0000-00-00 00:00:00', 0)");


			mysqli_close($con);


			$body = "<table border='1' cellspacing='10' cellpadding='10'>
			<tr>
			<td colspan='2'>Заказ товара</td>
			</tr>
			<tr>
			<td>Хочу преобрести товар:</td>
			<td>
			<a href='http://kgu.com.ua/".$this->product->link."'>".$this->product->product_name."</a></td>
			</tr>
			<tr>
			<td>Цена</td>
			<td>
			".$price_cust." грн</td>
			</tr>";

            if(isset($this->product->customfieldsSorted)){
				$body .=" <tr>
				<td>Модель</td>
				<td>".$_POST['prod_change']."</td>
				</tr>";
			}else {
			}


			$body .="<tr>
			<td>Имя</td>
			<td>".$_POST['name']."</td>
			</tr>
			<tr>
			<td>Телефон</td>
			<td>".$_POST['phone']."</td>
			</tr>
			<tr>
			<td>Почта</td>
			<td>".$_POST['pocht']."</td>
			</tr>
			<tr>
			<td>Адрес</td>
			<td>".$_POST['address']."</td>
			</tr>
			<tr>
			<td>Пожелания</td>
			<td>".$_POST['vish']."</td>
			</tr>";
			if(isset($this->product->product_box)){
				$body .="<tr>
				<td>Кол-во</td>
				<td>".$_POST['koliches']."</td>
				</tr>
				</table>";
			}
			else {
				$body .="</table>";
			}


			$mailer->isHTML(true);
			$mailer->setBody($body);

			$send = $mailer->Send();

			if ($send !== true) {
				echo 'Error sending email: '.$send->get('message');
			}
			else {
				echo '<script>alert("Спacибo, Вaш зaкaз пpинят.");</script>';
			}
		}
		?>

</div>




