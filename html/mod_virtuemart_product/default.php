<?php // no direct access
defined ('_JEXEC') or die('Restricted access');
// add javascript for price and cart, need even for quantity buttons, so we need it almost anywhere
vmJsApi::jPrice();



$col = 1;
$pwidth = ' width' . floor (100 / $products_per_row);
if ($products_per_row > 1) {
	$float = "floatleft";
} else {
	$float = "center";
}
?>
<div class="vmgroup<?php echo $params->get ('moduleclass_sfx') ?>">

	<?php if ($headerText) { ?>
	<div class="vmheader"><?php echo $headerText ?></div>
	<?php
}
	if ($display_style == "div") {
    $db = JFactory::getDBO();
        $cat = JRequest::getInt('virtuemart_category_id');
$catarr = array();
    ?>
    <div class="vmproduct<?php echo $params->get('moduleclass_sfx'); ?> productdetails">
        <?php foreach ($products as $product) {
if($product->categoryItem[0]['virtuemart_category_id'] == $cat) {
//echo $product->virtuemart_product_id.'-';
    foreach ($product->categoryItem as $i => $caty) {
        //echo $caty['virtuemart_category_id'].'<br>';
        //array_push($catarr, $caty['virtuemart_category_id']);

    }


    //if (in_array(307, $catarr) || in_array(623, $catarr) || in_array(309, $catarr)) {
//print_r($catarr);

        ?>
        <div class="singl_slide_prod">


            <div class="spacer">
                <div class="singl_slide_prod_img">
                    <?php
                    $url = JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $product->virtuemart_product_id . '&virtuemart_category_id=' . $product->categoryItem[1]['virtuemart_category_id']);

                    if (!empty($product->images[0])) {
                        //print_r($product->images[0][file_url_thumb]);
                        $image = $product->images[0]->displayMediaThumb('class="featuredProductImage" border="0"', FALSE);
                    } else {
                        $image = '';
                    }
                    echo JHTML::_('link', JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $product->virtuemart_product_id . '&virtuemart_category_id=' . $product->categoryItem[1]['virtuemart_category_id']), $image, array('title' => $product->product_name));
                    //					echo '<div class="clear"></div>';
                    //print_r($product);
                    $url_cust = $product->link . $ItemidStr;
                    ?>
                </div>

                <div class="singl_slide_prod_info">
                    <a href="<?php echo $url; ?>"
                       class="product-name"><span><?php echo $product->product_name ?></span></a>

                    <div class="price">

                        <?php


                        $query = "SELECT cusom.virtuemart_product_id, cusom.customfield_value, price.product_price
FROM  rt1fh_virtuemart_product_prices as price
LEFT JOIN rt1fh_virtuemart_product_customfields AS cusom ON price.virtuemart_product_id = cusom.customfield_value
WHERE  cusom.virtuemart_product_id =" . $product->virtuemart_product_id;

                        $db->setQuery($query);
                        $result = $db->loadAssocList();
                        echo 'от ' . round($result[0]['product_price']) . ' грн.';

                        ?>
                    </div>
                </div>
                <div class="clear"></div>

                <?php
                if ($show_price) {
                    // 		echo $currency->priceDisplay($product->prices['salesPrice']);
                    if (!empty($product->prices['salesPrice'])) {
                        echo $currency->createPriceDiv('salesPrice', '', $product->prices, FALSE, FALSE, 1.0, TRUE);
                    }
                    // 		if ($product->prices['salesPriceWithDiscount']>0) echo $currency->priceDisplay($product->prices['salesPriceWithDiscount']);
                    if (!empty($product->prices['salesPriceWithDiscount'])) {
                        echo $currency->createPriceDiv('salesPriceWithDiscount', '', $product->prices, FALSE, FALSE, 1.0, TRUE);
                    }
                }
                if ($show_addtocart) {
                    echo shopFunctionsF::renderVmSubLayout('addtocart', array('product' => $product));
                }
                ?>
            </div>
        </div>
    <?php

    //}
}
        }?>
		<div class="clear"></div>
		</div>
		<br style='clear:both;'/>
		<?php
	} else {
		$last = count ($products) - 1;
		?>

		<ul class="vmproduct<?php echo $params->get ('moduleclass_sfx'); ?> productdetails">
			<?php foreach ($products as $product) : ?>
			<li class="<?php echo $pwidth ?> <?php echo $float ?>">
				<?php
				if (!empty($product->images[0])) {
					$image = $product->images[0]->displayMediaThumb ('class="featuredProductImage" border="0"', FALSE);
				} else {
					$image = '';
				}
				echo JHTML::_ ('link', JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $product->virtuemart_product_id . '&virtuemart_category_id=' . $product->virtuemart_category_id), $image, array('title' => $product->product_name));
				echo '<div class="clear"></div>';
				$url = JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $product->virtuemart_product_id . '&virtuemart_category_id=' .
					$product->virtuemart_category_id); ?>
				<a href="<?php echo $url ?>"><?php echo $product->product_name ?></a>        <?php    echo '<div class="clear"></div>';
				// $product->prices is not set when show_prices in config is unchecked
				if ($show_price and  isset($product->prices)) {
					echo '<div class="product-price">'.$currency->createPriceDiv ('salesPrice', '', $product->prices, FALSE, FALSE, 1.0, TRUE);
					if ($product->prices['salesPriceWithDiscount'] > 0) {
						echo $currency->createPriceDiv ('salesPriceWithDiscount', '', $product->prices, FALSE, FALSE, 1.0, TRUE);
					}
					echo '</div>';
				}
				if ($show_addtocart) {
					echo shopFunctionsF::renderVmSubLayout('addtocart',array('product'=>$product));
				}
				?>
			</li>
			<?php
			if ($col == $products_per_row && $products_per_row && $last) {
				echo '
		</ul><div class="clear"></div>
		<ul  class="vmproduct' . $params->get ('moduleclass_sfx') . ' productdetails">';
				$col = 1;
			} else {
				$col++;
			}
			$last--;
		endforeach; ?>
		</ul>
		<div class="clear"></div>

		<?php
	}
	if ($footerText) : ?>
		<div class="vmfooter<?php echo $params->get ('moduleclass_sfx') ?>">
			<?php echo $footerText ?>
		</div>
		<?php endif; ?>


</div>