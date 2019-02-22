'use strict';

// FIXME:
Validator.registerMissedRuleValidator(() => true, '');

const resolveElement = (target) => {
	if ('string' === typeof target) {
		return document.querySelector(target);
	}
	
	return target;
};

const getData = (form) => {
	const formData = new FormData(form);
	const values = {};
	
	for (let [key, value] of formData.entries()) {
		key = key.replace(/\[]$/, '');
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

// FIXME: This still needs major perf work
// FIXME: We need to handle multiple values
// FIXME: We should be able to apply some validation even when an item is not grouped
const defaultRenderer = ({ form, errors, data, refs, touched }) => {
	const { templates, classnames } = config;
	
	Object.keys(data).forEach(name => {
		// Stop if we don't have refs to this field
		if (!(name in refs)) {
			return;
		}
		
		const fails = touched.has(name) && (name in errors);
		const passes = touched.has(name) && !fails && (name in data);
		
		if ('errors' in refs[name]) {
			if (passes) {
				refs[name].errors[0].classList.add('hidden');
				refs[name].errors[0].innerHTML = '';
			} else if (fails) {
				// TODO: Maybe hide help text
				refs[name].errors[0].classList.remove('hidden');
				refs[name].errors[0].innerHTML = errors[name].map(message => `${ templates.error.prefix }${ message }${ templates.error.suffix }`).join('');
			}
		}
		
		Object.entries(refs[name]).forEach(([name, elements]) => {
			elements.forEach(element => {
				if (name in classnames.valid) {
					if (passes) {
						element.classList.add(...classnames.valid[name].split(' '));
					} else {
						element.classList.remove(...classnames.valid[name].split(' '));
					}
				}
				
				if (name in classnames.invalid) {
					if (fails) {
						element.classList.add(...classnames.invalid[name].split(' '));
					} else {
						element.classList.remove(...classnames.invalid[name].split(' '));
					}
				}
				
				if (name in classnames.none) {
					if (!passes && !fails) {
						element.classList.add(...classnames.none[name].split(' '));
					} else {
						element.classList.remove(...classnames.none[name].split(' '));
					}
				}
			});
		});
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
	
	const refs = {};
	form.querySelectorAll('[data-aire-component]').forEach(element => {
		if ('aireFor' in element.dataset) {
			const parent = element.dataset.aireFor;
			const component = element.dataset.aireComponent;
			
			refs[parent] = refs[parent] || {};
			
			if (component in refs[parent]) {
				refs[parent][component].push(element);
			} else {
				refs[parent][component] = [element];
			}
		}
	});
	
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
			validator = new Validator(getData(form), rules);
			// Because some validators may run async, we'll store a reference
			// to the run "id" so that we can cancel the callbacks if another
			// validation started before the callbacks were fired
			const activeRun = ++latestRun;
			
			const validated = () => {
				if (connected && activeRun === latestRun) {
					renderer({
						form,
						touched,
						refs,
						data: validator.input,
						errors: validator.errors.all(),
					});
				}
			};
			
			validator.checkAsync(validated, validated);
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
		get data() {
			return 'undefined' === typeof validator
				? getData(form)
				: validator.input;
		},
		run,
		disconnect,
	};
};
