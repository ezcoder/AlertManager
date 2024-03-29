<?php

namespace Webcode\AlertManager;

use \Session;
use \Config;

class AlertManager {

    public static function setInfo($msg, $title = "Information") {
        self::_setAlert('info', $msg, $title);
    }

    public static function setSuccess($msg, $title = "Success") {
        self::_setAlert('success', $msg, $title);
    }

    public static function setWarning($msg, $title = "Warning") {
        self::_setAlert('warning', $msg, $title);
    }

    public static function setDanger($msg, $title = "Error") {
        self::_setAlert('danger', $msg, $title);
    }

    public static function getAlerts() {
        $alerts = Session::get('Webcode-AM-Alerts');
        Session::set('Webcode-AM-Alerts', NULL);
        /*
        $alerts = '<script src="' .
                Config::get('alertmanager::growlJS') . 
                '"></script>' . PHP_EOL . 
                $alerts;
         * *
         */
        return "<script>" . PHP_EOL .
                file_get_contents(__DIR__ . '/bootstrapGrowl.js') . PHP_EOL .
                "</script>" . PHP_EOL . 
                $alerts;
    }

    private static function _setAlert($class, $msg, $title) {
        $offset = Config::get('alertmanager::offset');
        $align = (string)'"'.Config::get('alertmanager::align').'"';
        $width = (int)Config::get('alertmanager::width');
        $delay = (int)Config::get('alertmanager::delay');
        $allowDismiss = (Config::get('alertmanager::allowDismiss'))?"true":"false";
        $stackupSpacing = (int)Config::get('alertmanager::stackupSpacing');
        $newAlert = "$.bootstrapGrowl('<strong>" . 
                $title . ":</strong> " . $msg . "', {
                        type: '" . $class . "',
                        offset: " . $offset . ",
                        align: " . $align . ",
                        width: " . $width . ",
                        delay: " . $delay . ",
                        allow_dismiss: " . $allowDismiss . ",
                        stackup_spacing: " . $stackupSpacing . "
                    });";
        $currentAlerts = Session::get('Webcode-AM-Alerts');
        $currentAlerts = str_replace("<!-- AlertManager --><script>", NULL, $currentAlerts);
        $currentAlerts = str_replace("</script><!-- /AlertManager -->", NULL, $currentAlerts);
        $currentAlerts = "<!-- AlertManager --><script>" . PHP_EOL .
                $currentAlerts . 
                $newAlert . 
                PHP_EOL . 
                "</script><!-- /AlertManager -->" .PHP_EOL;
        Session::set('Webcode-AM-Alerts', $currentAlerts);
    }

}
