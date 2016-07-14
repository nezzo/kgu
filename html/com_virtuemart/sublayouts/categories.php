<?php
/**
*
* Shows the products/categories of a category
*
* @package	VirtueMart
* @subpackage
* @author Max Milbers
* @link http://www.virtuemart.net
* @copyright Copyright (c) 2004 - 2014 VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
 * @version $Id: default.php 6104 2012-06-13 14:15:29Z alatak $
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

$categories = $viewData['categories'];
$categories_per_row = VmConfig::get ( 'categories_per_row', 3 );


if ($categories) {

// Category and Columns Counter
$iCol = 1;
$iCategory = 1;

// Calculating Categories Per Row
$category_cellwidth = ' width'.floor ( 100 / $categories_per_row );

// Separator
$verticalseparator = " vertical-separator";
?>

<div class="category-view">

<?php
    $ItemidStr = '';
    $Itemid = shopFunctionsF::getLastVisitedItemId();
    $productModel = VmModel::getModel('product');
    if(!empty($Itemid)){
        $ItemidStr = '&Itemid='.$Itemid;
    }

// Start the Output
    foreach ( $categories as $category ) {

	    // Show the horizontal seperator
	    if ($iCol == 1 && $iCategory > $categories_per_row) { ?>
<!--	    <div class="horizontal-separator"></div>-->
	    <?php }

	    // this is an indicator wether a row needs to be opened or not
	    if ($iCol == 1) { ?>
<!--  <div class="row">-->
        <?php }

        // Show the vertical separator
        if ($iCategory == $categories_per_row or $iCategory % $categories_per_row == 0) {
          $show_vertical_separator = ' ';
        } else {
          $show_vertical_separator = $verticalseparator;
        }

        // Category Link
        $caturl = JRoute::_ ( 'index.php?option=com_virtuemart&view=category&virtuemart_category_id=' . $category->virtuemart_category_id , FALSE);


          // Show Category ?>
    <div class="category floatleft width100<?php echo $show_vertical_separator ?>">
      <div class="spacer">

          <!--$category_cellwidth-->



        <h2>
          <a href="<?php echo $caturl ?>" title="<?php echo $category->category_name ?>">
          <?php echo $category->category_name ?>
              <span class="official-diller">Официальный диллер</span>
          </a>
        </h2>
          <div class="category-image">
              <a href="<?php echo $caturl ?>" title="">
                  <?php // if ($category->ids) {
                  	//print_r($category);
                echo $category->images[0]->displayMediaThumb("",false);
                //}
                ?>
              </a>
          </div>

          <div class="category_description cat_horizontal">

	<?php echo $category->category_description; ?>
              </div>

<div class="cat_brand_products">
          <?php
    $ids = $productModel->sortSearchListQuery (TRUE, $category->virtuemart_category_id,'featured');
    $products = $productModel->getProducts ($ids);

    $productModel->addImages($products,1);




    foreach($products as $product){


       echo '<div class="brand_one_product">';

        ?>

    <a href="<?php echo $product->link; ?>"><?php echo $product->images[0]->displayMediaThumb('class="browseProductImage"', false); ?></a>

        <?php

        echo JHtml::link ($product->link.$ItemidStr, $product->product_name);


        echo '<table cellspacing="0"><tr><td>Модель</td><td>Цена, грн</td></tr>';
        foreach($product->customfields as $customfield){
            $relateds = $productModel->getProductSingle($customfield->customfield_value);


            echo '<tr><td>';
            echo $relateds->product_name;
            echo '</td><td>';
            echo round($relateds->allPrices[0]['product_price']);
            echo '</td></tr>';
        }
        echo '</table>';

        echo '</div>';

    } ?>
        </div>


      </div>
    </div>
	    <?php
	    $iCategory ++;

	    // Do we need to close the current row now?
        if ($iCol == $categories_per_row) { ?>
<!--
    <div class="clear"></div>
	</div>
-->
		    <?php
		    $iCol = 1;
	    } else {
		    $iCol ++;
	    }
    }
	// Do we need a final closing row tag?
	 ?>
		<div class="clear"></div>
	</div>
	<?php

	?>

<?php


 } ?>
