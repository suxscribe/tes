<?
global $APPLICATION;
$APPLICATION->SetPageProperty('TES_MAIL', $arResult['PROPERTIES']['EMAIL']['VALUE']);
$APPLICATION->SetPageProperty('TES_MAIL', $arResult['PROPERTIES']['EMAIL']['VALUE']);
$APPLICATION->SetPageProperty('TES_YOUTUBE', trim($arResult['PROPERTIES']['YOUTUBE']['VALUE']));
$APPLICATION->SetPageProperty('TES_PHONE_PRINT', $arResult['PROPERTIES']['PHONE']['VALUE']);
$APPLICATION->SetPageProperty('TES_PHONE_VALUE', substr(preg_replace('~[^\+0-9]+~','',$arResult['PROPERTIES']['PHONE']['VALUE']),0,12));

