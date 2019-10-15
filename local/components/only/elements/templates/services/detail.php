<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?$iElementID = $APPLICATION->IncludeComponent(
    'only:elements.detail',
    'services',
    [
        'IBLOCK_ID' => \Only\Site\Helpers\IBlock::getIblockID('SERVICES','SERVICES'),
        'ELEMENT_CODE' => $arResult['VARIABLES']['ELEMENT_CODE']
    ],
    $component
);
?>
