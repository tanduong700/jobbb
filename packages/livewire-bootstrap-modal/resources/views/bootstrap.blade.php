<div
    x-data="LivewireBootstrapModal()"
    x-on:close.stop="setShowPropertyTo(false)"
    x-on:keydown.escape.window="closeModalOnEscape()"
    x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
    x-on:keydown.shift.tab.prevent="prevFocusable().focus()"
>
    @forelse($components as $id => $component)
        <div x-data="{ modalId: '#{{ $id }}' }" id="{{ $id }}" x-ref="{{ $id }}" wire:key="{{ $id }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered" x-bind:class="modalClasses" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" x-text="modalTitle"></h3>
                        <span x-on:click="closeModal()" style="cursor: pointer" class="text-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                            </svg>
                        </span>
                    </div>
                    @livewire($component['name'], $component['attributes'], key($id))
                </div>
            </div>
        </div>
    @empty
    @endforelse
</div>
