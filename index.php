<?php
require ("config.php");
require ("simple_html_dom.php");
$url = "http://finans.mynet.com/doviz/";
$tags = "table[class=fnNewDataTable ndt-Gray ndt-BorderGray ndt-MediumPadding] tbody tr[class=dtLight] td";
function scrape($url, $tags){
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,FALSE);
  curl_setopt($curl, CURLOPT_FOLLOWLOCATION,true);
  curl_setopt($curl, CURLOPT_HEADER,false);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER,TRUE);
  curl_setopt($curl, CURLOPT_URL,$url);
  curl_setopt($curl, CURLOPT_REFERER,$url);
  $str = curl_exec($curl);
  $html_base = new simple_html_dom();
  $html_base->load($str);
  $counter = 0;
  foreach($html_base->find($tags) as $element){
       $values = $element->plaintext;
       $total[$counter] = $values;
       #echo "<pre>";
       #echo $values;
       #echo "</pre>";
       $counter = $counter + 1;

  }
return $total;

}

$total = scrape($url,$tags);
$sql = "INSERT INTO veri(name, alis, satis) VALUES ('dolar','$total[1]','$total[2]')";
$result = mysqli_query($conn, $sql);
#$sql = "SELECT * FROM veri WHERE 1";
?>
