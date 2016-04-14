<?php
/**
 * Products, Quotations & Invoices modules.
 * Extensions to SugarCRM
 * @package Advanced OpenSales for SugarCRM
 * @subpackage Products
 * @copyright SalesAgility Ltd http://www.salesagility.com
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU AFFERO GENERAL PUBLIC LICENSE as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU AFFERO GENERAL PUBLIC LICENSE
 * along with this program; if not, see http://www.gnu.org/licenses
 * or write to the Free Software Foundation,Inc., 51 Franklin Street,
 * Fifth Floor, Boston, MA 02110-1301  USA
 *
 * @author Salesagility Ltd <support@salesagility.com>
 */

require_once 'modules/AOS_PDF_Templates/templateParser.php';
 
class aowTemplateParser extends templateParser {

		static function parse_template($string, $bean_arr) {
			global $beanList;

            $person = array();
	
			foreach($bean_arr as $bean_name => $bean_id) {

				$focus = BeanFactory::getBean($bean_name, $bean_id);
				$string = aowTemplateParser::parse_template_bean($string, strtolower($beanList[$bean_name]), $focus);

                if($focus instanceof Person){
                    $person[] = $focus;
                }
				
			}

            if(!empty($person)){
                $focus = $person[0];
            } else {
                $focus = new Contact();
            }
            $string = aowTemplateParser::parse_template_bean($string, 'contact', $focus);

			return $string;
		}
	}
?>
