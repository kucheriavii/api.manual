<?php
function _is_curl_installed() {
    if  (in_array  ('curl', get_loaded_extensions())) {
        return true;
    }
    else {
        return false;
    }
}
function getKurs() {
  
    if ( _is_curl_installed() ){
        $url = "https://api.privatbank.ua/p24api/pubinfo?exchange&coursid=5";
        $curl = curl_init($url);
        if ( $curl ){
            // Скачанные данные не выводить поток
            curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
            // Скачиваем
            $page = curl_exec($curl);   //В переменную $page помещается страница
 
            curl_close($curl);
            unset($curl);
 
            $xml = new SimpleXMLElement($page);
            return $xml->row[2]->exchangerate['sale'];
        }
    }
}




$summa = '1$';
$kursUAH = (float)getKurs();
if ($kursUAH > 0){
        // если курс пришёл
       echo $summa . ' = <span title="по курсу Приватбанка">' . (int)$summa * $kursUAH . '</span> грн. **';
      } else {
        echo $summa;
      }
?>

<br>

<?php 
	$n_url = "https://api.privatbank.ua/p24api/pubinfo?exchange&coursid=5";
	$curl2 = curl_init($n_url);
	 curl_setopt($curl2,CURLOPT_RETURNTRANSFER,true);
	$page2 = curl_exec($curl2);
	curl_close($curl2);
	unset($curl2);

	$xml2 = new SimpleXMLElement($page2);
	print_r($xml2); 
 ?>