AlertManager
============

Laravel 4 package that uses bootstrapGrowl to easily generate alerts from controllers.
###Usage:

Add to app.php
```
'providers' => array(
    'Webcode\AlertManager\AlertManagerServiceProvider'
);
```

Create alert
```
\Webcode\AlertManager\AM::setSuccess("GREAT SUCCESS!");
```

Add right before closing body tag
```
<?=\Webcode\AlertManager\AM::getAlerts();?>
```