require=(function(){function r(e,n,t){function o(i,f){if(!n[i]){if(!e[i]){var c="function"==typeof require&&require;if(!f&&c)return c(i,!0);if(u)return u(i,!0);var a=new Error("Cannot find module '"+i+"'");throw a.code="MODULE_NOT_FOUND",a}var p=n[i]={exports:{}};e[i][0].call(p.exports,function(r){var n=e[i][1][r];return o(n||r)},p,p.exports,r,e,n,t)}return n[i].exports}for(var u="function"==typeof require&&require,i=0;i<t.length;i++)o(t[i]);return o}return r})()({"./lang/mk":[function(require,module,exports){
module.exports = {
  accepted: 'Полето :attribute мора да биде прифатено.',
  active_url: 'Полето :attribute не е валиден URL.',
  after: 'Полето :attribute мора да биде датум после :date.',
  after_or_equal: 'The :attribute must be a date after or equal to :date.',
  alpha: 'Полето :attribute може да содржи само букви.',
  alpha_dash: 'Полето :attribute може да содржи само букви, цифри, долна црта и тире.',
  alpha_num: 'Полето :attribute може да содржи само букви и цифри.',
  attributes: {},
  array: 'Полето :attribute мора да биде низа.',
  before: 'Полето :attribute мора да биде датум пред :date.',
  before_or_equal: 'The :attribute must be a date before or equal to :date.',
  between: {
    numeric: 'Полето :attribute мора да биде помеѓу :min и :max.',
    file: 'Полето :attribute мора да биде помеѓу :min и :max килобајти.',
    string: 'Полето :attribute мора да биде помеѓу :min и :max карактери.',
    array: 'Полето :attribute мора да има помеѓу :min - :max карактери.'
  },
  boolean: 'The :attribute field must be true or false',
  confirmed: 'Полето :attribute не е потврдено.',
  date: 'Полето :attribute не е валиден датум.',
  date_format: 'Полето :attribute не е во формат :format.',
  different: 'Полињата :attribute и :other треба да се различни.',
  digits: 'Полето :attribute треба да има :digits цифри.',
  digits_between: 'Полето :attribute треба да има помеѓу :min и :max цифри.',
  dimensions: 'The :attribute has invalid image dimensions.',
  distinct: 'The :attribute field has a duplicate value.',
  email: 'Полето :attribute не е во валиден формат.',
  exists: 'Избранато поле :attribute веќе постои.',
  file: 'The :attribute must be a file.',
  filled: 'Полето :attribute е задолжително.',
  gt: {
    numeric: 'The :attribute must be greater than :value.',
    file: 'The :attribute must be greater than :value kilobytes.',
    string: 'The :attribute must be greater than :value characters.',
    array: 'The :attribute must have more than :value items.'
  },
  gte: {
    numeric: 'The :attribute must be greater than or equal :value.',
    file: 'The :attribute must be greater than or equal :value kilobytes.',
    string: 'The :attribute must be greater than or equal :value characters.',
    array: 'The :attribute must have :value items or more.'
  },
  image: 'Полето :attribute мора да биде слика.',
  in: 'Избраното поле :attribute е невалидно.',
  in_array: 'The :attribute field does not exist in :other.',
  integer: 'Полето :attribute мора да биде цел број.',
  ip: 'Полето :attribute мора да биде IP адреса.',
  ipv4: 'The :attribute must be a valid IPv4 address.',
  ipv6: 'The :attribute must be a valid IPv6 address.',
  json: 'The :attribute must be a valid JSON string.',
  lt: {
    numeric: 'The :attribute must be less than :value.',
    file: 'The :attribute must be less than :value kilobytes.',
    string: 'The :attribute must be less than :value characters.',
    array: 'The :attribute must have less than :value items.'
  },
  lte: {
    numeric: 'The :attribute must be less than or equal :value.',
    file: 'The :attribute must be less than or equal :value kilobytes.',
    string: 'The :attribute must be less than or equal :value characters.',
    array: 'The :attribute must not have more than :value items.'
  },
  max: {
    numeric: 'Полето :attribute мора да биде помало од :max.',
    file: 'Полето :attribute мора да биде помало од :max килобајти.',
    string: 'Полето :attribute мора да има помалку од :max карактери.',
    array: 'Полето :attribute не може да има повеќе од :max карактери.'
  },
  mimes: 'Полето :attribute мора да биде фајл од типот: :values.',
  mimetypes: 'Полето :attribute мора да биде фајл од типот: :values.',
  min: {
    numeric: 'Полето :attribute мора да биде минимум :min.',
    file: 'Полето :attribute мора да биде минимум :min килобајти.',
    string: 'Полето :attribute мора да има минимум :min карактери.',
    array: 'Полето :attribute мора да има минимум :min карактери.'
  },
  not_in: 'Избраното поле :attribute е невалидно.',
  not_regex: 'The :attribute format is invalid.',
  numeric: 'Полето :attribute мора да биде број.',
  present: 'The :attribute field must be present.',
  regex: 'Полето :attribute е во невалиден формат.',
  required: 'Полето :attribute е задолжително.',
  required_if: 'Полето :attribute е задолжително, кога :other е :value.',
  required_unless: 'The :attribute field is required unless :other is in :values.',
  required_with: 'Полето :attribute е задолжително, кога е внесено :values.',
  required_with_all: 'The :attribute field is required when :values is present.',
  required_without: 'Полето :attribute е задолжително, кога не е внесено :values.',
  required_without_all: 'The :attribute field is required when none of :values are present.',
  same: 'Полињата :attribute и :other треба да совпаѓаат.',
  size: {
    numeric: 'Полето :attribute мора да биде :size.',
    file: 'Полето :attribute мора да биде :size килобајти.',
    string: 'Полето :attribute мора да има :size карактери.',
    array: 'Полето :attribute мора да има :size карактери.'
  },
  string: 'The :attribute must be a string.',
  timezone: 'The :attribute must be a valid zone.',
  unique: 'Полето :attribute веќе постои.',
  uploaded: 'The :attribute failed to upload.',
  url: 'Полето :attribute не е во валиден формат.'
};

},{}]},{},[]);
