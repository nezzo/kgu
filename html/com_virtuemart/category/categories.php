<?php
/**
*
* Show the products in a category
*
* @package	VirtueMart
* @subpackage
* @author RolandD
* @author Max Milbers
* @todo add pagination
* @link http://www.virtuemart.net
* @copyright Copyright (c) 2004 - 2012 VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
 * @version $Id: default.php 6104 2012-06-13 14:15:29Z alatak $
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

if ($this->category->haschildren) {

	// Calculating Categories Per Row
	//$categories_per_row = VmConfig::get ( 'categories_per_row', 3 );

	// Start the Output
	//echo ShopFunctionsF::renderVmSubLayout('categories',array('categories'=> $this->category->children));

}

echo '<br /><h1>'.$this->category->category_name.'</h1>';
?>
<div class="brands_blo">
	    <?php
	         jimport( 'joomla.application.module.helper' ); // подключаем нужный класс, один раз на странице, перед первым выводом
	         $module = JModuleHelper::getModules('brands'); // получаем в массив все модули из заданной позиции
	         $attribs['style'] = 'xhtml'; // задаём, если нужно, оболочку модулей (module chrome)
	         echo JModuleHelper::renderModule($module[0], $attribs); // выводим первый модуль из заданной позиции
	    ?>
    </div>

<?php
echo '<div class="cat_desc">'.$this->category->category_description.'</div>';

?>