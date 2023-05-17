<?php

namespace LivewireBootstrapModal;

use Exception;
use Livewire\Component;
use ReflectionClass;

class Modal extends Component
{
    public ?string $activeComponent = null;

    public array $components = [];

    public function resetState(): void
    {
        $this->components      = [];
        $this->activeComponent = null;
    }

    public function openModal($component, $componentAttributes = [], $modalAttributes = []): void
    {
        $requiredInterface = \LivewireBootstrapModal\Contracts\ModalComponent::class;
        $componentClass    = app('livewire')->getClass($component);
        $reflect           = new ReflectionClass($componentClass);

        if ($reflect->implementsInterface($requiredInterface) === false) {
            throw new Exception("[{$componentClass}] does not implement [{$requiredInterface}] interface.");
        }

        $id                     = md5($component . serialize($componentAttributes));
        $this->components[$id]  = [
            'name'              => $component,
            'attributes'        => $componentAttributes,
            'modalAttributes'   => array_merge([
                'closeOnClickAway'          => $componentClass::closeModalOnClickAway(),
                'closeOnEscape'             => $componentClass::closeModalOnEscape(),
                'closeOnEscapeIsForceful'   => $componentClass::closeModalOnEscapeIsForceful(),
                'dispatchCloseEvent'        => $componentClass::dispatchCloseEvent(),
                'modalTitle'                => $componentClass::modalTitle(),
                'modalClasses'              => $componentClass::modalClasses(),
                'framework'                 => 'bootstrap',
            ], $modalAttributes),
        ];

        $this->activeComponent = $id;
        $this->emit('activeModalComponentChanged', $id);
    }

    public function destroyComponent($id): void
    {
        unset($this->components[$id]);
    }

    public function getListeners(): array
    {
        return [
            'openModal',
            'destroyComponent'
        ];
    }

    public function render()
    {
        return view('livewire-bootstrap-modal::bootstrap');
    }
}
