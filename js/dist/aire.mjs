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

Validator.registerMissedRuleValidator(function () {
  return true;
}, '');

var resolveElement = function resolveElement(target) {
  if ('string' === typeof target) {
    return document.querySelector(target);
  }

  return target;
};

var getData = function getData(form, only) {
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

      key = key.replace(/\[]$/, '');

      if ('undefined' !== typeof only && !only.has(key) && ('' === value || !value)) {
        continue;
      }

      if (values[key]) {
        if (!(values[key] instanceof Array)) {
          values[key] = new Array(values[key]);
        }

        values[key].push(value);
      } else {
        values[key] = value;
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
  console.log(config);
}; // TODO: We probably need to memoize the dom references

var defaultRenderer = function defaultRenderer(form) {
  var errors = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
  var data = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};
  form.querySelectorAll('[data-aire-group-for]').forEach(function ($group) {
    var name = $group.dataset.aireGroupFor;
    var fails = name in errors;
    var passes = !fails && name in data;
    var $errors = $group.querySelector(['[data-aire-errors]']);
    var _config = config,
        templates = _config.templates,
        classnames = _config.classnames;

    var targets = _toConsumableArray(Object.keys(classnames.none)).concat(_toConsumableArray(Object.keys(classnames.valid)), _toConsumableArray(Object.keys(classnames.invalid))).filter(function (key, index, targets) {
      return targets.indexOf(key) === index;
    }).map(function (key) {
      return {
        key: key,
        $target: $group.querySelector(key)
      };
    });

    targets.forEach(function (_ref) {
      var key = _ref.key,
          $target = _ref.$target;

      if (!$target) {
        return;
      }

      if (key in classnames.valid) {
        if (passes) {
          var _$target$classList;

          (_$target$classList = $target.classList).add.apply(_$target$classList, _toConsumableArray(classnames.valid[key].split(' ')));
        } else {
          var _$target$classList2;

          (_$target$classList2 = $target.classList).remove.apply(_$target$classList2, _toConsumableArray(classnames.valid[key].split(' ')));
        }
      }

      if (key in classnames.invalid) {
        if (fails) {
          var _$target$classList3;

          (_$target$classList3 = $target.classList).add.apply(_$target$classList3, _toConsumableArray(classnames.invalid[key].split(' ')));
        } else {
          var _$target$classList4;

          (_$target$classList4 = $target.classList).remove.apply(_$target$classList4, _toConsumableArray(classnames.invalid[key].split(' ')));
        }
      }

      if (key in classnames.none) {
        if (!passes && !fails) {
          var _$target$classList5;

          (_$target$classList5 = $target.classList).add.apply(_$target$classList5, _toConsumableArray(classnames.none[key].split(' ')));
        } else {
          var _$target$classList6;

          (_$target$classList6 = $target.classList).remove.apply(_$target$classList6, _toConsumableArray(classnames.none[key].split(' ')));
        }
      }
    });

    if (passes) {
      // console.log(`${name} passes validation`);
      $errors.classList.add('hidden');
      $errors.innerHTML = '';
    } else if (fails) {
      // TODO: Maybe hide help text
      // console.error(`${name} fails validation`, errors[name]);
      $errors.classList.remove('hidden');
      $errors.innerHTML = errors[name].map(function (message) {
        return "".concat(templates.error.prefix).concat(message).concat(templates.error.suffix);
      }).join('');
    }
  });
};

var renderer = defaultRenderer;
var setRenderer = function setRenderer(customRenderer) {
  renderer = customRenderer;
};
var supported = 'undefined' !== typeof FormData && 'getAll' in FormData.prototype;
var connect = function connect(target) {
  var rules = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};

  if (!supported) {
    return null;
  }

  var form = resolveElement(target);
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
      validator = new Validator(getData(form, touched), rules); // Because some validators may run async, we'll store a reference
      // to the run "id" so that we can cancel the callbacks if another
      // validation started before the callbacks were fired

      var activeRun = ++latestRun;

      var passes = function passes() {
        if (connected && activeRun === latestRun) {
          renderer(form, {}, validator.input);
        }
      };

      var fails = function fails() {
        if (connected && activeRun === latestRun) {
          renderer(form, validator.errors.all(), validator.input);
        }
      };

      validator.checkAsync(passes, fails);
    }, 250);
  };

  form.addEventListener('change', run, true);
  form.addEventListener('keyup', run, true);
  form.addEventListener('focus', touch, true);
  run();

  var disconnect = function disconnect() {
    connected = false;
    clearTimeout(debounce);
    form.removeEventListener('change', run);
    form.removeEventListener('keyup', run);
    form.removeEventListener('focus', touch);
  };

  return {
    get valid() {
      return 'undefined' !== typeof validator && 0 === Object.keys(validator.errors.all()).length;
    },

    run: run,
    disconnect: disconnect
  };
};

export { configure, setRenderer, supported, connect };
