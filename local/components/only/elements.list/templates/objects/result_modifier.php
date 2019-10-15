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
        'IBLOCK_ID' => \Only\Site\Helpers\IBlock::getIblockID('OBJECTS', 'OBJECTS'),
        'ACTIVE' => 'Y'
    ],
    false,
    false,
    ['ID', 'PROPERTY_YEAR', 'PROPERTY_WORK_TYPE', 'PROPERTY_SOLUTIONS', 'PROPERTY_BRANCH']
);
$arFiltersWork = array();
$arFiltersBranch = array();
$arFiltersSolutions = array();

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
        foreach ($arProperties['PROPERTY_BRANCH_VALUE'] as $sXmlIdBranch)
        if (!in_array($sXmlIdBranch, $arFiltersBranch)){
            $arFiltersBranch[] = $sXmlIdBranch;
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
 * Выбераем из HL блока решения
 */

$arFilter = array('UF_XML_ID' => $arFiltersSolutions); //задаете фильтр по выбраным странам
$rsData = \Only\Site\Helpers\HLBlock::getList(
    array('*'),
    $arFilter,
    array("UF_SORT" => "ASC"),
    'SolutionsFilter'
);

while ($arRes = $rsData->Fetch()) {
    $arCountry[$arRes['UF_XML_ID']] = $arRes;
    $arFilters['SOLUTIONS'][$arRes['UF_XML_ID']] = $arRes['UF_NAME'];
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


/*
 * Выебнуться, и убрать пустые блоки в выдаче. Вот задача нижеизложенного кода.
 * Комемнтарии оставлю, но не пытайтесь его понять.
 *
 */

//количество показанных элементов до этой страницы
if ($arResult['NAV_DATA']['NavPageNomer']>1){
    $iTopCount = ($arResult['NAV_DATA']['NavPageNomer']*$arResult['NAV_DATA']['NavPageSize'])-$arResult['NAV_DATA']['NavPageSize'];

    $arFilter = [
        'IBLOCK_ID' => \Only\Site\Helpers\IBlock::getIblockID('OBJECTS', 'OBJECTS'),
        'ACTIVE' => 'Y'
    ];
    $arFilter = array_merge($arFilter, $arParams['FILTER']);
    $rsObjectsAll = CIBlockElement::GetList(
        [
            "PROPERTY_YEAR"=>"DESC",
            "SORT"=>"ASC"
        ],
            $arFilter
        ,
        false,
        ['nTopCount' => $iTopCount],
        ['ID', 'PROPERTY_FULL_WIDTH']
    );
    $iFullWidthCount = 0;
    $iSmallCount =0;
    while ($arObjectsAll = $rsObjectsAll->GetNextElement()){
        $arProp = $arObjectsAll->GetFields();
        if ($arProp['PROPERTY_FULL_WIDTH_VALUE'] == 'Да'){
            $iFullWidthCount++;
        }else{

            $iSmallCount++;
        }

    }

   $arResult['COUNT'] = intval($iSmallCount);
}
//проверяем закончина, ли предыдущая строка
if ($arResult['COUNT'] % 2 === 0){
    $i=0;
}else{
    $i=1;
}

$iKey =0;
$elBuffer = array();
$arNewResult = array();
//скидываем индексы (сейчас $iKey = ELEMENT_ID)
$arResult['ITEMS'] = array_values($arResult['ITEMS']);
//Обходим массив
while (count($arResult['ITEMS'])>0){
    //если блок обычный (Не широкий)
    if ($arResult['ITEMS'][$iKey]['PROPERTIES']['FULL_WIDTH']['VALUE_XML_ID'] != 'Y') {
        $arNewResult[] = $arResult['ITEMS'][$iKey];
        unset($arResult['ITEMS'][$iKey]);
        $i++;
        if ($i==2){
            $i=0;
        }
        //если есть широкие блоки в буфере, то выводим их если предыдущая строка заполнена
        if (($i == 0 ) && (!empty($elBuffer))){
            foreach ($elBuffer as $arElement){
                $arNewResult[]  = $arElement;
            }
            unset($elBuffer);
            $i = 0;
        }
        //если попадается широкий блок, проверяем можно ли его вывести сейчас или пока убрать в буфер
    }else{
        if ($i == 1){
            $elBuffer[] = $arResult['ITEMS'][$iKey];
            unset($arResult['ITEMS'][$iKey]);

        }else{
            $arNewResult[] = $arResult['ITEMS'][$iKey];
            unset($arResult['ITEMS'][$iKey]);
        }
    }
    $iKey++;
}

// если в буфере осталить элементы то не забываем их вывести
if (!empty($elBuffer)){
    if ($i == 0){
        //если последняя строка закончена, то выводим в конце блока
        foreach ($elBuffer as $arElement){
            $arNewResult[]  = $arElement;
        }
    }else{
        //если нет, то выводим перед последним элементов.
        foreach ($elBuffer as $arElement){
            $newArray[] = $arElement;
        }
        $newArray[] = $arNewResult[count($arNewResult)-1];
        unset($arNewResult[count($arNewResult)-1]);
        $arNewResult = array_merge($arNewResult, $newArray);
    }
}

$arResult['ITEMS'] = $arNewResult;

