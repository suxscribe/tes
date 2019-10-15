<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?$APPLICATION->IncludeComponent(
    "only:elements",
    "objects",
    Array(
        "IBLOCK_ID" => \Only\Site\Helpers\IBlock::getIblockID('OBJECTS','OBJECTS'),
        "SEF_FOLDER" => "/objects/",
        "SEF_MODE" => "Y",
        "SEF_URL_TEMPLATES" => [
            'main'=>'',
            'detail'=>'#ELEMENT_CODE#/'
        ],
    )
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
