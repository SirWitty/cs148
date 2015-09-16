<?php 
function countify($code){
		$code = strtoupper($code);
		$counts = array('where'=>0,'condition'=>0,'quote'=>0,'symbol'=>0);
		$counts['where'] = substr_count($code,'WHERE'); //counting all values bob's code requires (since we already case forced). Kinda cheating his system actually, but otherwise can't do robust dynamic queries.
		$conditions = [' AND ', ' OR ', ' XOR ', ' NOT ', ' && ', ' || ', ' ! '];
		$counts['condition'] = 0;
		foreach($conditions as $condition){$counts['condition'] += substr_count($code,$condition);} //substr_count doesn't accept arrays... boo
		$quotes = ['"', "'", '#34', '#39', '&QUOT'];
		$counts['quote'] = 0;
		foreach($quotes as $quote){$counts['quote'] += substr_count($code,$quote);} 
		$counts['symbol'] = substr_count($code,'<') +  substr_count($code,'>');
		return $counts; 
}
?>
