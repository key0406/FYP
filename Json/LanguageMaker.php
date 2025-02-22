<?php
require_once '../vendor/autoload.php';
use Stichoza\GoogleTranslate\GoogleTranslate;
$tr = new GoogleTranslate();
$langlist = ['en','ja','fr','es','pt-BR','zh-CN','zh-TW','ko','id','th','hi','vi','tl','ru','ar'];
foreach($langlist as $lang){
  $tr->setSource('en');
  $tr->setTarget($lang); 
  $path = "../lang_result/en.json";
  $json = fopen($path, "r");
  $filesize = filesize($path);
  $tls = json_decode(fread($json, $filesize));
  $tls2 = [];  
  foreach ($tls as $key => $val) {
    $tls2[$key] = $tr -> translate($val);
  }
  $tls2_json = json_encode($tls2, JSON_UNESCAPED_UNICODE);
  echo $tls2_json;
$newfile = fopen('../lang_result/'.$lang.'.json', 'w');
$check = fwrite($newfile, $tls2_json);
    fclose($newfile);
}

?>