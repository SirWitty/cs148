<?php //This'll be fun... fixing lowercase sql reserved words and putting them into spans + keeping conditional for future simple code parsing. 
function prettify($code, $type = 'sql') {
	$replaceList = [];
	$prettyCode = $code;
	if(strcmp('sql', $type)===0){	
		$replaceList = ['select ', ' as ', ' from ', ' where ', ' like ', ' and ', ' lower(', ' count(', ' distinct ', ' group ', ' order ', ' by', ' sum(', 'having', ')', ';'];
		$upperReplace = array_map('strtoupper',$replaceList);
		$prettyCode = str_replace($replaceList, $upperReplace, $prettyCode); //replace lowercase with uppers
		$replaceList = $upperReplace;
	}
	
	$colorReplace = array_map('colorWord', $replaceList); 
	$prettyCode = str_replace($upperReplace, $colorReplace, $prettyCode); //wrap reserved in span
	return $prettyCode;
}
function colorWord($word){
	$word .= (strcmp($word,rtrim($word)))?'</span> ':'</span>'; //need to do the same for ltrim to ensure correct parsing
	return '<span class="sql-reserved">'.$word;
}
?>
