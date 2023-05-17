<?php

namespace LivewireBootstrapModal;

use InvalidArgumentException;
use Livewire\Component;
use LivewireBootstrapModal\Contracts\ModalComponent as Contract;

abstract class ModalComponent extends Component implements Contract
{
    public bool $forceClose = false;
    public int $skipModals = 0;
    public bool $destroySkipped = false;

    public static function modalTitle(): string
    {
        return '';
    }

    public static function modalClasses(): string
    {
        return '';
    }

    public function destroySkippedModals(): self
    {
        $this->destroySkipped = true;
        return $this;
    }

    public function skipPreviousModals($count = 1, $destroy = false): self
    {
        $this->skipPreviousModal($count, $destroy);
        return $this;
    }

    public function skipPreviousModal($count = 1, $destroy = false): self
    {
        $this->skipModals = $count;
        $this->destroySkipped = $destroy;
        return $this;
    }

    public function forceClose(): self
    {
        $this->forceClose = true;
        return $this;
    }

    public function closeModal(): void
    {
        $this->emit('closeModal', $this->forceClose, $this->skipModals, $this->destroySkipped);
    }

    public function closeModalWithEvents(array $events): void
    {
        $this->emitModalEvents($events);
        $this->closeModal();
    }

    public static function modalFramework(): string
    {
        return 'bootstrap';
    }

    public static function closeModalOnClickAway(): bool
    {
        return false;
    }

    public static function closeModalOnEscape(): bool
    {
        return false;
    }

    public static function closeModalOnEscapeIsForceful(): bool
    {
        return true;
    }

    public static function dispatchCloseEvent(): bool
    {
        return true;
    }

    public static function destroyOnClose(): bool
    {
        return false;
    }

    private function emitModalEvents(array $events): void
    {
        foreach ($events as $component => $event) {
            if (is_array($event)) {
                [$event, $params] = $event;
            }

            if (is_numeric($component)) {
                $this->emit($event, ...$params ?? []);
            } else {
                $this->emitTo($component, $event, ...$params ?? []);
            }
        }
    }
}
