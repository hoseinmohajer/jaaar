<?php
/**
 * Application level View Helper
 *
 * This file is application-wide helper file. You can put all
 * application-wide helper-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Helper
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Helper', 'View');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */
class AppHelper extends Helper {
	function mkjalalidt($timestamp = null, $dt_name = null, $label = null) {
			App::import("Vendor","jdf");
			$dt_year_name = $dt_name . '_year';
			$dt_month_name = $dt_name . '_month';
			$td_day_name = $dt_name . '_day';
			if($timestamp == 0){ 
				$timestamp = time();
				$timezone = 'Asia/Tehran';
				} else{
					$timestamp = $timestamp;
		 			$timezone = '';
				}
			$year_select = jdate('Y',$timestamp,'',$timezone,'en');
			$month_select = jdate('m',$timestamp,'',$timezone,'en');
			$day_select = jdate('d',$timestamp,'',$timezone,'en');
			$mon_name = array('1' => 'فروردین','2' => 'اردیبهشت','3' => 'خرداد','4' => 'تیر','5' => 'مرداد','6' => 'شهریور'
								,'7' => 'مهر','8' => 'آبان','9' => 'آذر','10' => 'دی','11' => 'بهمن','12' => 'اسفند');

				$temp = "<div class = 'select_box'><label id='dt_label' for='dt'>".$label."</label>";
				$temp .="<select id='year' style=' height:26px;padding:3px 0 3px 3px;width:87px;float:left; ' name='".$dt_year_name."'>";
					/*for($i=1320;$i<=jdate('Y',time(),'','Asia/Tehran','en');$i++){
						$temp.= $i == $year_select ?"<option value=$i selected>$i</option>":"<option value=$i>$i</option>";
					}*/
				$temp.= "<option value=1392 selected>1392</option>";
				$temp .="</select>
				<select id='month' style=' height:26px;padding:0px;width:122px;clear:right; float:left;margin-left:10px' name='".$dt_month_name."'>";
				 for($i=1;$i<=12;$i++) {
				 $temp.=$i==$month_select ?"<option value=$i selected>$mon_name[$i]</option>":"<option value=$i>$mon_name[$i]</option>";
				 }
				$temp.= "</select>
				<select id='day' style=' height:26px;padding:0px;width:67px;clear:right; float:left;margin-left:10px;' name='".$td_day_name."'>";
				 for($i=1;$i<=31;$i++){
				$temp.= $i==$day_select ? "<option value=$i selected>$i</option>":"<option value=$i>$i</option>";
						}
				$temp.="</select></div>";
				return $temp;
		}
}
