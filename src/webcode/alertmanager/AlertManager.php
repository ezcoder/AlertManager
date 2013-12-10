<?php

namespace Webcode\AlertManager;

use \Session;
use \Config;

class AM {

    public static function setInfo($msg, $title = "Information:") {
        self::_setAlert('info', $msg, $title);
    }

    public static function setSuccess($msg, $title = "Success:") {
        self::_setAlert('success', $msg, $title);
    }

    public static function setWarning($msg, $title = "Warning:") {
        self::_setAlert('warning', $msg, $title);
    }

    public static function setDanger($msg, $title = "Error:") {
        self::_setAlert('danger', $msg, $title);
    }

    private static function _setAlert($class, $msg, $title) {
        $offset = Config::get('alertmanager::offset');
        $align = Config::get('alertmanager::align');
        $width = Config::get('alertmanager::width');
        $delay = Config::get('alertmanager::delay');
        $allowDismiss = Config::get('alertmanager::allowDismiss');
        $stackupSpacing = Config::get('alertmanager::stackupSpacing');
        $newAlert = "$.bootstrapGrowl('<strong>" . $title . ":</strong> " . $msg . "', {
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
        $currentAlerts = "<!-- AlertManager --><script>" . $currentAlerts . $newAlert . "</script><!-- /AlertManager -->";
        Session::flash('Webcode-AM-Alerts', $currentAlerts);
    }

}
