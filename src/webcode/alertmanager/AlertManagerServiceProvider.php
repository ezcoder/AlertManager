<?php

namespace Webcode\AlertManager;

use Illuminate\Support\ServiceProvider;

class AlertManagerServiceProvider extends ServiceProvider {

    protected $defer = false;

    public function boot() {
        $this->package('webcode/alertmanager');
    }

    public function register() {
        
    }

    public function provides() {
        return array();
    }

}
