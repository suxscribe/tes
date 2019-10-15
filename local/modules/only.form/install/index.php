<?php

class only_form extends CModule{

    const MODULE_ID = 'only.form';

    var $MODULE_ID = 'only.form',
        $MODULE_VERSION,
        $MODULE_VERSION_DATE,
        $MODULE_NAME = 'Модуль форм',
        $PARTNER_NAME = 'Only.Digital',
        $PARTNER_URI = 'http://only.com.ru';
    function only_form()
    {
        $arModuleVersion = array();
        include(__DIR__ . "/version.php");

        $this->MODULE_VERSION = $arModuleVersion['VERSION'];
        $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
    }
    public function DoInstall()
    {
        $this->installAgent();
        $this->InstallFiles();
        RegisterModule($this->MODULE_ID);
    }
    public function DoUninstall()
    {
        UnRegisterModule($this->MODULE_ID);

        //$this->UnInstallFiles();
    }
    function InstallFiles()
    {
        CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/local/modules/only.form/components/", $_SERVER["DOCUMENT_ROOT"]."/local/components/only/", true, true);

        return true;
    }
    function installAgent(){
        \CAgent::AddAgent(
            "\Only\Form\Subscribe::doMailing();",
            $this->MODULE_ID,
            "N",
            86400, // 1 раз в сутки
            date('d.m.Y H:i:s',time()+86400),
            "Y",
            date('d.m.Y H:i:s',time()+86400),
            100
        );
    }
}
?>
