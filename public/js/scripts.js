/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************************************************!*\
  !*** ./packages/livewire-bootstrap-modal/resources/js/scripts.js ***!
  \*******************************************************************/
function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }
function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }
function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }
window.LivewireBootstrapModal = function () {
  return {
    show: false,
    showActiveComponent: true,
    activeComponent: false,
    componentHistory: [],
    modalClasses: '',
    modalTitle: '',
    isBootstrapFramework: function isBootstrapFramework() {
      return this.getActiveComponentModalAttribute('framework') === 'bootstrap';
    },
    getActiveComponentModalAttribute: function getActiveComponentModalAttribute(key) {
      if (this.$wire.get('components')[this.activeComponent] !== undefined) {
        return this.$wire.get('components')[this.activeComponent]['modalAttributes'][key];
      }
    },
    closeModalOnEscape: function closeModalOnEscape(trigger) {
      if (this.getActiveComponentModalAttribute('closeOnEscape') === false) {
        return;
      }
      var force = this.getActiveComponentModalAttribute('closeOnEscapeIsForceful') === true;
      this.closeModal(force);
    },
    closeModalOnClickAway: function closeModalOnClickAway(trigger) {
      if (this.getActiveComponentModalAttribute('closeOnClickAway') === false) {
        return;
      }
      this.closeModal(true);
    },
    closeModal: function closeModal() {
      var force = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;
      var skipPreviousModals = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 0;
      var destroySkipped = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : false;
      if (this.show === false) {
        return;
      }
      var name = this.$wire.get('components')[this.activeComponent].name;
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
              var _id = this.componentHistory[this.componentHistory.length - 1];
              Livewire.emit('destroyComponent', _id);
            }
            this.componentHistory.pop();
          }
        }
        var id = this.componentHistory.pop();
        if (id) {
          this.setActiveModalComponent(id, true);
        } else {
          this.forceCloseModal();
        }
      }
    },
    forceCloseModal: function forceCloseModal() {
      this.componentHistory = [];
      this.activeComponent = false;
      this.setShowPropertyTo(false);
    },
    setActiveModalComponent: function setActiveModalComponent(id) {
      var _this = this;
      var skip = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;
      // console.log('%csetActiveModalComponent ' + id, 'color: #0DF688');
      if (this.activeComponent === id) {
        return;
      }
      this.setShowPropertyTo(true);
      if (skip === false) {
        this.componentHistory.push(this.activeComponent);
      }
      this.componentAttributes(id);
      this.$nextTick(function () {
        var _this$$refs$id;
        var focusable = (_this$$refs$id = _this.$refs[id]) === null || _this$$refs$id === void 0 ? void 0 : _this$$refs$id.querySelector('[autofocus]');
        if (focusable) {
          setTimeout(function () {
            focusable.focus();
          }, 800);
        }
      });
      if (this.isBootstrapFramework()) {
        this.toggleBootstrapModal(id);
      }
    },
    focusables: function focusables() {
      var selector = 'a, button, input, textarea, select, details, [tabindex]:not([tabindex=\'-1\'])';
      return _toConsumableArray(this.$el.querySelectorAll(selector)).filter(function (el) {
        return !el.hasAttribute('disabled');
      });
    },
    firstFocusable: function firstFocusable() {
      return this.focusables()[0];
    },
    lastFocusable: function lastFocusable() {
      return this.focusables().slice(-1)[0];
    },
    nextFocusable: function nextFocusable() {
      return this.focusables()[this.nextFocusableIndex()] || this.firstFocusable();
    },
    prevFocusable: function prevFocusable() {
      return this.focusables()[this.prevFocusableIndex()] || this.lastFocusable();
    },
    nextFocusableIndex: function nextFocusableIndex() {
      return (this.focusables().indexOf(document.activeElement) + 1) % (this.focusables().length + 1);
    },
    prevFocusableIndex: function prevFocusableIndex() {
      return Math.max(0, this.focusables().indexOf(document.activeElement)) - 1;
    },
    setShowPropertyTo: function setShowPropertyTo(show) {
      var _this2 = this;
      this.show = show;
      if (show) {
        document.body.classList.add('overflow-y-hidden');
      } else {
        document.body.classList.remove('overflow-y-hidden');
        setTimeout(function () {
          _this2.activeComponent = false;
          _this2.$wire.resetState();
        }, 300);
      }
    },
    init: function init() {
      var _this3 = this;
      this.modalClasses = this.getActiveComponentModalAttribute('modalClasses');
      Livewire.on('closeModal', function () {
        var force = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;
        var skipPreviousModals = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 0;
        var destroySkipped = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : false;
        _this3.closeModal(force, skipPreviousModals, destroySkipped);
      });
      Livewire.on('activeModalComponentChanged', function (id) {
        if (_this3.activeComponent) {
          _this3.toggleBootstrapModal(_this3.activeComponent);
        }
        _this3.setActiveModalComponent(id);
      });
    },
    componentAttributes: function componentAttributes(id) {
      this.activeComponent = id;
      this.showActiveComponent = true;
      this.modalTitle = this.getActiveComponentModalAttribute('modalTitle');
      this.modalClasses = this.getActiveComponentModalAttribute('modalClasses');
    },
    bootstrapModal: function bootstrapModal(id) {
      var element = document.getElementById(id);
      var modal = bootstrap.Modal.getOrCreateInstance(element);
      return modal;
    },
    toggleBootstrapModal: function toggleBootstrapModal(id) {
      var modal = this.bootstrapModal(id);
      modal.toggle();
    }
  };
};
/******/ })()
;