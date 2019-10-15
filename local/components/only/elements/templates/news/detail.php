<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$APPLICATION->SetPageProperty('BARBA_NAMESPASE', 'newsCard');
?>

<?$iElementID = $APPLICATION->IncludeComponent(
    'only:elements.detail',
    'news',
    [
        'IBLOCK_ID' => $arParams['IBLOCK_ID'],
        'ELEMENT_CODE' => $arResult['VARIABLES']['ELEMENT_CODE']
    ],
    $component
);
?>
