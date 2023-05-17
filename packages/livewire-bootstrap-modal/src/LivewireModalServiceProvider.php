<?php

namespace LivewireBootstrapModal;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class LivewireModalServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->registerViews();

        $this->registerPublishables();

        $this->registerComponent();

        $this->registerConfig();
    }

    private function registerViews(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'livewire-bootstrap-modal');
    }

    private function registerComponent(): void
    {
        Livewire::component('livewire-bootstrap-modal', Modal::class);
    }

    private function registerPublishables(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/livewire-bootstrap-modal'),
            ], 'livewire-bootstrap-modal:views');

            $this->publishes([
                __DIR__ . '/../resources/js' => public_path('vendor/livewire-bootstrap-modal'),
            ], 'livewire-bootstrap-modal:scripts');
        }
    }

    public function register()
    {
        // $this->mergeConfigFrom(
        //     __DIR__ . '/../resources/config/livewire-bootstrap-modal.php',
        //     'livewire-bootstrap-modal'
        // );

        // $file = __DIR__ . '/functions.php';
        // if (file_exists($file)) {
        //     require_once($file);
        // }
    }

    private function registerConfig()
    {
        // $this->publishes([
        //     __DIR__ . '/../resources/config/livewire-bootstrap-modal.php' => config_path('livewire-bootstrap-modal.php'),
        // ], 'livewire-bootstrap-modal:config');
    }
}
