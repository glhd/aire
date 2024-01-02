(function (global, factory) {
  typeof exports === 'object' && typeof module !== 'undefined' ? factory(exports) :
  typeof define === 'function' && define.amd ? define(['exports'], factory) :
  (global = global || self, factory(global.Aire = {}));
}(this, function (exports) { 'use strict';

  function _slicedToArray(arr, i) {
    return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _nonIterableRest();
  }

  function _toConsumableArray(arr) {
    return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _nonIterableSpread();
  }

  function _arrayWithoutHoles(arr) {
    if (Array.isArray(arr)) {
      for (var i = 0, arr2 = new Array(arr.length); i < arr.length; i++) arr2[i] = arr[i];

      return arr2;
    }
  }

  function _arrayWithHoles(arr) {
    if (Array.isArray(arr)) return arr;
  }

  function _iterableToArray(iter) {
    if (Symbol.iterator in Object(iter) || Object.prototype.toString.call(iter) === "[object Arguments]") return Array.from(iter);
  }

  function _iterableToArrayLimit(arr, i) {
    var _arr = [];
    var _n = true;
    var _d = false;
    var _e = undefined;

    try {
      for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) {
        _arr.push(_s.value);

        if (i && _arr.length === i) break;
      }
    } catch (err) {
      _d = true;
      _e = err;
    } finally {
      try {
        if (!_n && _i["return"] != null) _i["return"]();
      } finally {
        if (_d) throw _e;
      }
    }

    return _arr;
  }

  function _nonIterableSpread() {
    throw new TypeError("Invalid attempt to spread non-iterable instance");
  }

  function _nonIterableRest() {
    throw new TypeError("Invalid attempt to destructure non-iterable instance");
  }

  var resolveElement = function resolveElement(target) {
    if ('string' === typeof target) {
      return document.querySelector(target);
    }

    return target;
  };

  var getData = function getData(form) {
    var formData = new FormData(form);
    var values = {};
    var _iteratorNormalCompletion = true;
    var _didIteratorError = false;
    var _iteratorError = undefined;

    try {
      for (var _iterator = formData.entries()[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
        var _step$value = _slicedToArray(_step.value, 2),
            key = _step$value[0],
            value = _step$value[1];

        var name = key.replace(/\[]$/, '');
        var multiple = name !== key;

        if (values[name]) {
          if (!(values[name] instanceof Array)) {
            values[name] = [values[name]];
          }

          values[name].push(value);
        } else {
          values[name] = multiple ? [value] : value;
        }
      }
    } catch (err) {
      _didIteratorError = true;
      _iteratorError = err;
    } finally {
      try {
        if (!_iteratorNormalCompletion && _iterator.return != null) {
          _iterator.return();
        }
      } finally {
        if (_didIteratorError) {
          throw _iteratorError;
        }
      }
    }

    return values;
  };

  var booted = false;

  var boot = function boot() {
    if (!booted) {
      Validator.registerMissedRuleValidator(function () {
        return true;
      }, '');
      Validator.useLang('en'); // TODO: Make configurable
    }

    booted = true;
  };

  var config = {
    'templates': {
      'error': {
        'prefix': '<li>',
        'suffix': '</li>'
      }
    },
    'classnames': {
      'none': {},
      'valid': {},
      'invalid': {}
    }
  };
  var configure = function configure(customConfig) {
    config = customConfig;
  }; // FIXME: This still needs major perf work

  var defaultRenderer = function defaultRenderer(_ref) {
    var form = _ref.form,
        errors = _ref.errors,
        data = _ref.data,
        rules = _ref.rules,
        refs = _ref.refs,
        touched = _ref.touched;
    var _config = config,
        templates = _config.templates,
        classnames = _config.classnames;
    Object.keys(rules).forEach(function (name) {
      // Stop if we don't have refs to this field
      if (!(name in refs)) {
        return;
      }

      var fails = touched.has(name) && 'input' in refs[name] && document.activeElement !== refs[name].input[0] && name in errors;
      var passes = touched.has(name) && !fails && name in data;

      if ('errors' in refs[name]) {
        if (passes) {
          refs[name].errors[0].innerHTML = '';
        } else if (fails) {
          refs[name].errors[0].innerHTML = errors[name].map(function (message) {
            return "".concat(templates.error.prefix).concat(message).concat(templates.error.suffix);
          }).join('');
        }
      }

      Object.entries(refs[name]).forEach(function (_ref2) {
        var _ref3 = _slicedToArray(_ref2, 2),
            name = _ref3[0],
            elements = _ref3[1];

        elements.forEach(function (element) {
          if (name in classnames.valid) {
            var passes_classnames = classnames.valid[name].split(' ');

            if (passes_classnames.length) {
              if (passes) {
                var _element$classList;

                (_element$classList = element.classList).add.apply(_element$classList, _toConsumableArray(passes_classnames));
              } else if (fails) {
                var _element$classList2;

                (_element$classList2 = element.classList).remove.apply(_element$classList2, _toConsumableArray(passes_classnames));
              }
            }
          }

          if (name in classnames.invalid) {
            var fails_classnames = classnames.invalid[name].split(' ');

            if (fails_classnames.length) {
              if (fails) {
                var _element$classList3;

                (_element$classList3 = element.classList).add.apply(_element$classList3, _toConsumableArray(fails_classnames));
              } else if (passes) {
                var _element$classList4;

                (_element$classList4 = element.classList).remove.apply(_element$classList4, _toConsumableArray(fails_classnames));
              }
            }
          }

          if (name in classnames.none) {
            var none_classnames = classnames.none[name].split(' ');

            if (none_classnames.length) {
              if (!passes && !fails) {
                var _element$classList5;

                (_element$classList5 = element.classList).add.apply(_element$classList5, _toConsumableArray(none_classnames));
              } else {
                var _element$classList6;

                (_element$classList6 = element.classList).remove.apply(_element$classList6, _toConsumableArray(none_classnames));
              }
            }
          }
        });
      });
    });
  };

  var renderer = defaultRenderer;
  var setRenderer = function setRenderer(customRenderer) {
    renderer = customRenderer;
  };
  var supported = 'undefined' !== typeof FormData && 'getAll' in FormData.prototype;
  var connect = function connect(target) {
    var rules = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
    var messages = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};

    if (!supported) {
      return null;
    }

    boot();
    var form = resolveElement(target);
    var refs = {};

    var storeRef = function storeRef(parent, component, element) {
      refs[parent] = refs[parent] || {};
      refs[parent][component] = refs[parent][component] || [];
      refs[parent][component].push(element);
    };

    form.querySelectorAll('[data-aire-component]').forEach(function (element) {
      if ('aireFor' in element.dataset) {
        var parent = element.dataset.aireFor;
        var component = element.dataset.aireComponent; // Add the component to the refs

        storeRef(parent, component, element); // If we have a validation key, let the element also be referenced by it

        if ('aireValidationKey' in element.dataset && component !== element.dataset.aireValidationKey) {
          storeRef(parent, element.dataset.aireValidationKey, element);
        }
      }
    });
    var validator;
    var connected = true;
    var touched = new Set();

    var touch = function touch(e) {
      var name = e.target.getAttribute('name');

      if (name) {
        touched.add(name.replace(/\[]$/, ''));
      }
    };

    var debounce;

    var run = function run(e) {
      if ('undefined' !== typeof e && 'target' in e) {
        touch(e);
      }

      var latestRun = 0;
      clearTimeout(debounce);
      debounce = setTimeout(function () {
        var data = getData(form);
        validator = new Validator(data, rules, messages); // Because some validators may run async, we'll store a reference
        // to the run "id" so that we can cancel the callbacks if another
        // validation started before the callbacks were fired

        var activeRun = ++latestRun; // If this is the first run, "touch" anything that has a value

        if (1 === activeRun) {
          Object.entries(data).forEach(function (_ref4) {
            var _ref5 = _slicedToArray(_ref4, 2),
                key = _ref5[0],
                value = _ref5[1];

            if (null === value || 'undefined' === typeof value || '' === value) {
              return;
            }

            if (Array.isArray(value) && 0 === value.length) {
              return;
            } // Don't mark as touched if it has errors in it


            if (key in refs && 'errors' in refs[key] && refs[key].errors[0].childElementCount > 0) {
              return;
            }

            touched.add(key);
          });
        }

        var validated = function validated() {
          if (connected && activeRun === latestRun) {
            renderer({
              form: form,
              rules: rules,
              touched: touched,
              refs: refs,
              data: data,
              errors: validator.errors.all()
            });
          }
        };

        validator.checkAsync(validated, validated);
      }, 250);
    };

    form.addEventListener('change', run, true);
    form.addEventListener('keyup', run, true);
    form.addEventListener('blur', touch, true);
    run();

    var disconnect = function disconnect() {
      connected = false;
      clearTimeout(debounce);
      form.removeEventListener('change', run);
      form.removeEventListener('keyup', run);
      form.removeEventListener('blur', touch);
    };

    return {
      get valid() {
        return 'undefined' !== typeof validator && 0 === Object.keys(validator.errors.all()).length;
      },

      get data() {
        return 'undefined' === typeof validator ? getData(form) : validator.input;
      },

      get validator() {
        return validator;
      },

      run: run,
      disconnect: disconnect
    };
  };

  exports.configure = configure;
  exports.connect = connect;
  exports.setRenderer = setRenderer;
  exports.supported = supported;

  Object.defineProperty(exports, '__esModule', { value: true });

}));
