<?
/*
 * Собираем фильтры
 */

$arFilters = array();
$arProperties = array();
$rsObjects = CIBlockElement::GetList(
    [
        "SORT"=>"ASC"
    ],
    [
        'IBLOCK_ID' => \Only\Site\Helpers\IBlock::getIblockID('REVIEWS', 'TRUST'),
    ],
    false,
    false,
    ['ID', 'PROPERTY_YEAR', 'PROPERTY_WORK_TYPE', 'PROPERTY_SOLUTIONS', 'PROPERTY_BRANCH']
);
$arFiltersWork = array();
$arFiltersSolutions = array();
$arFiltersBranch = array();
while($arProperties = $rsObjects->GetNextElement()){
    $arFields = $arProperties->GetFields();
    $arProps = $arProperties->GetProperties();
    $arProperties = array_merge($arFields, $arProps);
    /*
     * Собирает Нужные ID
     */
    if (!empty($arProperties['PROPERTY_WORK_TYPE_VALUE'])){
        foreach ($arProperties['PROPERTY_WORK_TYPE_VALUE'] as $iWork){
            if (!in_array($iWork, $arFiltersWork)){
                $arFiltersWork[] = $iWork;
            }
        }
    }
    if (!empty($arProperties['PROPERTY_SOLUTIONS_VALUE'])){
        foreach ($arProperties['PROPERTY_SOLUTIONS_VALUE'] as $xmlSolutions){
            if (!in_array($xmlSolutions, $arFiltersSolutions)){
                $arFiltersSolutions[] = $xmlSolutions;
            }
        }
    }
    if (!empty($arProperties['PROPERTY_BRANCH_VALUE'])){
        if (!in_array($arProperties['PROPERTY_BRANCH_VALUE'], $arFiltersBranch)){
            $arFiltersBranch[] = $arProperties['PROPERTY_BRANCH_VALUE'];
        }
    }
    if (!empty($arProperties['PROPERTY_YEAR_VALUE'])){
        if (!in_array($arProperties['PROPERTY_YEAR_VALUE'], $arFilters['YEARS'])){
            $arFilters['YEARS'][] = $arProperties['PROPERTY_YEAR_VALUE'];
        }
    }
}
/*
 * Выбираем услуги
 */
$rsWorks = CIBlockElement::GetList(
    [
        "SORT"=>"ASC"
    ],
    [
        'IBLOCK_ID' => \Only\Site\Helpers\IBlock::getIblockID('SERVICES', 'SERVICES'),
        'ID' => $arFiltersWork

    ],
    false,
    false,
    ['ID', 'NAME']
);
while($arServices= $rsWorks->GetNextElement()){
    $arFieldsServices = $arServices->GetFields();
    $arFilters['WORK_TYPES'][$arFieldsServices['ID']] = $arFieldsServices['NAME'];

}


/*
 * Выбераем из HL блока филиалы
 */

$arFilterBranch = array('UF_XML_ID' => $arFiltersBranch); //задаете фильтр по выбраным странам
$rsDataBranch = \Only\Site\Helpers\HLBlock::getList(
    array('*'),
    $arFilterBranch,
    array("UF_SORT" => "ASC"),
    'BranchFilter'
);
while ($arResBranch = $rsDataBranch->Fetch()) {
    // $arCountry[$arResBranch['UF_XML_ID']] = $arResBranch;
    $arFilters['BRANCH'][$arResBranch['UF_XML_ID']] = $arResBranch['UF_NAME'];
}
asort($arFilters['YEARS']);
$arResult['FILTERS'] = $arFilters;

?>
