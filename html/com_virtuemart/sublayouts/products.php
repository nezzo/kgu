<?php
/**
 * sublayout products
 *
 * @package	VirtueMart
 * @author Max Milbers
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2014 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL2, see LICENSE.php
 * @version $Id: cart.php 7682 2014-02-26 17:07:20Z Milbo $
 */

defined('_JEXEC') or die('Restricted access');

if(VmConfig::get('usefancy',1)){
	vmJsApi::addJScript( 'fancybox/jquery.fancybox-1.3.4.pack', false);
	vmJsApi::css('jquery.fancybox-1.3.4');
	$document = JFactory::getDocument ();
	$imageJS = '
	jQuery(document).ready(function() {
		Virtuemart.updateImageEventListeners()
	});
	Virtuemart.updateImageEventListeners = function() {
		jQuery("a[rel=vm-additional-images]").fancybox({
			"titlePosition" 	: "inside",
			"transitionIn"	:	"elastic",
			"transitionOut"	:	"elastic"
		});
		jQuery(".additional-images a.product-image.image-0").removeAttr("rel");
		jQuery(".additional-images img.product-image").click(function() {
			jQuery(".additional-images a.product-image").attr("rel","vm-additional-images" );
			jQuery(this).parent().children("a.product-image").removeAttr("rel");
			var src = jQuery(this).parent().children("a.product-image").attr("href");
			jQuery(this).parent().parent().prev().children("a").children("img").attr("src",src);
			jQuery(this).parent().parent().prev().children("a").children("img").attr("alt",this.alt );
			jQuery(this).parent().parent().prev().children("a").attr("href",src );
			jQuery(this).parent().parent().prev().children("a").attr("title",this.alt );
			jQuery(".main-image .vm-img-desc").html(this.alt);
		});
	}
	';
} else {
	vmJsApi::addJScript( 'facebox',false );
	vmJsApi::css( 'facebox' );
	$document = JFactory::getDocument ();
	$imageJS = '
	jQuery(document).ready(function() {
		Virtuemart.updateImageEventListeners()
	});
	Virtuemart.updateImageEventListeners = function() {
		jQuery("a[rel=vm-additional-images]").facebox();
		var imgtitle = jQuery("span.vm-img-desc").text();
		jQuery("#facebox span").html(imgtitle);
	}
	';
}
vmJsApi::addJScript('imagepopup',$imageJS);
if(VmConfig::get('usefancy',1)){
	vmJsApi::addJScript( 'fancybox/jquery.fancybox-1.3.4.pack', false);
	vmJsApi::css('jquery.fancybox-1.3.4');
	$document = JFactory::getDocument ();
	$imageJS = '
	jQuery(document).ready(function() {
		Virtuemart.updateImageEventListeners()
	});
	Virtuemart.updateImageEventListeners = function() {
		jQuery("a[rel=vm-additional-images]").fancybox({
			"titlePosition" 	: "inside",
			"transitionIn"	:	"elastic",
			"transitionOut"	:	"elastic"
		});
		jQuery(".additional-images a.product-image.image-0").removeAttr("rel");
		jQuery(".additional-images img.product-image").click(function() {
			jQuery(".additional-images a.product-image").attr("rel","vm-additional-images" );
			jQuery(this).parent().children("a.product-image").removeAttr("rel");
			var src = jQuery(this).parent().children("a.product-image").attr("href");
			jQuery(this).parent().parent().prev().children("a").children("img").attr("src",src);
			jQuery(this).parent().parent().prev().children("a").children("img").attr("alt",this.alt );
			jQuery(this).parent().parent().prev().children("a").attr("href",src );
			jQuery(this).parent().parent().prev().children("a").attr("title",this.alt );
			jQuery(".main-image .vm-img-desc").html(this.alt);
		});
	}
	';
} else {
	vmJsApi::addJScript( 'facebox',false );
	vmJsApi::css( 'facebox' );
	$document = JFactory::getDocument ();
	$imageJS = '
	jQuery(document).ready(function() {
		Virtuemart.updateImageEventListeners()
	});
	Virtuemart.updateImageEventListeners = function() {
		jQuery("a[rel=vm-additional-images]").facebox();
		var imgtitle = jQuery("span.vm-img-desc").text();
		jQuery("#facebox span").html(imgtitle);
	}
	';
}
vmJsApi::addJScript('imagepopup',$imageJS);
$products_per_row = $viewData['products_per_row'];
$currency = $viewData['currency'];
$showRating = $viewData['showRating'];
$verticalseparator = " vertical-separator";
echo shopFunctionsF::renderVmSubLayout('askrecomjs');

	$ItemidStr = '';
    $Itemid = shopFunctionsF::getLastVisitedItemId();
    $productModel = VmModel::getModel('product');
    if(!empty($Itemid)){
        $ItemidStr = '&Itemid='.$Itemid;
    }


foreach ($viewData['products'] as $type => $products ) {

	$rowsHeight = shopFunctionsF::calculateProductRowsHeights($products,$currency,$products_per_row);

	if(!empty($type) and count($products)>0){
		$productTitle = vmText::_('COM_VIRTUEMART_'.strtoupper($type).'_PRODUCT'); ?>
<div class="<?php echo $type ?>-view">
  <h4><?php echo $productTitle ?></h4>
		<?php // Start the Output
    }

	// Calculating Products Per Row
	$cellwidth = ' width'.floor ( 100 / $products_per_row );

	$BrowseTotalProducts = count($products);


	$col = 1;
	$nb = 1;
	$row = 1;


	foreach ( $products as $product ) {
        $cat_dl = $product->categories;
        $category_id  = vRequest::getInt ('virtuemart_category_id', 0);


       if(!empty($_REQUEST['cat']) && in_array($_REQUEST['cat'], $cat_dl)) {


           // Show the horizontal seperator
           if ($col == 1 && $nb > $products_per_row) {
               ?>
               <!--	<div class="horizontal-separator"></div>-->
           <?php
           }

           // this is an indicator wether a row needs to be opened or not
           if ($col == 1) {
               ?>
               <div class="row">
           <?php
           }

           // Show the vertical seperator
           if ($nb == $products_per_row or $nb % $products_per_row == 0) {
               $show_vertical_separator = ' ';
           } else {
               $show_vertical_separator = $verticalseparator;
           }

           // Show Products
           ?>
           <div class="product vm-col-100">
           <!--<?php echo ' vm-col-' . $products_per_row . $show_vertical_separator ?>-->

           <div class="spacer">

           <div class="vm-product-descr-container-<?php echo $rowsHeight[$row]['product_s_desc'] ?>">
               <h2><?php echo $product->product_name;//echo JHtml::link($product->link . $ItemidStr, $product->product_name); ?>
                   <span class="official-diller">Официальный дилер</span>
               </h2>

           </div>

           <div class="vm-product-media-container">
               <?php



               if (in_array(623, $cat_dl)) {
                   //echo '<div class="steker_hit">Хит продаж</div> ';
                   echo '<div class="stek_sl"><img src="/templates/kgu/images/tovardnya.png" /></div>';
               } elseif (in_array(307, $cat_dl)) {
                   //echo '<div class="steker_new">Новинка</div> ';
                   echo '<div class="stek_sl"><img src="/templates/kgu/images/novinki.png" /></div>';
               } elseif (in_array(309, $cat_dl)) {
                   //echo '<div class="steker_sell">Распродажа</div> ';
                   echo '<div class="stek_sl"><img src="/templates/kgu/images/rasprodazha.png" /></div>';
               }
               ?>
               <div class="main-image">
                   <?php echo $product->images[0]->displayMediaFull("",true,"rel='vm-additional-images'"); ?>
                   <!--a title="<?php echo $product->product_name ?>" href="<?php echo $product->link; ?>">
                       <?php
                   echo $product->images[0]->displayMediaThumb('class="browseProductImage"', false);
                   ?>
                   </a-->
               </div>

               <div class="additional-images">
                   <?php



                   $start_image = VmConfig::get('add_img_main', 1) ? 0 : 1;
                   for ($i = $start_image; $i < count($product->images); $i++) {
                       if ($i < '5') {
                           $image = $product->images[$i];
                           ?>
                           <div class="floatleft">
                               <?php
                               if (VmConfig::get('add_img_main', 1)) {
                                   echo $image->displayMediaThumb('class="product-image" style="cursor: pointer"', false, "");
                                   echo '<a href="' . $image->file_url . '"  class="product-image image-' . $i . '" style="display:none;" title="' . $image->file_meta . '" rel="vm-additional-images"></a>';
                               } else {
                                   echo $image->displayMediaThumb("", true, "rel='vm-additional-images'");
                               }
                               ?>
                           </div>
                       <?php
                       }
                   }
                   ?>
                   <div class="clear"></div>
               </div>
               <div class="clear"></div>

               <!--a class="readmore_link" title="<?php echo $product->product_name ?>"
                  href="<?php echo $product->link . $ItemidStr; ?>">
                   подробнее
               </a-->

               <div class="obor_disc">
                   * Скидку на оборудование уточняйте по телефону
               </div>

               <!--	<div class="additional-images">
						<?php   //print_r($product);
               $start_image = 1;
               for ($i = $start_image; $i < count($product->images); $i++) {
                   $image = $product->images[$i];
                   ?>
							<div class="floatleft">
								<?php
                   if (VmConfig::get('add_img_main', 1)) {
                       echo $image->displayMediaThumb('class="product-image" style="cursor: pointer"', false, "");
                       echo '<a href="' . $image->file_url . '"  class="product-image image-' . $i . '" style="display:none;" title="' . $image->file_meta . '" rel="vm-additional-images"></a>';
                   } else {
                       echo $image->displayMediaThumb("", true, "rel='vm-additional-images'");
                   }
                   ?>
							</div>
						<?php
               }
               ?>
						<div class="clear"></div>
					</div> -->

           </div>
           <div class="product-text">
               <div class="product-dostavka">
                   <?php
                   $lang = JFactory::getLanguage();
                   $lang = $lang->getTag();

                   if ($lang == 'uk-UA') {
                       ?>
                       <a target="blank" class="dostavka" href="/dostavka-i-oplata">Доставка</a>
                       <a target="blank" class="garantija" href="/garantiya">Гарантия</a>
                       <a target="blank" class="credit" href="/kupiti-v-kredit">Кредит</a>
                       <a target="blank" class="montag" href="/montazh-i-servis">Монтаж</a>
                   <?php
                   } elseif ($lang == 'en-GB') {
                       ?>
                       <a target="blank" class="dostavka" href="/en/shipping-and-payment">Доставка</a>
                       <a target="blank" class="garantija" href="/en/warranty">Гарантия</a>
                       <a target="blank" class="credit" href="/en/buy-in-credit">Кредит</a>
                       <a target="blank" class="montag" href="/en/installation-and-service">Монтаж</a>
                   <?php
                   } elseif ($lang == 'ru-RU') {
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
                   if (isset($product->customfieldsSorted)) {
                       ?>
                       <table cellspacing="0">
                           <tr>
                               <td>Модель</td>
                               <td>Холод, кВт</td>
                               <td>Тепло, кВт</td>
                               <td>Цена, грн</td>
                           </tr>
                           <?php
                           // print_r($product);

                           asort($product->customfieldsSorted['related_products']);
                           foreach ($product->customfieldsSorted['related_products'] as $customfield) {
                               $relateds = $productModel->getProductSingle($customfield->customfield_value);
                               $price_cust = round($relateds->allPrices[0]['product_price']);
                               if ($price_cust < 1) {
                                   $price_cust = 'Уточнить цену';
                               }

                               if (!empty($product->product_box)) {
                                   $box_prd = '/' . $product->product_box;
                               }
                               //print_r($customfield);
                               $custurl = JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $customfield->customfield_value . '&virtuemart_category_id=' . $product->virtuemart_category_id);

                               //print_r($customfield);
                               echo '<tr>';
                               echo '<td><a href="'.$custurl.'" title="'.$relateds->product_name.'">' . $relateds->product_name . '</a></td>';
                               echo '<td>' . $relateds->product_s_desc . '</td>';             /*  */
                               echo '<td>' . $relateds->product_desc . '</td>';
                               echo '<td>' . $price_cust . '' . $box_prd . '</td>';
                               echo '</tr>';
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
                               $price_cust = round($product->prices[product_price]);
                               if ($price_cust < 1) {
                                   $price_cust = 'Уточнить цену';
                               }

                               if (!empty($product->product_box)) {
                                   $box_prd = '/' . $product->product_box;
                               }
                               ?>
                               <td><a title="<?php echo $product->product_name ?>" href="<?php echo $product->link; ?>"><?php echo $product->product_name; ?></a></td>
                               <td class="price_new"><?php echo $price_cust . '' . $box_prd; ?></td>
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
                               jimport('joomla.application.module.helper'); // подключаем нужный класс, один раз на странице, перед первым выводом
                               $module = JModuleHelper::getModules('mobile'); // получаем в массив все модули из заданной позиции
                               $attribs['style'] = 'specpredtov'; // задаём, если нужно, оболочку модулей (module chrome)
                               echo JModuleHelper::renderModule($module[0], $attribs); // выводим первый модуль из заданной позиции
                               ?>
                           </div>
                       </div>

                       <div class="feed_bl">
                           <span
                               onclick="jQuery('#feed_back_up<?php echo $product->virtuemart_product_id; ?>').css({'top':'0px', 'left':'0px'}); wObj=document.getElementById('feed_back_up<?php echo $product->virtuemart_product_id; ?>'); wObj.style.opacity=1; wObj.style.display='block'; op=0; appear();">Обратный звонок</span>
                       </div>

                       <div class="product-zakaz">
                           <a onclick="jQuery('#divwin_call<?php echo $product->virtuemart_product_id; ?>').css({'top':'0px', 'left':'0px'}); wObj=document.getElementById('divwin_call<?php echo $product->virtuemart_product_id; ?>'); wObj.style.opacity=1; wObj.style.display='block'; op=0; appear();">Заказать
                           </a>
                       </div>
                       <div class="clear"></div>
                   </div>
               </div>
               <div class="clear"></div>
               <!--
            <?php if (!empty($rowsHeight[$row]['product_s_desc'])) {
                   ?>

                       <div class="full_description">

                    <?php
                   if (!empty($product->product_desc)) {
                       // echo $product->product_desc;
                   } ?>
                <a class="product-readmore" href="<?php echo $product->link; ?>">Подробнее...</a>

            </div>

			<?php
               }
               ?>
           -->


               <p class="product_s_desc">
                   <?php // Product Short Description
                   if (!empty($product->product_s_desc)) {
                       //echo shopFunctionsF::limitStringByWord ($product->product_s_desc, 2000, ' ...')
                       ?>
                   <?php } ?>

               </p>


           </div>

           <div class="vm-product-rating-container">
               <?php echo shopFunctionsF::renderVmSubLayout('rating', array('showRating' => $showRating, 'product' => $product));
               if (VmConfig::get('display_stock', 1)) {
                   ?>
                   <span class="vmicon vm2-<?php echo $product->stock->stock_level ?>"
                         title="<?php echo $product->stock->stock_tip ?>"></span>
               <?php
               }
               echo shopFunctionsF::renderVmSubLayout('stockhandle', array('product' => $product));
               ?>
           </div>





           <?php //echo $rowsHeight[$row]['price'] ?>
           <div class="vm3pr-<?php echo $rowsHeight[$row]['price'] ?>"> <?php
               //echo shopFunctionsF::renderVmSubLayout('prices',array('product'=>$product,'currency'=>$currency));
               ?>
               <div class="clear"></div>
           </div>
           <?php //echo $rowsHeight[$row]['customs'] ?>
           <div class="vm3pr-<?php echo $rowsHeight[$row]['customfields'] ?>"> <?php
               echo shopFunctionsF::renderVmSubLayout('addtocart', array('product' => $product, 'rowHeights' => $rowsHeight[$row])); ?>
           </div>

           <div class="vm-details-button">
               <?php // Product Details Button
               $link = empty($product->link) ? $product->canonical : $product->link;
               echo JHtml::link($link . $ItemidStr, vmText::_('COM_VIRTUEMART_PRODUCT_DETAILS'), array('title' => $product->product_name, 'class' => 'product-details'));
               //echo JHtml::link ( JRoute::_ ( 'index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $product->virtuemart_product_id . '&virtuemart_category_id=' . $product->virtuemart_category_id , FALSE), vmText::_ ( 'COM_VIRTUEMART_PRODUCT_DETAILS' ), array ('title' => $product->product_name, 'class' => 'product-details' ) );

               ?>
           </div>


           </div>

           <div class="divwin_order_off feed_back_up_cat"
                id="feed_back_up<?php echo $product->virtuemart_product_id; ?>">
               <div class="closeButton" onclick="wObj.style.display='none';jQuery('#bgOverlay').empty();"><img
                       src="/templates/kgu/images/vsplyw-close.png"/></div>
               <div class="order_off_tit">Обратный звонок</div>
               <form id="formZakaz" method="post" action=""
                     onsubmit="return myValidationfeed<?php echo $product->virtuemart_product_id; ?>()">
                   <div class="order_off_single">
                       <label>Ваше имя:</label>
                       <input type="text" name="name_feed" value=""/>
                   </div>

                   <div class="order_off_single">
                       <label>Ваш телефон <span class="star">*</span>:</label>
                       <input type="text" name="phone_feed" value=""/>
                   </div>

                   <input type="submit" value="Отправить"
                          name="order_sub_feed<?php echo $product->virtuemart_product_id; ?>" id="otpravit">
               </form>
           </div>

           <script type="text/javascript">
               function myValidationfeed<?php echo $product->virtuemart_product_id; ?>() {
                   var phone_feed = jQuery('#feed_back_up<?php echo $product->virtuemart_product_id; ?>').find('input[name=phone_feed]').val();

                   if (phone_feed.length == 0) {
                       if (phone_feed.length == 0) {
                           jQuery('#feed_back_up<?php echo $product->virtuemart_product_id; ?>').find('input[name=phone_feed]').css('border', '1px solid #FF0000');
                       } else {
                           jQuery('#feed_back_up<?php echo $product->virtuemart_product_id; ?>').find('input[name=phone_feed]').css('border', '1px solid #688F9E');
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
           if (isset($_POST['order_sub_feed' . $product->virtuemart_product_id])) {
               $db_feed =& JFactory::getDBO();
               $sql_feed = "SELECT email FROM #__users WHERE id = 42";
               $res_feed = $db_feed->setQuery($sql_feed)->loadObjectList();
               $mailer_feed = JFactory::getMailer();

               $sender_feed = 'info@kgu.com.ua';


               $mailer_feed->setSender($sender_feed);
               $subject_feed = 'Обратный звонок';
               $mailer_feed->setSubject($subject_feed);


               //$recipient[] = 'alfressko@gmail.com';	// Почтовый ящик администратора

               $recipient_feed[] = 'info@kgu.com.ua';
               $recipient_feed[] = 'oksana@kgu.com.ua';
               $recipient_feed[] = 'sergey@kgu.com.ua';


               $mailer_feed->addRecipient($recipient_feed);


               $body_feed = "<table border='1' cellspacing='10' cellpadding='10'>
			<tr>
			<td colspan='2'>Обратный звонок</td>
			</tr>
			<tr>
			<td>Имя</td>
			<td>" . $_POST['name_feed'] . "</td>
			</tr>
			<tr>
			<td>Телефон</td>
			<td>" . $_POST['phone_feed'] . "</td>
			</tr>
			</table>";


               $mailer_feed->isHTML(true);
               $mailer_feed->setBody($body_feed);

               $send_feed = $mailer_feed->Send();

               if ($send_feed !== true) {
                   echo 'Error sending email: ' . $send_feed->get('message');
               } else {
                   echo '<script>alert("Спacибo, Вaш запрос отправлен.");</script>';
               }
           }
           ?>





           <div class="divwin_order_off" id="divwin_call<?php echo $product->virtuemart_product_id; ?>">
               <?php
               /*
               $lang = JFactory::getLanguage();
               $lang = $lang->getTag();

               if($lang == 'uk-UA') {
                   $order_off_tit = 'Замовлення товару';
                   $order_off_single_name = 'Ваше ім’я:';
                   $order_off_single_phone = 'Ваш телефон';
                   $order_off_single_mail = 'Ваш e-mail';
                   $order_off_single_wich = 'Побажання:';
                   $order_off_single_button = 'Замовити';
               }
               elseif($lang == 'en-GB') {
                   $order_off_tit = 'Order product';
                   $order_off_single_name = 'Your name:';
                   $order_off_single_phone = 'Your phone';
                   $order_off_single_mail = 'Your e-mail';
                   $order_off_single_wich = 'Wish:';
                   $order_off_single_button = 'Order';
               }
               elseif($lang == 'ru-RU') {
                   $order_off_tit = 'Заказ товара';
                   $order_off_single_name = 'Ваше имя:';
                   $order_off_single_phone = 'Ваш телефон';
                   $order_off_single_mail = 'Ваш e-mail';
                   $order_off_single_wich = 'Пожелание:';
                   $order_off_single_button = 'Заказать';
               }
               */
               ?>
               <div class="closeButton" onclick="wObj.style.display='none';jQuery('#bgOverlay').empty();"><img
                       src="/templates/kgu/images/vsplyw-close.png"/></div>
               <div class="order_off_tit">Заказ товара</div>
               <form id="formZakaz" method="post" action=""
                     onsubmit="return myValidation<?php echo $product->virtuemart_product_id; ?>()">
                   <div class="order_off_single">
                       <label>Ваше имя:</label>
                       <input type="text" name="name" value=""/>
                   </div>

                   <div class="order_off_single">
                       <label>Ваш телефон <span class="star">*</span>:</label>
                       <input type="text" name="phone" value=""/>
                   </div>

                   <div class="order_off_single">
                       <label>Ваш e-mail:</label>
                       <input type="text" name="pocht" value=""/>
                   </div>

                   <div class="order_off_single">
                       <label>Ваш адрес:</label>
                       <input type="text" name="address" value=""/>
                   </div>

                   <div class="order_off_single">
                       <label>Пожелание:</label>
                       <input type="text" name="wish" value=""/>
                   </div>

                   <?php
                   if (isset($product->product_box)) {
                       ?>
                       <div class="order_off_single">
                           <label>Количество:</label>
                           <input type="text" name="koliches" value=""/>
                       </div>
                   <?php
                   } else {
                       ?>
                       <input type="hidden" name="koliches" value="1"/>
                   <?php
                   }
                   ?>


                   <?php
                   if (isset($product->customfieldsSorted)) {
                       ?>
                       <div class="order_off_single">
                           <label>Выберите модель:</label>
                           <select name="prod_change">
                               <?php
                               foreach ($product->customfieldsSorted['related_products'] as $customfield) {
                                   $relateds = $productModel->getProductSingle($customfield->customfield_value);
                                   echo '<option>' . $relateds->product_name . ' - ' . round($relateds->allPrices[0]['product_price']) . 'грн.</option>';
                               }
                               ?>
                           </select>
                       </div>
                   <?php
                   } else {
                       ?>
                       <input type="hidden" name="prod_change"
                              value="<?php echo $price_cust . '/' . $product->product_box; ?>"/>
                   <?php
                   }
                   ?>
                   <input type="hidden" name="nametov" value="<?php echo $product->product_name; ?>"/>

                   <input type="submit" value="Заказать" name="order_sub<?php echo $product->virtuemart_product_id; ?>"
                          id="otpravit">
               </form>
           </div>

           <script type="text/javascript">
               function myValidation<?php echo $product->virtuemart_product_id; ?>() {
                   var phone = jQuery('#divwin_call<?php echo $product->virtuemart_product_id; ?>').find('input[name=phone]').val();

                   if (phone.length == 0) {
                       if (phone.length == 0) {
                           jQuery('#divwin_call<?php echo $product->virtuemart_product_id; ?>').find('input[name=phone]').css('border', '1px solid #FF0000');
                       } else {
                           jQuery('#divwin_call<?php echo $product->virtuemart_product_id; ?>').find('input[name=phone]').css('border', '1px solid #688F9E');
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
           $mainframe = JFactory::getApplication();
           $url = JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $product->virtuemart_product_id . '&virtuemart_category_id=' . $product->virtuemart_category_id);

           if (isset($_POST['order_sub' . $product->virtuemart_product_id])) {
               $db =& JFactory::getDBO();
               $sql = "SELECT email FROM #__users WHERE id = 42";
               $res = $db->setQuery($sql)->loadObjectList();
               $mailer = JFactory::getMailer();
               $config = JFactory::getConfig();

               $sender = 'info@kgu.com.ua';


               $mailer->setSender($sender);
               $subject = 'Заказ товара';
               $mailer->setSubject($subject);


              // $recipient[] = 'alfressko@gmail.com';	// Почтовый ящик администратора

               $recipient[] = 'info@kgu.com.ua';
               $recipient[] = 'oksana@kgu.com.ua';
               $recipient[] = $_POST['pocht'];

               $mailer->addRecipient($recipient);


               $sqlmax = "SELECT MAX(number) as num FROM rt1fh_order_numbers";


               $confFile = JPATH_SITE . "/configuration.php";
               require_once($confFile);
               $conf = new JConfig();

               $con = new mysqli($conf->host, $conf->user, $conf->password, $conf->db);
               $con->set_charset("utf8");

               $reslast = $db->setQuery($sqlmax)->loadObjectList();
               $fir = (float)$reslast[0]->num;
               $sec = 1;
               $max = $fir + $sec;

               mysqli_query($con, "INSERT INTO rt1fh_order_numbers (number) VALUES (" . $max . ")");

               $ip = $_SERVER["REMOTE_ADDR"];
               $id = mysqli_query($con, "SELECT virtuemart_order_id FROM rt1fh_virtuemart_orders ORDER BY created_on DESC ");
               $row = mysqli_fetch_array($id);
               $last = (int)($row[0]) + 1;

               $items = mysqli_query($con, "INSERT INTO rt1fh_virtuemart_order_items (virtuemart_order_item_id, virtuemart_order_id, virtuemart_vendor_id,
					virtuemart_product_id, order_item_sku, order_item_name, product_quantity, product_item_price, product_tax, product_basePriceWithTax,
					product_final_price, product_subtotal_discount, product_subtotal_with_tax, order_item_currency, order_status, product_attribute, created_on, created_by, modified_on,
					modified_by, locked_on, locked_by)
					VALUES ('', '" . $max . "', 1,
					'" . $product->virtuemart_product_id . "', '" . $product->product_sku . "', '" . $product->product_name . "-" . $_POST['prod_change'] . "', " . $_POST['koliches'] . ",
					'" . ceil($product->product_price) . "', '0.00000', '0.00000', '" . $product->product_price . "', '0.00000', '0.00000', null, 'P',
					null, '" . date('Y-m-d') . " " . date('H:i:s') . "', 0, '" . date('Y-m-d') . " " . date('H:i:s') . "', 0, '0000-00-00 00:00:00', 0)");

               $orders = mysqli_query($con, "INSERT INTO rt1fh_virtuemart_orders (`virtuemart_order_id`, `virtuemart_user_id`, `virtuemart_vendor_id`,
					`order_number`, `customer_number`, `order_pass`, `order_total`, `order_salesPrice`, `order_billTaxAmount`, `order_billTax`, `order_billDiscountAmount`,
					`order_discountAmount`, `order_subtotal`, `order_tax`, `order_shipment`, `order_shipment_tax`, `order_payment`, `order_payment_tax`,
					`coupon_discount`, `coupon_code`, `order_discount`, `order_currency`, `order_status`, `user_currency_id`, `user_currency_rate`,
					`virtuemart_paymentmethod_id`, `virtuemart_shipmentmethod_id`, `delivery_date`, `order_language`, `ip_address`, `created_on`, `created_by`, `modified_on`,
					`modified_by`, `locked_on`, `locked_by`)
					VALUES ('', 0, 1, '" . $max . "', '" . $max . "', 'p_000c', '" . ceil($product->product_price) . "', '111', '0.00000', 0, '0.00000', '0.00000', '" . ceil($product->product_price) . "',
					'0.00000', '0.00', '0.00000', '0.00', '0.00000', '0.00', null, '0.00', 199, 'P', 199, '1.00000', 1, 1, '', '11', '" . $ip . "',
					'" . date('Y-m-d') . " " . date('H:i:s') . "', 0, '" . date('Y-m-d') . " " . date('H:i:s') . "', 0, '0000-00-00 00:00:00', 0)");

               $userinfos = mysqli_query($con, "INSERT INTO rt1fh_virtuemart_order_userinfos (virtuemart_order_userinfo_id, virtuemart_order_id, virtuemart_user_id,
					address_type, address_type_name, company, title, last_name, first_name, middle_name, phone_1, phone_2, fax, address_1, address_2, city,
					virtuemart_state_id, virtuemart_country_id, zip, email, agreed, created_on, created_by, modified_on, modified_by, locked_on, locked_by)
					VALUES ('', '" . $max . "', 0, 'BT', null, null, 'Mr', '" . $_POST['name'] . "', '" . $_POST['name'] . "', null, '" . $_POST['phone'] . "', null, null, '" . $_POST['address'] . "', null, '" . $_POST['vish'] . "',
					0, 220, '0000', '" . $_POST['pocht'] . "', 0, '" . date('Y-m-d') . " " . date('H:i:s') . "', 0, '" . date('Y-m-d') . " " . date('H:i:s') . "', 0, '0000-00-00 00:00:00', 0)");


               mysqli_close($con);


               $body = "<table border='1' cellspacing='10' cellpadding='10'>
					<tr>
					<td>Товар</td>
					<td>" . $_POST['prod_change'] . "</a></td>
					</tr>
					<tr>
					<td>Имя</td>
					<td>" . $_POST['name'] . "</td>
					</tr>
					<tr>
					<td>Телефон</td>
					<td>" . $_POST['phone'] . "</td>
					</tr>
					<tr>
					<td>E-mail</td>
					<td>" . $_POST['pocht'] . "</td>
					</tr>
					<tr>
					<td>Адрес</td>
					<td>" . $_POST['address'] . "</td>
					</tr>
					<tr>
					<td>Пожелание</td>
					<td>" . $_POST['wish'] . "</td>
					</tr>";

               if (isset($product->product_box)) {
                   $body .= "<tr>
					<td>Кол-во</td>
					<td>" . $_POST['koliches'] . "</td>
					</tr>
					</table>";
               } else {
                   $body .= "</table>";
               }


               $mailer->isHTML(true);
               $mailer->setBody($body);

               $send = $mailer->Send();


               if ($send !== true) {
                   echo 'Error sending email: ' . $send->get('message');
               } else {
                   echo '<script>alert("Спacибo, Вaш зaкaз пpинят.");</script>';
               }
           }
           ?>


           </div>

           <?php
           $nb++;

           // Do we need to close the current row now?
           if ($col == $products_per_row || $nb > $BrowseTotalProducts) {
               ?>
               <div class="clear"></div>
               </div>
               <?php
               $col = 1;
               $row++;
           } else {
               $col++;
           }
       }elseif(empty($_REQUEST['cat'])){


           // Show the horizontal seperator
           if ($col == 1 && $nb > $products_per_row) {
               ?>
               <!--	<div class="horizontal-separator"></div>-->
           <?php
           }

           // this is an indicator wether a row needs to be opened or not
           if ($col == 1) {
               ?>
               <div class="row">
           <?php
           }

           // Show the vertical seperator
           if ($nb == $products_per_row or $nb % $products_per_row == 0) {
               $show_vertical_separator = ' ';
           } else {
               $show_vertical_separator = $verticalseparator;
           }

           // Show Products
           ?>
           <div class="product vm-col-100">
           <!--<?php echo ' vm-col-' . $products_per_row . $show_vertical_separator ?>-->

           <div class="spacer">
           <?php
           $url = JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $product->virtuemart_product_id . '&virtuemart_category_id=' . $product->categoryItem[1]['virtuemart_category_id']);

           if($_REQUEST['keyword']){
    $product->link = $url;
}else{
    $product->link =  $product->link.$ItemidStr;
}
           ?>
           <div class="vm-product-descr-container-<?php echo $rowsHeight[$row]['product_s_desc'] ?>">
               <h2><?php echo $product->product_name;//echo JHtml::link($product->link, $product->product_name); ?>
                   <span class="official-diller">Официальный дилер</span>
               </h2>

           </div>
           <div class="vm-product-media-container">
               <?php



               if (in_array(623, $cat_dl)) {
                   //echo '<div class="steker_hit">Хит продаж</div> ';
                   echo '<div class="stek_sl"><img src="/templates/kgu/images/tovardnya.png" /></div>';
               } elseif (in_array(307, $cat_dl)) {
                   //echo '<div class="steker_new">Новинка</div> ';
                   echo '<div class="stek_sl"><img src="/templates/kgu/images/novinki.png" /></div>';
               } elseif (in_array(309, $cat_dl)) {
                   //echo '<div class="steker_sell">Распродажа</div> ';
                   echo '<div class="stek_sl"><img src="/templates/kgu/images/rasprodazha.png" /></div>';
               }
               ?>
               <div class="main-image">
                   <?php echo $product->images[0]->displayMediaFull("",true,"rel='vm-additional-images'"); ?>
                   <!--a title="<?php echo $product->product_name ?>" href="<?php echo $product->link; ?>">
                       <?php
                       echo $product->images[0]->displayMediaThumb('class="browseProductImage"', false);
                       ?>
                   </a-->
               </div>

               <div class="additional-images">
                   <?php



                   $start_image = VmConfig::get('add_img_main', 1) ? 0 : 1;
                   for ($i = $start_image; $i < count($product->images); $i++) {
                       if ($i < '5') {
                           $image = $product->images[$i];
                           ?>
                           <div class="floatleft">
                               <?php
                               if (VmConfig::get('add_img_main', 1)) {
                                   echo $image->displayMediaThumb('class="product-image" style="cursor: pointer"', false, "");
                                   echo '<a href="' . $image->file_url . '"  class="product-image image-' . $i . '" style="display:none;" title="' . $image->file_meta . '" rel="vm-additional-images"></a>';
                               } else {
                                   echo $image->displayMediaThumb("", true, "rel='vm-additional-images'");
                               }
                               ?>
                           </div>
                       <?php
                       }
                   }
                   ?>
                   <div class="clear"></div>
               </div>
               <div class="clear"></div>

               <!--a class="readmore_link" title="<?php echo $product->product_name ?>"
                  href="<?php echo $product->link; ?>">
                   подробнее
               </a-->

               <div class="obor_disc">
                   * Скидку на оборудование уточняйте по телефону
               </div>

               <!--	<div class="additional-images">
						<?php   //print_r($product);
               $start_image = 1;
               for ($i = $start_image; $i < count($product->images); $i++) {
                   $image = $product->images[$i];
                   ?>
							<div class="floatleft">
								<?php
                   if (VmConfig::get('add_img_main', 1)) {
                       echo $image->displayMediaThumb('class="product-image" style="cursor: pointer"', false, "");
                       echo '<a href="' . $image->file_url . '"  class="product-image image-' . $i . '" style="display:none;" title="' . $image->file_meta . '" rel="vm-additional-images"></a>';
                   } else {
                       echo $image->displayMediaThumb("", true, "rel='vm-additional-images'");
                   }
                   ?>
							</div>
						<?php
               }
               ?>
						<div class="clear"></div>
					</div> -->

           </div>
           <div class="product-text">
               <div class="product-dostavka">
                   <?php
                   $lang = JFactory::getLanguage();
                   $lang = $lang->getTag();

                   if ($lang == 'uk-UA') {
                       ?>
                       <a target="blank" class="dostavka" href="/dostavka-i-oplata">Доставка</a>
                       <a target="blank" class="garantija" href="/garantiya">Гарантия</a>
                       <a target="blank" class="credit" href="/kupiti-v-kredit">Кредит</a>
                       <a target="blank" class="montag" href="/montazh-i-servis">Монтаж</a>
                   <?php
                   } elseif ($lang == 'en-GB') {
                       ?>
                       <a target="blank" class="dostavka" href="/en/shipping-and-payment">Доставка</a>
                       <a target="blank" class="garantija" href="/en/warranty">Гарантия</a>
                       <a target="blank" class="credit" href="/en/buy-in-credit">Кредит</a>
                       <a target="blank" class="montag" href="/en/installation-and-service">Монтаж</a>
                   <?php
                   } elseif ($lang == 'ru-RU') {
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
                   if (isset($product->customfieldsSorted)) {
                       ?>
                       <table cellspacing="0">
                           <tr>
                               <td>Модель</td>
                               <td>Холод, кВт</td>
                               <td>Тепло, кВт</td>
                               <td>Цена, грн</td>
                           </tr>
                           <?php
                           // print_r($product);

                           asort($product->customfieldsSorted['related_products']);
                           foreach ($product->customfieldsSorted['related_products'] as $customfield) {
                               $relateds = $productModel->getProductSingle($customfield->customfield_value);
                               $price_cust = round($relateds->allPrices[0]['product_price']);
                               if ($price_cust < 1) {
                                   $price_cust = 'Уточнить цену';
                               }

                               if (!empty($product->product_box)) {
                                   $box_prd = '/' . $product->product_box;
                               }
                               $custurl = JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $customfield->customfield_value . '&virtuemart_category_id=' . $product->virtuemart_category_id);

                               //print_r($customfield);
                               echo '<tr>';
                               echo '<td><a href="'.$custurl.'" title="'.$relateds->product_name.'">' . $relateds->product_name . '</a></td>';
                               echo '<td>' . $relateds->product_s_desc . '</td>';             /*  */
                               echo '<td>' . $relateds->product_desc . '</td>';
                               echo '<td>' . $price_cust . '' . $box_prd . '</td>';
                               echo '</tr>';

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
                               $price_cust = round($product->prices[product_price]);
                               if ($price_cust < 1) {
                                   $price_cust = 'Уточнить цену';
                               }

                               if (!empty($product->product_box)) {
                                   $box_prd = '/' . $product->product_box;
                               }
                               ?>
                               <td><a title="<?php echo $product->product_name ?>" href="<?php echo $product->link; ?>"><?php echo $product->product_name; ?></a></td>
                               <td class="price_new"><?php echo $price_cust . '' . $box_prd; ?></td>
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
                               jimport('joomla.application.module.helper'); // подключаем нужный класс, один раз на странице, перед первым выводом
                               $module = JModuleHelper::getModules('mobile'); // получаем в массив все модули из заданной позиции
                               $attribs['style'] = 'specpredtov'; // задаём, если нужно, оболочку модулей (module chrome)
                               echo JModuleHelper::renderModule($module[0], $attribs); // выводим первый модуль из заданной позиции
                               ?>
                           </div>
                       </div>

                       <div class="feed_bl">
                           <span
                               onclick="jQuery('#feed_back_up<?php echo $product->virtuemart_product_id; ?>').css({'top':'0px', 'left':'0px'}); wObj=document.getElementById('feed_back_up<?php echo $product->virtuemart_product_id; ?>'); wObj.style.opacity=1; wObj.style.display='block'; op=0; appear();">Обратный звонок</span>
                       </div>

                       <div class="product-zakaz">
                           <a onclick="jQuery('#divwin_call<?php echo $product->virtuemart_product_id; ?>').css({'top':'0px', 'left':'0px'}); wObj=document.getElementById('divwin_call<?php echo $product->virtuemart_product_id; ?>'); wObj.style.opacity=1; wObj.style.display='block'; op=0; appear();">Заказать
                           </a>
                       </div>
                       <div class="clear"></div>
                   </div>
               </div>
               <div class="clear"></div>
               <!--
            <?php if (!empty($rowsHeight[$row]['product_s_desc'])) {
                   ?>

                       <div class="full_description">

                    <?php
                   if (!empty($product->product_desc)) {
                       // echo $product->product_desc;
                   } ?>
                <a class="product-readmore" href="<?php echo $product->link; ?>">Подробнее...</a>

            </div>

			<?php
               }
               ?>
           -->


               <p class="product_s_desc">
                   <?php // Product Short Description
                   if (!empty($product->product_s_desc)) {
                       //echo shopFunctionsF::limitStringByWord ($product->product_s_desc, 2000, ' ...')
                       ?>
                   <?php } ?>

               </p>


           </div>

           <div class="vm-product-rating-container">
               <?php echo shopFunctionsF::renderVmSubLayout('rating', array('showRating' => $showRating, 'product' => $product));
               if (VmConfig::get('display_stock', 1)) {
                   ?>
                   <span class="vmicon vm2-<?php echo $product->stock->stock_level ?>"
                         title="<?php echo $product->stock->stock_tip ?>"></span>
               <?php
               }
               echo shopFunctionsF::renderVmSubLayout('stockhandle', array('product' => $product));
               ?>
           </div>





           <?php //echo $rowsHeight[$row]['price'] ?>
           <div class="vm3pr-<?php echo $rowsHeight[$row]['price'] ?>"> <?php
               //echo shopFunctionsF::renderVmSubLayout('prices',array('product'=>$product,'currency'=>$currency));
               ?>
               <div class="clear"></div>
           </div>
           <?php //echo $rowsHeight[$row]['customs'] ?>
           <div class="vm3pr-<?php echo $rowsHeight[$row]['customfields'] ?>"> <?php
               echo shopFunctionsF::renderVmSubLayout('addtocart', array('product' => $product, 'rowHeights' => $rowsHeight[$row])); ?>
           </div>

           <div class="vm-details-button">
               <?php // Product Details Button
               $link = empty($product->link) ? $product->canonical : $product->link;
               echo JHtml::link($link . $ItemidStr, vmText::_('COM_VIRTUEMART_PRODUCT_DETAILS'), array('title' => $product->product_name, 'class' => 'product-details'));
               //echo JHtml::link ( JRoute::_ ( 'index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $product->virtuemart_product_id . '&virtuemart_category_id=' . $product->virtuemart_category_id , FALSE), vmText::_ ( 'COM_VIRTUEMART_PRODUCT_DETAILS' ), array ('title' => $product->product_name, 'class' => 'product-details' ) );

               ?>
           </div>


           </div>

           <div class="divwin_order_off feed_back_up_cat"
                id="feed_back_up<?php echo $product->virtuemart_product_id; ?>">
               <div class="closeButton" onclick="wObj.style.display='none';jQuery('#bgOverlay').empty();"><img
                       src="/templates/kgu/images/vsplyw-close.png"/></div>
               <div class="order_off_tit">Обратный звонок</div>
               <form id="formZakaz" method="post" action=""
                     onsubmit="return myValidationfeed<?php echo $product->virtuemart_product_id; ?>()">
                   <div class="order_off_single">
                       <label>Ваше имя:</label>
                       <input type="text" name="name_feed" value=""/>
                   </div>

                   <div class="order_off_single">
                       <label>Ваш телефон <span class="star">*</span>:</label>
                       <input type="text" name="phone_feed" value=""/>
                   </div>

                   <input type="submit" value="Отправить"
                          name="order_sub_feed<?php echo $product->virtuemart_product_id; ?>" id="otpravit">
               </form>
           </div>

           <script type="text/javascript">
               function myValidationfeed<?php echo $product->virtuemart_product_id; ?>() {
                   var phone_feed = jQuery('#feed_back_up<?php echo $product->virtuemart_product_id; ?>').find('input[name=phone_feed]').val();

                   if (phone_feed.length == 0) {
                       if (phone_feed.length == 0) {
                           jQuery('#feed_back_up<?php echo $product->virtuemart_product_id; ?>').find('input[name=phone_feed]').css('border', '1px solid #FF0000');
                       } else {
                           jQuery('#feed_back_up<?php echo $product->virtuemart_product_id; ?>').find('input[name=phone_feed]').css('border', '1px solid #688F9E');
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
           if (isset($_POST['order_sub_feed' . $product->virtuemart_product_id])) {
               $db_feed =& JFactory::getDBO();
               $sql_feed = "SELECT email FROM #__users WHERE id = 42";
               $res_feed = $db_feed->setQuery($sql_feed)->loadObjectList();
               $mailer_feed = JFactory::getMailer();

               $sender_feed = 'info@kgu.com.ua';


               $mailer_feed->setSender($sender_feed);
               $subject_feed = 'Обратный звонок';
               $mailer_feed->setSubject($subject_feed);


               //$recipient[] = 'alfressko@gmail.com';	// Почтовый ящик администратора
               $recipient_feed[] = 'info@kgu.com.ua';
               $recipient_feed[] = 'oksana@kgu.com.ua';


               $mailer_feed->addRecipient($recipient_feed);


               $body_feed = "<table border='1' cellspacing='10' cellpadding='10'>
			<tr>
			<td colspan='2'>Обратный звонок</td>
			</tr>
			<tr>
			<td>Имя</td>
			<td>" . $_POST['name_feed'] . "</td>
			</tr>
			<tr>
			<td>Телефон</td>
			<td>" . $_POST['phone_feed'] . "</td>
			</tr>
			</table>";


               $mailer_feed->isHTML(true);
               $mailer_feed->setBody($body_feed);

               $send_feed = $mailer_feed->Send();

               if ($send_feed !== true) {
                   echo 'Error sending email: ' . $send_feed->get('message');
               } else {
                   echo '<script>alert("Спacибo, Вaш запрос отправлен.");</script>';
               }
           }
           ?>





           <div class="divwin_order_off" id="divwin_call<?php echo $product->virtuemart_product_id; ?>">
               <?php
               /*
               $lang = JFactory::getLanguage();
               $lang = $lang->getTag();

               if($lang == 'uk-UA') {
                   $order_off_tit = 'Замовлення товару';
                   $order_off_single_name = 'Ваше ім’я:';
                   $order_off_single_phone = 'Ваш телефон';
                   $order_off_single_mail = 'Ваш e-mail';
                   $order_off_single_wich = 'Побажання:';
                   $order_off_single_button = 'Замовити';
               }
               elseif($lang == 'en-GB') {
                   $order_off_tit = 'Order product';
                   $order_off_single_name = 'Your name:';
                   $order_off_single_phone = 'Your phone';
                   $order_off_single_mail = 'Your e-mail';
                   $order_off_single_wich = 'Wish:';
                   $order_off_single_button = 'Order';
               }
               elseif($lang == 'ru-RU') {
                   $order_off_tit = 'Заказ товара';
                   $order_off_single_name = 'Ваше имя:';
                   $order_off_single_phone = 'Ваш телефон';
                   $order_off_single_mail = 'Ваш e-mail';
                   $order_off_single_wich = 'Пожелание:';
                   $order_off_single_button = 'Заказать';
               }
               */
               ?>
               <div class="closeButton" onclick="wObj.style.display='none';jQuery('#bgOverlay').empty();"><img
                       src="/templates/kgu/images/vsplyw-close.png"/></div>
               <div class="order_off_tit">Заказ товара</div>
               <form id="formZakaz" method="post" action=""
                     onsubmit="return myValidation<?php echo $product->virtuemart_product_id; ?>()">
                   <div class="order_off_single">
                       <label>Ваше имя:</label>
                       <input type="text" name="name" value=""/>
                   </div>

                   <div class="order_off_single">
                       <label>Ваш телефон <span class="star">*</span>:</label>
                       <input type="text" name="phone" value=""/>
                   </div>

                   <div class="order_off_single">
                       <label>Ваш e-mail:</label>
                       <input type="text" name="pocht" value=""/>
                   </div>

                   <div class="order_off_single">
                       <label>Ваш адрес:</label>
                       <input type="text" name="address" value=""/>
                   </div>

                   <div class="order_off_single">
                       <label>Пожелание:</label>
                       <input type="text" name="wish" value=""/>
                   </div>

                   <?php
                   if (isset($product->product_box)) {
                       ?>
                       <div class="order_off_single">
                           <label>Количество:</label>
                           <input type="text" name="koliches" value=""/>
                       </div>
                   <?php
                   } else {
                       ?>
                       <input type="hidden" name="koliches" value="1"/>
                   <?php
                   }
                   ?>


                   <?php
                   if (isset($product->customfieldsSorted)) {
                       ?>
                       <div class="order_off_single">
                           <label>Выберите модель:</label>
                           <select name="prod_change">
                               <?php
                               foreach ($product->customfieldsSorted['related_products'] as $customfield) {
                                   $relateds = $productModel->getProductSingle($customfield->customfield_value);
                                   echo '<option>' . $relateds->product_name . ' - ' . round($relateds->allPrices[0]['product_price']) . 'грн.</option>';
                               }
                               ?>
                           </select>
                       </div>
                   <?php
                   } else {
                       ?>
                       <input type="hidden" name="prod_change"
                              value="<?php echo $price_cust . '/' . $product->product_box; ?>"/>
                   <?php
                   }
                   ?>
                   <input type="hidden" name="nametov" value="<?php echo $product->product_name; ?>"/>

                   <input type="submit" value="Заказать" name="order_sub<?php echo $product->virtuemart_product_id; ?>"
                          id="otpravit">
               </form>
           </div>

           <script type="text/javascript">
               function myValidation<?php echo $product->virtuemart_product_id; ?>() {
                   var phone = jQuery('#divwin_call<?php echo $product->virtuemart_product_id; ?>').find('input[name=phone]').val();

                   if (phone.length == 0) {
                       if (phone.length == 0) {
                           jQuery('#divwin_call<?php echo $product->virtuemart_product_id; ?>').find('input[name=phone]').css('border', '1px solid #FF0000');
                       } else {
                           jQuery('#divwin_call<?php echo $product->virtuemart_product_id; ?>').find('input[name=phone]').css('border', '1px solid #688F9E');
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
           $mainframe = JFactory::getApplication();
           $url = JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $product->virtuemart_product_id . '&virtuemart_category_id=' . $product->virtuemart_category_id);

           if (isset($_POST['order_sub' . $product->virtuemart_product_id])) {
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


               $confFile = JPATH_SITE . "/configuration.php";
               require_once($confFile);
               $conf = new JConfig();

               $con = new mysqli($conf->host, $conf->user, $conf->password, $conf->db);
               $con->set_charset("utf8");

               $reslast = $db->setQuery($sqlmax)->loadObjectList();
               $fir = (float)$reslast[0]->num;
               $sec = 1;
               $max = $fir + $sec;

               mysqli_query($con, "INSERT INTO rt1fh_order_numbers (number) VALUES (" . $max . ")");

               $ip = $_SERVER["REMOTE_ADDR"];
               $id = mysqli_query($con, "SELECT virtuemart_order_id FROM rt1fh_virtuemart_orders ORDER BY created_on DESC ");
               $row = mysqli_fetch_array($id);
               $last = (int)($row[0]) + 1;

               $items = mysqli_query($con, "INSERT INTO rt1fh_virtuemart_order_items (virtuemart_order_item_id, virtuemart_order_id, virtuemart_vendor_id,
					virtuemart_product_id, order_item_sku, order_item_name, product_quantity, product_item_price, product_tax, product_basePriceWithTax,
					product_final_price, product_subtotal_discount, product_subtotal_with_tax, order_item_currency, order_status, product_attribute, created_on, created_by, modified_on,
					modified_by, locked_on, locked_by)
					VALUES ('', '" . $max . "', 1,
					'" . $product->virtuemart_product_id . "', '" . $product->product_sku . "', '" . $product->product_name . "-" . $_POST['prod_change'] . "', " . $_POST['koliches'] . ",
					'" . ceil($product->product_price) . "', '0.00000', '0.00000', '" . $product->product_price . "', '0.00000', '0.00000', null, 'P',
					null, '" . date('Y-m-d') . " " . date('H:i:s') . "', 0, '" . date('Y-m-d') . " " . date('H:i:s') . "', 0, '0000-00-00 00:00:00', 0)");

               $orders = mysqli_query($con, "INSERT INTO rt1fh_virtuemart_orders (`virtuemart_order_id`, `virtuemart_user_id`, `virtuemart_vendor_id`,
					`order_number`, `customer_number`, `order_pass`, `order_total`, `order_salesPrice`, `order_billTaxAmount`, `order_billTax`, `order_billDiscountAmount`,
					`order_discountAmount`, `order_subtotal`, `order_tax`, `order_shipment`, `order_shipment_tax`, `order_payment`, `order_payment_tax`,
					`coupon_discount`, `coupon_code`, `order_discount`, `order_currency`, `order_status`, `user_currency_id`, `user_currency_rate`,
					`virtuemart_paymentmethod_id`, `virtuemart_shipmentmethod_id`, `delivery_date`, `order_language`, `ip_address`, `created_on`, `created_by`, `modified_on`,
					`modified_by`, `locked_on`, `locked_by`)
					VALUES ('', 0, 1, '" . $max . "', '" . $max . "', 'p_000c', '" . ceil($product->product_price) . "', '111', '0.00000', 0, '0.00000', '0.00000', '" . ceil($product->product_price) . "',
					'0.00000', '0.00', '0.00000', '0.00', '0.00000', '0.00', null, '0.00', 199, 'P', 199, '1.00000', 1, 1, '', '11', '" . $ip . "',
					'" . date('Y-m-d') . " " . date('H:i:s') . "', 0, '" . date('Y-m-d') . " " . date('H:i:s') . "', 0, '0000-00-00 00:00:00', 0)");

               $userinfos = mysqli_query($con, "INSERT INTO rt1fh_virtuemart_order_userinfos (virtuemart_order_userinfo_id, virtuemart_order_id, virtuemart_user_id,
					address_type, address_type_name, company, title, last_name, first_name, middle_name, phone_1, phone_2, fax, address_1, address_2, city,
					virtuemart_state_id, virtuemart_country_id, zip, email, agreed, created_on, created_by, modified_on, modified_by, locked_on, locked_by)
					VALUES ('', '" . $max . "', 0, 'BT', null, null, 'Mr', '" . $_POST['name'] . "', '" . $_POST['name'] . "', null, '" . $_POST['phone'] . "', null, null, '" . $_POST['address'] . "', null, '" . $_POST['vish'] . "',
					0, 220, '0000', '" . $_POST['pocht'] . "', 0, '" . date('Y-m-d') . " " . date('H:i:s') . "', 0, '" . date('Y-m-d') . " " . date('H:i:s') . "', 0, '0000-00-00 00:00:00', 0)");


               mysqli_close($con);


               $body = "<table border='1' cellspacing='10' cellpadding='10'>
					<tr>
					<td>Товар</td>
					<td>" . $_POST['prod_change'] . "</a></td>
					</tr>
					<tr>
					<td>Имя</td>
					<td>" . $_POST['name'] . "</td>
					</tr>
					<tr>
					<td>Телефон</td>
					<td>" . $_POST['phone'] . "</td>
					</tr>
					<tr>
					<td>E-mail</td>
					<td>" . $_POST['pocht'] . "</td>
					</tr>
					<tr>
					<td>Адрес</td>
					<td>" . $_POST['address'] . "</td>
					</tr>
					<tr>
					<td>Пожелание</td>
					<td>" . $_POST['wish'] . "</td>
					</tr>";

               if (isset($product->product_box)) {
                   $body .= "<tr>
					<td>Кол-во</td>
					<td>" . $_POST['koliches'] . "</td>
					</tr>
					</table>";
               } else {
                   $body .= "</table>";
               }


               $mailer->isHTML(true);
               $mailer->setBody($body);

               $send = $mailer->Send();


               if ($send !== true) {
                   echo 'Error sending email: ' . $send->get('message');
               } else {
                   echo '<script>alert("Спacибo, Вaш зaкaз пpинят.");</script>';
               }
           }
           ?>


           </div>

           <?php
           $nb++;

           // Do we need to close the current row now?
           if ($col == $products_per_row || $nb > $BrowseTotalProducts) {
               ?>
               <div class="clear"></div>
               </div>
               <?php
               $col = 1;
               $row++;
           } else {
               $col++;
           }
       }else{

        }

  }



      if(!empty($type)and count($products)>0){
        // Do we need a final closing row tag?
        //if ($col != 1) {
      ?>

    <div class="clear"></div>
  </div>

    <?php
    // }
    }
  }
/*foreach ( $products as $product ) {
    echo 'DELETE FROM `klimatgo_db`.`rt1fh_virtuemart_products` WHERE `rt1fh_virtuemart_products`.`virtuemart_product_id` = ' . $product->virtuemart_product_id . ';<br>';
}*/
?>

