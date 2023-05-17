window.LivewireBootstrapModal = () => {
    return {
        show: false,
        showActiveComponent: true,
        activeComponent: false,
        componentHistory: [],
        modalClasses: '',
        modalTitle: '',
        isBootstrapFramework() {
            return this.getActiveComponentModalAttribute('framework') === 'bootstrap';
        },
        getActiveComponentModalAttribute(key) {
            if (this.$wire.get('components')[this.activeComponent] !== undefined) {
                return this.$wire.get('components')[this.activeComponent]['modalAttributes'][key];
            }
        },
        closeModalOnEscape(trigger) {
            if (this.getActiveComponentModalAttribute('closeOnEscape') === false) {
                return;
            }
            let force = this.getActiveComponentModalAttribute('closeOnEscapeIsForceful') === true;
            this.closeModal(force);
        },
        closeModalOnClickAway(trigger) {
            if (this.getActiveComponentModalAttribute('closeOnClickAway') === false) {
                return;
            }
            this.closeModal(true);
        },
        closeModal(force = false, skipPreviousModals = 0, destroySkipped = false) {
            if (this.show === false) {
                return;
            }
            const name = this.$wire.get('components')[this.activeComponent].name;
            // console.log('%ccloseModal ' + name, 'color: #f0c');
            if (this.isBootstrapFramework()) {
                this.toggleBootstrapModal(this.activeComponent);
            }
            if (this.getActiveComponentModalAttribute('dispatchCloseEvent') === true) {
                Livewire.emit('modalClosed', name);
            }
            if (this.getActiveComponentModalAttribute('destroyOnClose') === true) {
                Livewire.emit('destroyComponent', this.activeComponent);
            }

            if (force) {
                console.log('forceCloseModal');
                this.forceCloseModal();
            } else {
                if (skipPreviousModals > 0) {
                    for (var i = 0; i < skipPreviousModals; i++) {
                        if (destroySkipped) {
                            const id = this.componentHistory[this.componentHistory.length - 1];
                            Livewire.emit('destroyComponent', id);
                        }
                        this.componentHistory.pop();
                    }
                }
                const id = this.componentHistory.pop();
                if (id) {
                    this.setActiveModalComponent(id, true);
                } else {
                    this.forceCloseModal();
                }
            }
        },
        forceCloseModal() {
            this.componentHistory = [];
            this.activeComponent = false;
            this.setShowPropertyTo(false);
        },
        setActiveModalComponent(id, skip = false) {
            // console.log('%csetActiveModalComponent ' + id, 'color: #0DF688');
            if (this.activeComponent === id) {
                return;
            }
            this.setShowPropertyTo(true);
            if (skip === false) {
                this.componentHistory.push(this.activeComponent);
            }
            this.componentAttributes(id);
            this.$nextTick(() => {
                let focusable = this.$refs[id]?.querySelector('[autofocus]');
                if (focusable) {
                    setTimeout(() => {
                        focusable.focus();
                    }, 800);
                }
            });
            if (this.isBootstrapFramework()) {
                this.toggleBootstrapModal(id);
            }
        },
        focusables() {
            let selector = 'a, button, input, textarea, select, details, [tabindex]:not([tabindex=\'-1\'])';
            return [...this.$el.querySelectorAll(selector)].filter(el => !el.hasAttribute('disabled'));
        },
        firstFocusable() {
            return this.focusables()[0];
        },
        lastFocusable() {
            return this.focusables().slice(-1)[0];
        },
        nextFocusable() {
            return this.focusables()[this.nextFocusableIndex()] || this.firstFocusable();
        },
        prevFocusable() {
            return this.focusables()[this.prevFocusableIndex()] || this.lastFocusable();
        },
        nextFocusableIndex() {
            return (this.focusables().indexOf(document.activeElement) + 1) % (this.focusables().length + 1);
        },
        prevFocusableIndex() {
            return Math.max(0, this.focusables().indexOf(document.activeElement)) - 1;
        },
        setShowPropertyTo(show) {
            this.show = show;
            if (show) {
                document.body.classList.add('overflow-y-hidden');
            } else {
                document.body.classList.remove('overflow-y-hidden');
                setTimeout(() => {
                    this.activeComponent = false;
                    this.$wire.resetState();
                }, 300);
            }
        },
        init() {
            this.modalClasses = this.getActiveComponentModalAttribute('modalClasses');
            Livewire.on('closeModal', (force = false, skipPreviousModals = 0, destroySkipped = false) => {
                this.closeModal(force, skipPreviousModals, destroySkipped);
            });
            Livewire.on('activeModalComponentChanged', (id) => {
                if (this.activeComponent) {
                    this.toggleBootstrapModal(this.activeComponent);
                }
                this.setActiveModalComponent(id);
            });
        },
        componentAttributes(id) {
            this.activeComponent = id;
            this.showActiveComponent = true;
            this.modalTitle = this.getActiveComponentModalAttribute('modalTitle');
            this.modalClasses = this.getActiveComponentModalAttribute('modalClasses');
        },
        bootstrapModal(id) {
            const element = document.getElementById(id);
            const modal = bootstrap.Modal.getOrCreateInstance(element);
            return modal;
        },
        toggleBootstrapModal(id) {
            const modal = this.bootstrapModal(id);
            modal.toggle();
        },
    };
}
