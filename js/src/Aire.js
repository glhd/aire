'use strict';

// FIXME:
Validator.registerMissedRuleValidator(() => true, '');

const resolveElement = (target) => {
	if ('string' === typeof target) {
		return document.querySelector(target);
	}
	
	return target;
};

const getData = (form, only) => {
	const formData = new FormData(form);
	const values = {};
	
	for (let [key, value] of formData.entries()) {
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
	
	return values;
};

let config = {
	'templates': {
		'error': {
			'prefix': '<li>',
			'suffix': '</li>',
		},
	},
	'classnames': {
		'none': {},
		'valid': {},
		'invalid': {},
	},
};

export const configure = (customConfig) => {
	config = customConfig;
	console.log(config);
};

// TODO: We probably need to memoize the dom references
const defaultRenderer = (form, errors = {}, data = {}) => {
	form.querySelectorAll('[data-aire-group-for]')
		.forEach($group => {
			const name = $group.dataset.aireGroupFor;
			const fails = (name in errors);
			const passes = !fails && (name in data);
			const $errors = $group.querySelector(['[data-aire-errors]']);
			
			const { templates, classnames } = config;
			const targets = [
				...Object.keys(classnames.none),
				...Object.keys(classnames.valid),
				...Object.keys(classnames.invalid),
			]
				.filter((key, index, targets) => targets.indexOf(key) === index)
				.map(key => {
					return {
						key,
						$target: $group.querySelector(key),
					}
				});
			
			targets.forEach(({ key, $target }) => {
				if (!$target) {
					return;
				}
				
				if (key in classnames.valid) {
					if (passes) {
						$target.classList.add(...classnames.valid[key].split(' '));
					} else {
						$target.classList.remove(...classnames.valid[key].split(' '));
					}
				}
				
				if (key in classnames.invalid) {
					if (fails) {
						$target.classList.add(...classnames.invalid[key].split(' '));
					} else {
						$target.classList.remove(...classnames.invalid[key].split(' '));
					}
				}
				
				if (key in classnames.none) {
					if (!passes && !fails) {
						$target.classList.add(...classnames.none[key].split(' '));
					} else {
						$target.classList.remove(...classnames.none[key].split(' '));
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
				$errors.innerHTML = errors[name].map(message => `${ templates.error.prefix }${ message }${ templates.error.suffix }`).join('');
			}
		});
};

let renderer = defaultRenderer;

export const setRenderer = (customRenderer) => {
	renderer = customRenderer;
};

export const supported = (
	'undefined' !== typeof FormData
	&& 'getAll' in FormData.prototype
);

export const connect = (target, rules = {}) => {
	if (!supported) {
		return null;
	}
	
	const form = resolveElement(target);
	
	let validator;
	let connected = true;
	
	const touched = new Set();
	
	const touch = (e) => {
		const name = e.target.getAttribute('name');
		if (name) {
			touched.add(name.replace(/\[]$/, ''));
		}
	};
	
	let debounce;
	const run = (e) => {
		if ('undefined' !== typeof e && 'target' in e) {
			touch(e);
		}
		
		let latestRun = 0;
		
		clearTimeout(debounce);
		debounce = setTimeout(() => {
			validator = new Validator(getData(form, touched), rules);
			
			// Because some validators may run async, we'll store a reference
			// to the run "id" so that we can cancel the callbacks if another
			// validation started before the callbacks were fired
			const activeRun = ++latestRun;
			
			const passes = () => {
				if (connected && activeRun === latestRun) {
					renderer(form, {}, validator.input);
				}
			};
			
			const fails = () => {
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
	
	const disconnect = () => {
		connected = false;
		clearTimeout(debounce);
		form.removeEventListener('change', run);
		form.removeEventListener('keyup', run);
		form.removeEventListener('focus', touch);
	};
	
	return {
		get valid() {
			return 'undefined' !== typeof validator
				&& 0 === Object.keys(validator.errors.all()).length;
		},
		run,
		disconnect,
	};
};
