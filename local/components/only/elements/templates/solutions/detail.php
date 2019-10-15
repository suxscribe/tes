<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$iElementID = $APPLICATION->IncludeComponent(
    'only:elements.detail',
    'solutions',
    [
        'IBLOCK_ID' => \Only\Site\Helpers\IBlock::getIblockID('SOLUTIONS','SOLUTIONS'),
        'ELEMENT_CODE' => $arResult['VARIABLES']['ELEMENT_CODE'],
    ],
    $component
);
?>
