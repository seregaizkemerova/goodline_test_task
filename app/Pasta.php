<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use DateTime;
use DateInterval;
use DateTimeZone;

use Auth;

class Pasta extends Model
{
	private $_table_name = 'vachikov_testtask_pasta';
	
	
	public function __construct() {
		if (!Schema::hasTable($this->_table_name)) {
			Schema::create($this->_table_name, function (Blueprint $table) {
				$table->increments('id');
				$table->integer('user_id');
				$table->string('link', 100);
				$table->string('title', 255);
				$table->text('body');
				$table->dateTime('dtadd');
				$table->dateTime('dtexp');
				$table->string('access', 20);
				$table->string('lang', 50);
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
	
	
	public function getLastTexts($except = 0, $limit = 10) {
		$and = '';
		if ($except > 0) {
			$and .= ' AND id<>"' . $except . '"';
		}
		$results = DB::select('SELECT id, link, title, dtadd, dtexp
				               FROM ' . $this->_table_name . ' 
				               WHERE access = "public"
				                 AND dtexp >= NOW() 
								 ' . $and . '
				               ORDER BY id DESC LIMIT ' . $limit);

		if (isset($results) && count($results) > 0) {
			return $results;
		} else {
			return false;
		}
	}
	
	
	public function getUserTexts($limit = 10) {
		if (!empty(Auth::user()->id) ) {
			$results = DB::select('SELECT id, link, title, dtadd, dtexp, access
					               FROM ' . $this->_table_name . '
					               WHERE user_id = "' . Auth::user()->id . '"
					               ORDER BY id DESC LIMIT ' . $limit);
			if (isset($results) && count($results) > 0) {
				return $results;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	
	public function getUserTextsPage($cc = 5) {
		$results = DB::table($this->_table_name)->where('user_id', Auth::user()->id)->paginate($cc);
		return $results; 
	}
	
	
	public function getText($_link = '') {
		if ($_link != '') {
			if (!empty(Auth::user()->id) ) {
				$user_id = Auth::user()->id;
			} else {
				$user_id = 0;
			}
			$results = DB::select('SELECT * 
					               FROM ' . $this->_table_name . ' 
					               WHERE link = "pasta' . $_link . '" 
					               AND dtexp >= NOW()
								   AND (access<>"private" OR user_id="' . $user_id . '")');

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
		
		$dt = new DateTime('now');
		
		$insert['link']   = 'pasta' . dechex(strtotime($dt->format('Y-m-d H:i:s') ) );
		$insert['title']  = $this->getClearText($request->title);
		$insert['body']   = $this->getClearText($request->body);
		$insert['dtadd']  = $dt->format('Y-m-d H:i:s');
		//добавляем к текущей дате выбранный интервал, чтобы получить дату, до которой показывать
		$dt->add(new DateInterval($request->exp) );
		$insert['dtexp']  = $dt->format('Y-m-d H:i:s');
		$insert['access'] = $request->accesstext;
		$insert['lang']   = $request->lang;
		
		if (!empty(Auth::user()->id) ) {
			$insert['user_id'] = Auth::user()->id; 
		} else {
			$insert['user_id'] = 0;
		}
		
		DB::table($this->_table_name)->insert($insert);
		
		return $insert['link'];
	}
}
