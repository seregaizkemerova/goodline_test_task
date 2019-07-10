<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use DateTime;
use DateInterval;
use DateTimeZone;

class Pasta extends Model
{
	private $_table_name = 'vachikov_testtask_pasta';
	
	
	public function __construct() {
		if (!Schema::hasTable($this->_table_name)) {
			Schema::create($this->_table_name, function (Blueprint $table) {
				$table->increments('id');
				$table->string('link', 100);
				$table->string('title', 255);
				$table->text('body');
				$table->dateTime('dtadd');
				$table->dateTime('dtexp');
				$table->string('access', 20);
			});
		}
	}
    
	
	private function getClearText($str = '') {
		//$str = str_replace('"', '', $str);
		//$str = str_replace("'", '', $str);
		//$str = htmlspecialchars($str);
		$str = addslashes($str);
		return $str;
	}
	
	
	private function getParamInArray($_param, $_params) {
		if (in_array($_param, $_params)) {
			return $_param;
		} else {
			return false;
		}
	}
	
	
	public function getLastTexts($except = 0, $_limit = 10) {
		$and = '';
		if ($except > 0) {
			$and = ' AND id<>"' . $except . '"';
		}
		$results = DB::select('SELECT id, link, title, dtadd, dtexp
				               FROM ' . $this->_table_name . ' 
				               WHERE access = "public"
				                 AND dtexp >= NOW() 
								 ' . $and . '
				               ORDER BY id DESC LIMIT ' . $_limit);
		return $results;
	}
	
	
	public function getText($_link = '') {
		if ($_link != '') {
			$results = DB::select('SELECT * FROM ' . $this->_table_name . ' WHERE link = "pasta' . $_link . '" AND dtexp >= NOW()');

			//Если нашелся текст по коду и он все еще доступен (по времени) - то возвращаем его, если нет, то false
			if (isset($results) && count($results) > 0) {
				return $results[0];
			} else {
				return false;
			}
			
		} else {
			return false;
		}
	}
	
	
	public function addText($request) {
		
		$access_p = array('public'
			    	     ,'unlisted'
		            );
		
		$exp_p    = array('PT10M'
				         ,'PT1H'
						 ,'PT3H'
						 ,'P1D'
						 ,'P1W'
						 ,'P1M'
				         ,'P1000Y'
				    );
		
		$dt = new DateTime('now');
		
		$insert['link']   = 'pasta' . dechex(strtotime($dt->format('Y-m-d H:i:s') ) );
		$insert['title']  = $this->getClearText($request->title);
		$insert['body']   = $this->getClearText($request->body);
		$insert['access'] = $this->getParamInArray($request->access, $access_p);
		$insert['dtadd']  = $dt->format('Y-m-d H:i:s');
		
		$exp = $this->getParamInArray($request->exp, $exp_p);
		
		//добавляем к текущей дате выбранный интервал
		$dt->add(new DateInterval($exp) );
		$insert['dtexp']  = $dt->format('Y-m-d H:i:s');
		
		//Перед тем, как делать insert - все поля прошли фильтр. Текстовые - очистку. Выборные - на то, что значение не "подделают". Если из формы пришло что-то неккоректное - insert делаться не будет.
		if ($insert['access'] && $exp) {
			DB::table($this->_table_name)->insert($insert);
		}
		
		return $insert['link'];
	}
}
