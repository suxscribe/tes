<?
$module_id = "only.form";
$RIGHT = $APPLICATION->GetGroupRight($module_id);

$arAllOptions = array(
    array("iblock_id", 'Инфоблоки для рассылки', array("text", 30), ' ID инфоблоков через запятую'),
    array("hlBlockName", 'Имя HighLoad блока для хранения e-mail пользователей', array("text", 30), ' Имя HighLoad блока'),
    array("mail_template_id", 'ID почтового шаблона', array("text", 30), ' ID почтового шаблона'),
    array("event_name", 'Имя почтового события', array("text", 30), ' Имя почтового события'),
);

$aTabs = array(
    array("DIV" => "edit1", "TAB" => GetMessage("MAIN_TAB_SET"), "ICON" => "perfmon_settings", "TITLE" => GetMessage("MAIN_TAB_TITLE_SET")),
);
$tabControl = new CAdminTabControl("tabControl", $aTabs);

CModule::IncludeModule($module_id);

if ($REQUEST_METHOD == "POST" && check_bitrix_sessid()) {
    foreach ($arAllOptions as $option) {
        if (isset($_REQUEST[$option[0]]))
            \Bitrix\Main\Config\Option::set($module_id, $option[0], $_REQUEST[$option[0]]);
    }
}

?>
<form method="post"
      action="<? echo $APPLICATION->GetCurPage() ?>?mid=<?= urlencode($module_id) ?>&amp;lang=<?= LANGUAGE_ID ?>">
    <?
    $tabControl->Begin();
    $tabControl->BeginNextTab();
    $arNotes = array();
    foreach ($arAllOptions as $arOption):
        $val = COption::GetOptionString($module_id, $arOption[0]);
        $type = $arOption[2];
        if (isset($arOption[3]))
            $arNotes[] = $arOption[3];
        ?>
        <tr>
            <td width="40%" nowrap <? if ($type[0] == "textarea")
                echo 'class="adm-detail-valign-top"' ?>>
                <? if (isset($arOption[3])): ?>
                    <span class="required"><sup><? echo count($arNotes) ?></sup></span>
                <? endif; ?>
                <label for="<? echo htmlspecialcharsbx($arOption[0]) ?>"><? echo $arOption[1] ?>
                    :</label>
            <td width="60%">
                <? if ($type[0] == "checkbox"): ?>
                    <input
                            type="checkbox"
                            name="<? echo htmlspecialcharsbx($arOption[0]) ?>"
                            id="<? echo htmlspecialcharsbx($arOption[0]) ?>"
                            value="Y"<? if ($val == "Y") echo " checked"; ?>>
                <? elseif ($type[0] == "text"): ?>
                    <input
                            type="text"
                            size="<? echo $type[1] ?>"
                            maxlength="255"
                            value="<? echo htmlspecialcharsbx($val) ?>"
                            name="<? echo htmlspecialcharsbx($arOption[0]) ?>"
                            id="<? echo htmlspecialcharsbx($arOption[0]) ?>">
                    <? if ($arOption[0] == "slow_sql_time")
                        echo GetMessage("PERFMON_OPTIONS_SLOW_SQL_TIME_SEC") ?>
                    <? if ($arOption[0] == "large_cache_size")
                        echo GetMessage("PERFMON_OPTIONS_LARGE_CACHE_SIZE_KB") ?>
                <?
                elseif ($type[0] == "textarea"): ?>
                    <textarea
                            rows="<? echo $type[1] ?>"
                            cols="<? echo $type[2] ?>"
                            name="<? echo htmlspecialcharsbx($arOption[0]) ?>"
                            id="<? echo htmlspecialcharsbx($arOption[0]) ?>"
                    ><? echo htmlspecialcharsbx($val) ?></textarea>
                <? endif ?>
            </td>
        </tr>
    <? endforeach ?>

    <? $tabControl->BeginNextTab(); ?>

    <? $tabControl->Buttons(); ?>
    <input type="submit" name="Update" value="<?= GetMessage("MAIN_SAVE") ?>"
           title="<?= GetMessage("MAIN_OPT_SAVE_TITLE") ?>" class="adm-btn-save">

    <?= bitrix_sessid_post(); ?>
    <? $tabControl->End(); ?>
</form>
<?
if (!empty($arNotes)) {
    echo BeginNote();
    foreach ($arNotes as $i => $str) {
        ?><span class="required"><sup><? echo $i + 1 ?></sup></span><? echo $str ?><br><?
    }
    echo EndNote();
}
?>

