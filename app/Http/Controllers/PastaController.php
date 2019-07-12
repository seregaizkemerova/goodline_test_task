<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Pasta;
use Illuminate\Http\Request;
use DateTime;


class PastaController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    private $_pasta;
    
    public function __construct() {
    	$this->_pasta = new Pasta();
    }
    
    
    public function index() {
    	return view('index', [
    			'pasta_res'       => $this->_pasta->getLastTexts(),
    			'pasta_users_res' => $this->_pasta->getUserTexts(),
    			]);
    }
    
    
    public function addText(Request $request) {
    	
    	$link = $this->_pasta->addText($request);
    	 
    	return redirect('/' . $link);
    }
    
    
    public function getText($link = '') {
    	
    	$text = $this->_pasta->getText($link);
    	
    	if (!$text) {
    		return view('text', [
    				'notext' => 1,
    				'pasta_res' => false,
    				]);
    	} else {
    		
    		$lasttexts = $this->_pasta->getLastTexts($text->id);
    		
    		$text->dtadd = date_format(new DateTime($text->dtadd), "d.m.Y H:i:s");
    		
    		$dtexp = new DateTime($text->dtexp);
    		if (date_format($dtexp, "Y") > 3000) {
    			$dtexp = 'без ограничения';
    		} else {
    			$dtexp = date_format($dtexp, "d.m.Y H:i:s");
    		}
    		$text->dtexp = $dtexp;
    		
    		if ($text->access == 'public') {
    			$text->access = 'доступен всем, виден в списках';
    		} elseif($text->access == 'private') {
    			$text->access = 'ТОЛЬКО АВТОРУ';
    		} else {
    			$text->access = 'доступен только по ссылке';
    		}
    		
    		$text->body = stripslashes($text->body);
    		
	    	return view('text', [
	    			'text' => $text,
	    			'pasta_res'       => $this->_pasta->getLastTexts($text->id),
	    			'pasta_users_res' => $this->_pasta->getUserTexts(),
	    			]);
    	}
    }
}

?>