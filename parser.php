<?php

require_once 'config.php';
require_once 'libs/simple_html_dom.php';

$url = "https://yandex.ru/pogoda/saint-petersburg";
$html = file_get_html($url);
$fact = $html->find('div.fact')[0];
$fact_temp = $fact->find('div.fact__temp')[0]->find('span.temp__value')[0]->innertext;
$fact_temp = str_replace('−', '-', $fact_temp);
$fact_temp = intval($fact_temp);
$term_temp = $fact->find('.term__value')[0]->find('.temp')[0]->find('span.temp__value')[0]->innertext;
$term_temp = str_replace('−', '-', $term_temp);
$term_temp = intval($term_temp);
$fact_props = $fact->find('.fact__props')[0];
$wind = $fact_props->find('.wind-speed')[0]->innertext;
$wind = str_replace(',', '.', $wind);
$pressure = explode(' ',$fact_props->find('.fact__pressure')[0]->find('.term__value')[0]->innertext)[0];
$humidity = $fact_props->find('.fact__humidity')[0]->find('.term__value')[0]->innertext;
$humidity = str_replace('%', '', $humidity);

$db = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
mysqli_query($db, "INSERT INTO `{$dbname}`.`forecast` (`date`, `temperature`, `temperature_feels`, `humidity`, `wind`, `pressure`) VALUES (DATE_FORMAT(NOW(), '%Y-%m-%d %H:%i'), {$fact_temp}, {$term_temp}, {$humidity}, {$wind}, {$pressure})");

echo 'done!';