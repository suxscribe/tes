<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var CBitrixComponent $component */
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
?>
<?
/*
 * В этом темплейте выводиться только копирайт, остальные переменные передаются в pageProperty для вывода в шапке и т.п.
 */
?>
<?=$arResult['PROPERTIES']['COPYRIGHT']['VALUE']?>


