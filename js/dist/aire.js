(function () {
  'use strict';

  function leapYear(year) {
    return ((year % 4 === 0) && (year % 100 !== 0)) || (year % 400 === 0);
  }

  function isValidDate(inDate) {
      var valid = true;

      // reformat if supplied as mm.dd.yyyy (period delimiter)
      if (typeof inDate === 'string') {
        var pos = inDate.indexOf('.');
        if ((pos > 0 && pos <= 6)) {
          inDate = inDate.replace(/\./g, '-');
        }
      }

      var testDate = new Date(inDate);
      var yr = testDate.getFullYear();
      var mo = testDate.getMonth();
      var day = testDate.getDate();

      var daysInMonth = [31, (leapYear(yr) ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

      if (yr < 1000) { return false; }
      if (isNaN(mo)) { return false; }
      if (mo + 1 > 12) { return false; }
      if (isNaN(day)) { return false; }
      if (day > daysInMonth[mo]) { return false; }

      return valid;
  }

  var rules = {

    required: function(val) {
      var str;

      if (val === undefined || val === null) {
        return false;
      }

      str = String(val).replace(/\s/g, "");
      return str.length > 0 ? true : false;
    },

    required_if: function(val, req, attribute) {
      req = this.getParameters();
      if (this.validator._objectPath(this.validator.input, req[0]) === req[1]) {
        return this.validator.getRule('required').validate(val);
      }

      return true;
    },

    required_unless: function(val, req, attribute) {
      req = this.getParameters();
      if (this.validator._objectPath(this.validator.input, req[0]) !== req[1]) {
        return this.validator.getRule('required').validate(val);
      }

      return true;
    },

    required_with: function(val, req, attribute) {
      if (this.validator._objectPath(this.validator.input, req)) {
        return this.validator.getRule('required').validate(val);
      }

      return true;
    },

    required_with_all: function(val, req, attribute) {

      req = this.getParameters();

      for(var i = 0; i < req.length; i++) {
        if (!this.validator._objectPath(this.validator.input, req[i])) {
          return true;
        }
      }

      return this.validator.getRule('required').validate(val);
    },

    required_without: function(val, req, attribute) {

      if (this.validator._objectPath(this.validator.input, req)) {
        return true;
      }

      return this.validator.getRule('required').validate(val);
    },

    required_without_all: function(val, req, attribute) {

      req = this.getParameters();

      for(var i = 0; i < req.length; i++) {
        if (this.validator._objectPath(this.validator.input, req[i])) {
          return true;
        }
      }

      return this.validator.getRule('required').validate(val);
    },

    'boolean': function (val) {
      return (
        val === true ||
        val === false ||
        val === 0 ||
        val === 1 ||
        val === '0' ||
        val === '1' ||
        val === 'true' ||
        val === 'false'
      );
    },

    // compares the size of strings
    // with numbers, compares the value
    size: function(val, req, attribute) {
      if (val) {
        req = parseFloat(req);

        var size = this.getSize();

        return size === req;
      }

      return true;
    },

    string: function(val, req, attribute) {
      return typeof val === 'string';
    },

    sometimes: function(val) {
      return true;
    },

    /**
     * Compares the size of strings or the value of numbers if there is a truthy value
     */
    min: function(val, req, attribute) {
      var size = this.getSize();
      return size >= req;
    },

    /**
     * Compares the size of strings or the value of numbers if there is a truthy value
     */
    max: function(val, req, attribute) {
      var size = this.getSize();
      return size <= req;
    },

    between: function(val, req, attribute) {
      req = this.getParameters();
      var size = this.getSize();
      var min = parseFloat(req[0], 10);
      var max = parseFloat(req[1], 10);
      return size >= min && size <= max;
    },

    email: function(val) {
      var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(val);
    },

    numeric: function(val) {
      var num;

      num = Number(val); // tries to convert value to a number. useful if value is coming from form element

      if (typeof num === 'number' && !isNaN(num) && typeof val !== 'boolean') {
        return true;
      } else {
        return false;
      }
    },

    array: function(val) {
      return val instanceof Array;
    },

    url: function(url) {
      return (/https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-z]{2,63}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/i).test(url);
    },

    alpha: function(val) {
      return (/^[a-zA-Z]+$/).test(val);
    },

    alpha_dash: function(val) {
      return (/^[a-zA-Z0-9_\-]+$/).test(val);
    },

    alpha_num: function(val) {
      return (/^[a-zA-Z0-9]+$/).test(val);
    },

    same: function(val, req) {
      var val1 = this.validator._flattenObject(this.validator.input)[req];
      var val2 = val;

      if (val1 === val2) {
        return true;
      }

      return false;
    },

    different: function(val, req) {
      var val1 = this.validator._flattenObject(this.validator.input)[req];
      var val2 = val;

      if (val1 !== val2) {
        return true;
      }

      return false;
    },

    "in": function(val, req) {
      var list, i;

      if (val) {
        list = this.getParameters();
      }

      if (val && !(val instanceof Array)) {
        var localValue = val;

        for (i = 0; i < list.length; i++) {
          if (typeof list[i] === 'string') {
            localValue = String(val);
          }

          if (localValue === list[i]) {
            return true;
          }
        }

        return false;
      }

      if (val && val instanceof Array) {
        for (i = 0; i < val.length; i++) {
          if (list.indexOf(val[i]) < 0) {
            return false;
          }
        }
      }

      return true;
    },

    not_in: function(val, req) {
      var list = this.getParameters();
      var len = list.length;
      var returnVal = true;

      for (var i = 0; i < len; i++) {
        var localValue = val;

        if (typeof list[i] === 'string') {
          localValue = String(val);
        }

        if (localValue === list[i]) {
          returnVal = false;
          break;
        }
      }

      return returnVal;
    },

    accepted: function(val) {
      if (val === 'on' || val === 'yes' || val === 1 || val === '1' || val === true) {
        return true;
      }

      return false;
    },

    confirmed: function(val, req, key) {
      var confirmedKey = key + '_confirmation';

      if (this.validator.input[confirmedKey] === val) {
        return true;
      }

      return false;
    },

    integer: function(val) {
      return String(parseInt(val, 10)) === String(val);
    },

    digits: function(val, req) {
      var numericRule = this.validator.getRule('numeric');
      if (numericRule.validate(val) && String(val).length === parseInt(req)) {
        return true;
      }

      return false;
    },

    regex: function(val, req) {
      var mod = /[g|i|m]{1,3}$/;
      var flag = req.match(mod);
      flag = flag ? flag[0] : "";
      req = req.replace(mod, "").slice(1, -1);
      req = new RegExp(req, flag);
      return !!req.test(val);
    },

    date: function(val, format) {
      return isValidDate(val);
    },

    present: function(val) {
      return typeof val !== 'undefined';
    },

    after: function(val, req){
      var val1 = this.validator.input[req];
      var val2 = val;

      if(!isValidDate(val1)){ return false;}
      if(!isValidDate(val2)){ return false;}

      if (new Date(val1).getTime() < new Date(val2).getTime()) {
        return true;
      }

      return false;
    },

     after_or_equal: function(val, req){
      var val1 = this.validator.input[req];
      var val2 = val;

      if(!isValidDate(val1)){ return false;}
      if(!isValidDate(val2)){ return false;}

      if (new Date(val1).getTime() <= new Date(val2).getTime()) {
        return true;
      }

      return false;
    },

    before: function(val, req){
      var val1 = this.validator.input[req];
      var val2 = val;

      if(!isValidDate(val1)){ return false;}
      if(!isValidDate(val2)){ return false;}

      if (new Date(val1).getTime() > new Date(val2).getTime()) {
        return true;
      }

      return false;
    },

     before_or_equal: function(val, req){
      var val1 = this.validator.input[req];
      var val2 = val;

      if(!isValidDate(val1)){ return false;}
      if(!isValidDate(val2)){ return false;}

      if (new Date(val1).getTime() >= new Date(val2).getTime()) {
        return true;
      }

      return false;
    },

    hex: function(val) {
      return (/^[0-9a-f]+$/i).test(val);
    }
  };

  var missedRuleValidator = function() {
    throw new Error('Validator `' + this.name + '` is not defined!');
  };
  var missedRuleMessage;

  function Rule(name, fn, async) {
    this.name = name;
    this.fn = fn;
    this.passes = null;
    this._customMessage = undefined;
    this.async = async;
  }

  Rule.prototype = {

    /**
     * Validate rule
     *
     * @param  {mixed} inputValue
     * @param  {mixed} ruleValue
     * @param  {string} attribute
     * @param  {function} callback
     * @return {boolean|undefined}
     */
    validate: function(inputValue, ruleValue, attribute, callback) {
      var _this = this;
      this._setValidatingData(attribute, inputValue, ruleValue);
      if (typeof callback === 'function') {
        this.callback = callback;
        var handleResponse = function(passes, message) {
          _this.response(passes, message);
        };

        if (this.async) {
          return this._apply(inputValue, ruleValue, attribute, handleResponse);
        } else {
          return handleResponse(this._apply(inputValue, ruleValue, attribute));
        }
      }
      return this._apply(inputValue, ruleValue, attribute);
    },

    /**
     * Apply validation function
     *
     * @param  {mixed} inputValue
     * @param  {mixed} ruleValue
     * @param  {string} attribute
     * @param  {function} callback
     * @return {boolean|undefined}
     */
    _apply: function(inputValue, ruleValue, attribute, callback) {
      var fn = this.isMissed() ? missedRuleValidator : this.fn;

      return fn.apply(this, [inputValue, ruleValue, attribute, callback]);
    },

    /**
     * Set validating data
     *
     * @param {string} attribute
     * @param {mixed} inputValue
     * @param {mixed} ruleValue
     * @return {void}
     */
    _setValidatingData: function(attribute, inputValue, ruleValue) {
      this.attribute = attribute;
      this.inputValue = inputValue;
      this.ruleValue = ruleValue;
    },

    /**
     * Get parameters
     *
     * @return {array}
     */
    getParameters: function() {
      var value = [];

      if (typeof this.ruleValue === 'string') {
        value = this.ruleValue.split(',');
      }

      if (typeof this.ruleValue === 'number') {
        value.push(this.ruleValue);
      }

      if (this.ruleValue instanceof Array) {
        value = this.ruleValue;
      }

      return value;
    },

    /**
     * Get true size of value
     *
     * @return {integer|float}
     */
    getSize: function() {
      var value = this.inputValue;

      if (value instanceof Array) {
        return value.length;
      }

      if (typeof value === 'number') {
        return value;
      }

      if (this.validator._hasNumericRule(this.attribute)) {
        return parseFloat(value, 10);
      }

      return value.length;
    },

    /**
     * Get the type of value being checked; numeric or string.
     *
     * @return {string}
     */
    _getValueType: function() {

      if (typeof this.inputValue === 'number' || this.validator._hasNumericRule(this.attribute)) {
        return 'numeric';
      }

      return 'string';
    },

    /**
     * Set the async callback response
     *
     * @param  {boolean|undefined} passes  Whether validation passed
     * @param  {string|undefined} message Custom error message
     * @return {void}
     */
    response: function(passes, message) {
      this.passes = (passes === undefined || passes === true);
      this._customMessage = message;
      this.callback(this.passes, message);
    },

    /**
     * Set validator instance
     *
     * @param {Validator} validator
     * @return {void}
     */
    setValidator: function(validator) {
      this.validator = validator;
    },

    /**
     * Check if rule is missed
     *
     * @return {boolean}
     */
    isMissed: function() {
      return typeof this.fn !== 'function';
    },

    get customMessage() {
      return this.isMissed() ? missedRuleMessage : this._customMessage;
    }
  };

  var manager = {

    /**
     * List of async rule names
     *
     * @type {Array}
     */
    asyncRules: [],

    /**
     * Implicit rules (rules to always validate)
     *
     * @type {Array}
     */
    implicitRules: ['required', 'required_if', 'required_unless', 'required_with', 'required_with_all', 'required_without', 'required_without_all', 'accepted', 'present'],

    /**
     * Get rule by name
     *
     * @param  {string} name
     * @param {Validator}
     * @return {Rule}
     */
    make: function(name, validator) {
      var async = this.isAsync(name);
      var rule = new Rule(name, rules[name], async);
      rule.setValidator(validator);
      return rule;
    },

    /**
     * Determine if given rule is async
     *
     * @param  {string}  name
     * @return {boolean}
     */
    isAsync: function(name) {
      for (var i = 0, len = this.asyncRules.length; i < len; i++) {
        if (this.asyncRules[i] === name) {
          return true;
        }
      }
      return false;
    },

    /**
     * Determine if rule is implicit (should always validate)
     *
     * @param {string} name
     * @return {boolean}
     */
    isImplicit: function(name) {
      return this.implicitRules.indexOf(name) > -1;
    },

    /**
     * Register new rule
     *
     * @param  {string}   name
     * @param  {function} fn
     * @return {void}
     */
    register: function(name, fn) {
      rules[name] = fn;
    },

      /**
     * Register new implicit rule
     *
     * @param  {string}   name
     * @param  {function} fn
     * @return {void}
     */
    registerImplicit: function(name, fn) {
      this.register(name, fn);
      this.implicitRules.push(name);
    },

    /**
     * Register async rule
     *
     * @param  {string}   name
     * @param  {function} fn
     * @return {void}
     */
    registerAsync: function(name, fn) {
      this.register(name, fn);
      this.asyncRules.push(name);
    },

    /**
     * Register implicit async rule
     *
     * @param  {string}   name
     * @param  {function} fn
     * @return {void}
     */
    registerAsyncImplicit: function(name, fn) {
      this.registerImplicit(name, fn);
      this.asyncRules.push(name);
    },

    registerMissedRuleValidator: function(fn, message) {
      missedRuleValidator = fn;
      missedRuleMessage = message;
    }
  };



  var rules_1 = manager;

  function commonjsRequire () {
  	throw new Error('Dynamic requires are not currently supported by rollup-plugin-commonjs');
  }

  var replacements = {

    /**
     * Between replacement (replaces :min and :max)
     *
     * @param  {string} template
     * @param  {Rule} rule
     * @return {string}
     */
    between: function(template, rule) {
      var parameters = rule.getParameters();
      return this._replacePlaceholders(rule, template, {
        min: parameters[0],
        max: parameters[1]
      });
    },

    /**
     * Required_if replacement.
     *
     * @param  {string} template
     * @param  {Rule} rule
     * @return {string}
     */
    required_if: function(template, rule) {
      var parameters = rule.getParameters();
      return this._replacePlaceholders(rule, template, {
        other: this._getAttributeName(parameters[0]),
        value: parameters[1]
      });
    },

    /**
     * Required_unless replacement.
     *
     * @param  {string} template
     * @param  {Rule} rule
     * @return {string}
     */
    required_unless: function(template, rule) {
      var parameters = rule.getParameters();
      return this._replacePlaceholders(rule, template, {
        other: this._getAttributeName(parameters[0]),
        value: parameters[1]
      });
    },

    /**
     * Required_with replacement.
     *
     * @param  {string} template
     * @param  {Rule} rule
     * @return {string}
     */
    required_with: function(template, rule) {
      var parameters = rule.getParameters();
      return this._replacePlaceholders(rule, template, {
        field: this._getAttributeName(parameters[0])
      });
    },

    /**
     * Required_with_all replacement.
     *
     * @param  {string} template
     * @param  {Rule} rule
     * @return {string}
     */
    required_with_all: function(template, rule) {
      var parameters = rule.getParameters();
      var getAttributeName = this._getAttributeName.bind(this);
      return this._replacePlaceholders(rule, template, {
        fields: parameters.map(getAttributeName).join(', ')
      });
    },

    /**
     * Required_without replacement.
     *
     * @param  {string} template
     * @param  {Rule} rule
     * @return {string}
     */
    required_without: function(template, rule) {
      var parameters = rule.getParameters();
      return this._replacePlaceholders(rule, template, {
        field: this._getAttributeName(parameters[0])
      });
    },

    /**
     * Required_without_all replacement.
     *
     * @param  {string} template
     * @param  {Rule} rule
     * @return {string}
     */
    required_without_all: function(template, rule) {
      var parameters = rule.getParameters();
      var getAttributeName = this._getAttributeName.bind(this);
      return this._replacePlaceholders(rule, template, {
        fields: parameters.map(getAttributeName).join(', ')
      });
    },

   /**
     * After replacement.
     *
     * @param  {string} template
     * @param  {Rule} rule
     * @return {string}
     */
    after: function(template, rule) {
      var parameters = rule.getParameters();
      return this._replacePlaceholders(rule, template, {
        after: this._getAttributeName(parameters[0])
      });
    },

    /**
     * Before replacement.
     *
     * @param  {string} template
     * @param  {Rule} rule
     * @return {string}
     */
    before: function(template, rule) {
      var parameters = rule.getParameters();
      return this._replacePlaceholders(rule, template, {
        before: this._getAttributeName(parameters[0])
      });
    },

    /**
     * After_or_equal replacement.
     *
     * @param  {string} template
     * @param  {Rule} rule
     * @return {string}
     */
    after_or_equal: function(template, rule) {
      var parameters = rule.getParameters();
      return this._replacePlaceholders(rule, template, {
        after_or_equal: this._getAttributeName(parameters[0])
      });
    },

    /**
     * Before_or_equal replacement.
     *
     * @param  {string} template
     * @param  {Rule} rule
     * @return {string}
     */
    before_or_equal: function(template, rule) {
      var parameters = rule.getParameters();
      return this._replacePlaceholders(rule, template, {
        before_or_equal: this._getAttributeName(parameters[0])
      });
    },

    /**
     * Same replacement.
     *
     * @param  {string} template
     * @param  {Rule} rule
     * @return {string}
     */
    same: function(template, rule) {
      var parameters = rule.getParameters();
      return this._replacePlaceholders(rule, template, {
        same: this._getAttributeName(parameters[0])
      });
    },
  };

  function formatter(attribute) {
    return attribute.replace(/[_\[]/g, ' ').replace(/]/g, '');
  }

  var attributes = {
    replacements: replacements,
    formatter: formatter
  };

  var Messages = function(lang, messages) {
    this.lang = lang;
    this.messages = messages;
    this.customMessages = {};
    this.attributeNames = {};
  };

  Messages.prototype = {
    constructor: Messages,

    /**
     * Set custom messages
     *
     * @param {object} customMessages
     * @return {void}
     */
    _setCustom: function(customMessages) {
      this.customMessages = customMessages || {};
    },

    /**
     * Set custom attribute names.
     *
     * @param {object} attributes
     */
    _setAttributeNames: function(attributes$$1) {
      this.attributeNames = attributes$$1;
    },

    /**
     * Set the attribute formatter.
     *
     * @param {fuction} func
     * @return {void}
     */
    _setAttributeFormatter: function(func) {
      this.attributeFormatter = func;
    },

    /**
     * Get attribute name to display.
     *
     * @param  {string} attribute
     * @return {string}
     */
    _getAttributeName: function(attribute) {
      var name = attribute;
      if (this.attributeNames.hasOwnProperty(attribute)) {
        return this.attributeNames[attribute];
      } else if (this.messages.attributes.hasOwnProperty(attribute)) {
        name = this.messages.attributes[attribute];
      }

      if (this.attributeFormatter) {
        name = this.attributeFormatter(name);
      }

      return name;
    },

    /**
     * Get all messages
     *
     * @return {object}
     */
    all: function() {
      return this.messages;
    },

    /**
     * Render message
     *
     * @param  {Rule} rule
     * @return {string}
     */
    render: function(rule) {
      if (rule.customMessage) {
        return rule.customMessage;
      }
      var template = this._getTemplate(rule);

      var message;
      if (attributes.replacements[rule.name]) {
        message = attributes.replacements[rule.name].apply(this, [template, rule]);
      } else {
        message = this._replacePlaceholders(rule, template, {});
      }

      return message;
    },

    /**
     * Get the template to use for given rule
     *
     * @param  {Rule} rule
     * @return {string}
     */
    _getTemplate: function(rule) {

      var messages = this.messages;
      var template = messages.def;
      var customMessages = this.customMessages;
      var formats = [rule.name + '.' + rule.attribute, rule.name];

      for (var i = 0, format; i < formats.length; i++) {
        format = formats[i];
        if (customMessages.hasOwnProperty(format)) {
          template = customMessages[format];
          break;
        } else if (messages.hasOwnProperty(format)) {
          template = messages[format];
          break;
        }
      }

      if (typeof template === 'object') {
        template = template[rule._getValueType()];
      }

      return template;
    },

    /**
     * Replace placeholders in the template using the data object
     *
     * @param  {Rule} rule
     * @param  {string} template
     * @param  {object} data
     * @return {string}
     */
    _replacePlaceholders: function(rule, template, data) {
      var message, attribute;

      data.attribute = this._getAttributeName(rule.attribute);
      data[rule.name] = data[rule.name] || rule.getParameters().join(',');

      if (typeof template === 'string' && typeof data === 'object') {
        message = template;

        for (attribute in data) {
          message = message.replace(new RegExp(':' + attribute, 'g'), data[attribute]);
        }
      }

      return message;
    }

  };

  var messages = Messages;

  var require_method = commonjsRequire;

  var container = {

    messages: {},

    /**
     * Set messages for language
     *
     * @param {string} lang
     * @param {object} rawMessages
     * @return {void}
     */
    _set: function(lang, rawMessages) {
      this.messages[lang] = rawMessages;
    },

    /**
     * Set message for given language's rule.
     *
     * @param {string} lang
     * @param {string} attribute
     * @param {string|object} message
     * @return {void}
     */
    _setRuleMessage: function(lang, attribute, message) {
      this._load(lang);
      if (message === undefined) {
        message = this.messages[lang].def;
      }

      this.messages[lang][attribute] = message;
    },

    /**
     * Load messages (if not already loaded)
     *
     * @param  {string} lang
     * @return {void}
     */
    _load: function(lang) {
      if (!this.messages[lang]) {
        try {
          var rawMessages = require_method('./lang/' + lang);
          this._set(lang, rawMessages);
        } catch (e) {}
      }
    },

    /**
     * Get raw messages for language
     *
     * @param  {string} lang
     * @return {object}
     */
    _get: function(lang) {
      this._load(lang);
      return this.messages[lang];
    },

    /**
     * Make messages for given language
     *
     * @param  {string} lang
     * @return {Messages}
     */
    _make: function(lang) {
      this._load(lang);
      return new messages(lang, this.messages[lang]);
    }

  };

  var lang = container;

  var Errors = function() {
    this.errors = {};
  };

  Errors.prototype = {
    constructor: Errors,

    /**
     * Add new error message for given attribute
     *
     * @param  {string} attribute
     * @param  {string} message
     * @return {void}
     */
    add: function(attribute, message) {
      if (!this.has(attribute)) {
        this.errors[attribute] = [];
      }

      if (this.errors[attribute].indexOf(message) === -1) {
        this.errors[attribute].push(message);
      }
    },

    /**
     * Returns an array of error messages for an attribute, or an empty array
     *
     * @param  {string} attribute A key in the data object being validated
     * @return {array} An array of error messages
     */
    get: function(attribute) {
      if (this.has(attribute)) {
        return this.errors[attribute];
      }

      return [];
    },

    /**
     * Returns the first error message for an attribute, false otherwise
     *
     * @param  {string} attribute A key in the data object being validated
     * @return {string|false} First error message or false
     */
    first: function(attribute) {
      if (this.has(attribute)) {
        return this.errors[attribute][0];
      }

      return false;
    },

    /**
     * Get all error messages from all failing attributes
     *
     * @return {Object} Failed attribute names for keys and an array of messages for values
     */
    all: function() {
      return this.errors;
    },

    /**
     * Determine if there are any error messages for an attribute
     *
     * @param  {string}  attribute A key in the data object being validated
     * @return {boolean}
     */
    has: function(attribute) {
      if (this.errors.hasOwnProperty(attribute)) {
        return true;
      }

      return false;
    }
  };

  var errors = Errors;

  function AsyncResolvers(onFailedOne, onResolvedAll) {
    this.onResolvedAll = onResolvedAll;
    this.onFailedOne = onFailedOne;
    this.resolvers = {};
    this.resolversCount = 0;
    this.passed = [];
    this.failed = [];
    this.firing = false;
  }

  AsyncResolvers.prototype = {

    /**
     * Add resolver
     *
     * @param {Rule} rule
     * @return {integer}
     */
    add: function(rule) {
      var index = this.resolversCount;
      this.resolvers[index] = rule;
      this.resolversCount++;
      return index;
    },

    /**
     * Resolve given index
     *
     * @param  {integer} index
     * @return {void}
     */
    resolve: function(index) {
      var rule = this.resolvers[index];
      if (rule.passes === true) {
        this.passed.push(rule);
      } else if (rule.passes === false) {
        this.failed.push(rule);
        this.onFailedOne(rule);
      }

      this.fire();
    },

    /**
     * Determine if all have been resolved
     *
     * @return {boolean}
     */
    isAllResolved: function() {
      return (this.passed.length + this.failed.length) === this.resolversCount;
    },

    /**
     * Attempt to fire final all resolved callback if completed
     *
     * @return {void}
     */
    fire: function() {

      if (!this.firing) {
        return;
      }

      if (this.isAllResolved()) {
        this.onResolvedAll(this.failed.length === 0);
      }

    },

    /**
     * Enable firing
     *
     * @return {void}
     */
    enableFiring: function() {
      this.firing = true;
    }

  };

  var async = AsyncResolvers;

  var Validator$1 = function (input, rules, customMessages) {
    var lang$$1 = Validator$1.getDefaultLang();
    this.input = input || {};

    this.messages = lang._make(lang$$1);
    this.messages._setCustom(customMessages);
    this.setAttributeFormatter(Validator$1.prototype.attributeFormatter);

    this.errors = new errors();
    this.errorCount = 0;

    this.hasAsync = false;
    this.rules = this._parseRules(rules);
  };

  Validator$1.prototype = {

    constructor: Validator$1,

    /**
     * Default language
     *
     * @type {string}
     */
    lang: 'en',

    /**
     * Numeric based rules
     *
     * @type {array}
     */
    numericRules: ['integer', 'numeric'],

    /**
     * Attribute formatter.
     *
     * @type {function}
     */
    attributeFormatter: attributes.formatter,

    /**
     * Run validator
     *
     * @return {boolean} Whether it passes; true = passes, false = fails
     */
    check: function () {

      for (var attribute in this.rules) {
        var attributeRules = this.rules[attribute];
        var inputValue = this._objectPath(this.input, attribute);

        if (this._hasRule(attribute, ['sometimes']) && !this._suppliedWithData(attribute)) {
          continue;
        }

        for (var i = 0, len = attributeRules.length, rule, ruleOptions, rulePassed; i < len; i++) {
          ruleOptions = attributeRules[i];
          rule = this.getRule(ruleOptions.name);

          if (!this._isValidatable(rule, inputValue)) {
            continue;
          }

          rulePassed = rule.validate(inputValue, ruleOptions.value, attribute);
          if (!rulePassed) {
            this._addFailure(rule);
          }

          if (this._shouldStopValidating(attribute, rulePassed)) {
            break;
          }
        }
      }

      return this.errorCount === 0;
    },

    /**
     * Run async validator
     *
     * @param {function} passes
     * @param {function} fails
     * @return {void}
     */
    checkAsync: function (passes, fails) {
      var _this = this;
      passes = passes || function () {};
      fails = fails || function () {};

      var failsOne = function (rule, message) {
        _this._addFailure(rule, message);
      };

      var resolvedAll = function (allPassed) {
        if (allPassed) {
          passes();
        } else {
          fails();
        }
      };

      var asyncResolvers = new async(failsOne, resolvedAll);

      var validateRule = function (inputValue, ruleOptions, attribute, rule) {
        return function () {
          var resolverIndex = asyncResolvers.add(rule);
          rule.validate(inputValue, ruleOptions.value, attribute, function () {
            asyncResolvers.resolve(resolverIndex);
          });
        };
      };

      for (var attribute in this.rules) {
        var attributeRules = this.rules[attribute];
        var inputValue = this._objectPath(this.input, attribute);

        if (this._hasRule(attribute, ['sometimes']) && !this._suppliedWithData(attribute)) {
          continue;
        }

        for (var i = 0, len = attributeRules.length, rule, ruleOptions; i < len; i++) {
          ruleOptions = attributeRules[i];

          rule = this.getRule(ruleOptions.name);

          if (!this._isValidatable(rule, inputValue)) {
            continue;
          }

          validateRule(inputValue, ruleOptions, attribute, rule)();
        }
      }

      asyncResolvers.enableFiring();
      asyncResolvers.fire();
    },

    /**
     * Add failure and error message for given rule
     *
     * @param {Rule} rule
     */
    _addFailure: function (rule) {
      var msg = this.messages.render(rule);
      this.errors.add(rule.attribute, msg);
      this.errorCount++;
    },

    /**
     * Flatten nested object, normalizing { foo: { bar: 1 } } into: { 'foo.bar': 1 }
     *
     * @param  {object} nested object
     * @return {object} flattened object
     */
    _flattenObject: function (obj) {
      var flattened = {};

      function recurse(current, property) {
        if (!property && Object.getOwnPropertyNames(current).length === 0) {
          return;
        }
        if (Object(current) !== current || Array.isArray(current)) {
          flattened[property] = current;
        } else {
          var isEmpty = true;
          for (var p in current) {
            isEmpty = false;
            recurse(current[p], property ? property + "." + p : p);
          }
          if (isEmpty) {
            flattened[property] = {};
          }
        }
      }
      if (obj) {
        recurse(obj);
      }
      return flattened;
    },

    /**
     * Extract value from nested object using string path with dot notation
     *
     * @param  {object} object to search in
     * @param  {string} path inside object
     * @return {any|void} value under the path
     */
    _objectPath: function (obj, path) {
      if (Object.prototype.hasOwnProperty.call(obj, path)) {
        return obj[path];
      }

      var keys = path.replace(/\[(\w+)\]/g, ".$1").replace(/^\./, "").split(".");
      var copy = {};
      for (var attr in obj) {
        if (Object.prototype.hasOwnProperty.call(obj, attr)) {
          copy[attr] = obj[attr];
        }
      }

      for (var i = 0, l = keys.length; i < l; i++) {
        if (Object.hasOwnProperty.call(copy, keys[i])) {
          copy = copy[keys[i]];
        } else {
          return;
        }
      }
      return copy;
    },

    /**
     * Parse rules, normalizing format into: { attribute: [{ name: 'age', value: 3 }] }
     *
     * @param  {object} rules
     * @return {object}
     */
    _parseRules: function (rules) {

      var parsedRules = {};
      rules = this._flattenObject(rules);

      for (var attribute in rules) {

        var rulesArray = rules[attribute];

        this._parseRulesCheck(attribute, rulesArray, parsedRules);
      }
      return parsedRules;


    },

    _parseRulesCheck: function (attribute, rulesArray, parsedRules, wildCardValues) {
      if (attribute.indexOf('*') > -1) {
        this._parsedRulesRecurse(attribute, rulesArray, parsedRules, wildCardValues);
      } else {
        this._parseRulesDefault(attribute, rulesArray, parsedRules, wildCardValues);
      }
    },

    _parsedRulesRecurse: function (attribute, rulesArray, parsedRules, wildCardValues) {
      var parentPath = attribute.substr(0, attribute.indexOf('*') - 1);
      var propertyValue = this._objectPath(this.input, parentPath);

      if (propertyValue) {
        for (var propertyNumber = 0; propertyNumber < propertyValue.length; propertyNumber++) {
          var workingValues = wildCardValues ? wildCardValues.slice() : [];
          workingValues.push(propertyNumber);
          this._parseRulesCheck(attribute.replace('*', propertyNumber), rulesArray, parsedRules, workingValues);
        }
      }
    },

    _parseRulesDefault: function (attribute, rulesArray, parsedRules, wildCardValues) {
      var attributeRules = [];

      if (rulesArray instanceof Array) {
        rulesArray = this._prepareRulesArray(rulesArray);
      }

      if (typeof rulesArray === 'string') {
        rulesArray = rulesArray.split('|');
      }

      for (var i = 0, len = rulesArray.length, rule; i < len; i++) {
        rule = typeof rulesArray[i] === 'string' ? this._extractRuleAndRuleValue(rulesArray[i]) : rulesArray[i];
        if (rule.value) {
          rule.value = this._replaceWildCards(rule.value, wildCardValues);
          this._replaceWildCardsMessages(wildCardValues);
        }

        if (rules_1.isAsync(rule.name)) {
          this.hasAsync = true;
        }
        attributeRules.push(rule);
      }

      parsedRules[attribute] = attributeRules;
    },

    _replaceWildCards: function (path, nums) {

      if (!nums) {
        return path;
      }

      var path2 = path;
      nums.forEach(function (value) {
        if(Array.isArray(path2)){
          path2 = path2[0];
        }
        pos = path2.indexOf('*');
        if (pos === -1) {
          return path2;
        }
        path2 = path2.substr(0, pos) + value + path2.substr(pos + 1);
      });
      if(Array.isArray(path)){
        path[0] = path2;
        path2 = path;
      }
      return path2;
    },

    _replaceWildCardsMessages: function (nums) {
      var customMessages = this.messages.customMessages;
      var self = this;
      Object.keys(customMessages).forEach(function (key) {
        if (nums) {
          var newKey = self._replaceWildCards(key, nums);
          customMessages[newKey] = customMessages[key];
        }
      });

      this.messages._setCustom(customMessages);
    },
    /**
     * Prepare rules if it comes in Array. Check for objects. Need for type validation.
     *
     * @param  {array} rulesArray
     * @return {array}
     */
    _prepareRulesArray: function (rulesArray) {
      var rules = [];

      for (var i = 0, len = rulesArray.length; i < len; i++) {
        if (typeof rulesArray[i] === 'object') {
          for (var rule in rulesArray[i]) {
            rules.push({
              name: rule,
              value: rulesArray[i][rule]
            });
          }
        } else {
          rules.push(rulesArray[i]);
        }
      }

      return rules;
    },

    /**
     * Determines if the attribute is supplied with the original data object.
     *
     * @param  {array} attribute
     * @return {boolean}
     */
    _suppliedWithData: function (attribute) {
      return this.input.hasOwnProperty(attribute);
    },

    /**
     * Extract a rule and a value from a ruleString (i.e. min:3), rule = min, value = 3
     *
     * @param  {string} ruleString min:3
     * @return {object} object containing the name of the rule and value
     */
    _extractRuleAndRuleValue: function (ruleString) {
      var rule = {},
        ruleArray;

      rule.name = ruleString;

      if (ruleString.indexOf(':') >= 0) {
        ruleArray = ruleString.split(':');
        rule.name = ruleArray[0];
        rule.value = ruleArray.slice(1).join(":");
      }

      return rule;
    },

    /**
     * Determine if attribute has any of the given rules
     *
     * @param  {string}  attribute
     * @param  {array}   findRules
     * @return {boolean}
     */
    _hasRule: function (attribute, findRules) {
      var rules = this.rules[attribute] || [];
      for (var i = 0, len = rules.length; i < len; i++) {
        if (findRules.indexOf(rules[i].name) > -1) {
          return true;
        }
      }
      return false;
    },

    /**
     * Determine if attribute has any numeric-based rules.
     *
     * @param  {string}  attribute
     * @return {Boolean}
     */
    _hasNumericRule: function (attribute) {
      return this._hasRule(attribute, this.numericRules);
    },

    /**
     * Determine if rule is validatable
     *
     * @param  {Rule}   rule
     * @param  {mixed}  value
     * @return {boolean}
     */
    _isValidatable: function (rule, value) {
      if (rules_1.isImplicit(rule.name)) {
        return true;
      }

      return this.getRule('required').validate(value);
    },

    /**
     * Determine if we should stop validating.
     *
     * @param  {string} attribute
     * @param  {boolean} rulePassed
     * @return {boolean}
     */
    _shouldStopValidating: function (attribute, rulePassed) {

      var stopOnAttributes = this.stopOnAttributes;
      if (typeof stopOnAttributes === 'undefined' || stopOnAttributes === false || rulePassed === true) {
        return false;
      }

      if (stopOnAttributes instanceof Array) {
        return stopOnAttributes.indexOf(attribute) > -1;
      }

      return true;
    },

    /**
     * Set custom attribute names.
     *
     * @param {object} attributes
     * @return {void}
     */
    setAttributeNames: function (attributes$$1) {
      this.messages._setAttributeNames(attributes$$1);
    },

    /**
     * Set the attribute formatter.
     *
     * @param {fuction} func
     * @return {void}
     */
    setAttributeFormatter: function (func) {
      this.messages._setAttributeFormatter(func);
    },

    /**
     * Get validation rule
     *
     * @param  {string} name
     * @return {Rule}
     */
    getRule: function (name) {
      return rules_1.make(name, this);
    },

    /**
     * Stop on first error.
     *
     * @param  {boolean|array} An array of attributes or boolean true/false for all attributes.
     * @return {void}
     */
    stopOnError: function (attributes$$1) {
      this.stopOnAttributes = attributes$$1;
    },

    /**
     * Determine if validation passes
     *
     * @param {function} passes
     * @return {boolean|undefined}
     */
    passes: function (passes) {
      var async$$1 = this._checkAsync('passes', passes);
      if (async$$1) {
        return this.checkAsync(passes);
      }
      return this.check();
    },

    /**
     * Determine if validation fails
     *
     * @param {function} fails
     * @return {boolean|undefined}
     */
    fails: function (fails) {
      var async$$1 = this._checkAsync('fails', fails);
      if (async$$1) {
        return this.checkAsync(function () {}, fails);
      }
      return !this.check();
    },

    /**
     * Check if validation should be called asynchronously
     *
     * @param  {string}   funcName Name of the caller
     * @param  {function} callback
     * @return {boolean}
     */
    _checkAsync: function (funcName, callback) {
      var hasCallback = typeof callback === 'function';
      if (this.hasAsync && !hasCallback) {
        throw funcName + ' expects a callback when async rules are being tested.';
      }

      return this.hasAsync || hasCallback;
    }

  };

  /**
   * Set messages for language
   *
   * @param {string} lang
   * @param {object} messages
   * @return {this}
   */
  Validator$1.setMessages = function (lang$$1, messages) {
    lang._set(lang$$1, messages);
    return this;
  };

  /**
   * Get messages for given language
   *
   * @param  {string} lang
   * @return {Messages}
   */
  Validator$1.getMessages = function (lang$$1) {
    return lang._get(lang$$1);
  };

  /**
   * Set default language to use
   *
   * @param {string} lang
   * @return {void}
   */
  Validator$1.useLang = function (lang$$1) {
    this.prototype.lang = lang$$1;
  };

  /**
   * Get default language
   *
   * @return {string}
   */
  Validator$1.getDefaultLang = function () {
    return this.prototype.lang;
  };

  /**
   * Set the attribute formatter.
   *
   * @param {fuction} func
   * @return {void}
   */
  Validator$1.setAttributeFormatter = function (func) {
    this.prototype.attributeFormatter = func;
  };

  /**
   * Stop on first error.
   *
   * @param  {boolean|array} An array of attributes or boolean true/false for all attributes.
   * @return {void}
   */
  Validator$1.stopOnError = function (attributes$$1) {
    this.prototype.stopOnAttributes = attributes$$1;
  };

  /**
   * Register custom validation rule
   *
   * @param  {string}   name
   * @param  {function} fn
   * @param  {string}   message
   * @return {void}
   */
  Validator$1.register = function (name, fn, message) {
    var lang$$1 = Validator$1.getDefaultLang();
    rules_1.register(name, fn);
    lang._setRuleMessage(lang$$1, name, message);
  };

  /**
   * Register custom validation rule
   *
   * @param  {string}   name
   * @param  {function} fn
   * @param  {string}   message
   * @return {void}
   */
  Validator$1.registerImplicit = function (name, fn, message) {
    var lang$$1 = Validator$1.getDefaultLang();
    rules_1.registerImplicit(name, fn);
    lang._setRuleMessage(lang$$1, name, message);
  };

  /**
   * Register asynchronous validation rule
   *
   * @param  {string}   name
   * @param  {function} fn
   * @param  {string}   message
   * @return {void}
   */
  Validator$1.registerAsync = function (name, fn, message) {
    var lang$$1 = Validator$1.getDefaultLang();
    rules_1.registerAsync(name, fn);
    lang._setRuleMessage(lang$$1, name, message);
  };

  /**
   * Register asynchronous validation rule
   *
   * @param  {string}   name
   * @param  {function} fn
   * @param  {string}   message
   * @return {void}
   */
  Validator$1.registerAsyncImplicit = function (name, fn, message) {
    var lang$$1 = Validator$1.getDefaultLang();
    rules_1.registerAsyncImplicit(name, fn);
    lang._setRuleMessage(lang$$1, name, message);
  };

  /**
   * Register validator for missed validation rule
   *
   * @param  {string}   name
   * @param  {function} fn
   * @param  {string}   message
   * @return {void}
   */
  Validator$1.registerMissedRuleValidator = function(fn, message) {
    rules_1.registerMissedRuleValidator(fn, message);
  };

  var validator = Validator$1;

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

  var Aire = /*#__PURE__*/Object.freeze({
    configure: configure,
    setRenderer: setRenderer,
    supported: supported,
    connect: connect
  });

  window.Validator = validator;
  window.Aire = Aire;

}());
