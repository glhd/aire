'use strict';

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
		const name = key.replace(/\[]$/, '');
		const multiple = name !== key;
		if (values[name]) {
			if (!(values[name] instanceof Array)) {
				values[name] = [values[name]];
			}
			values[name].push(value);
		} else {
			values[name] = multiple ? [value] : value;
		}
	}
	
	return values;
};

let booted = false;
const boot = () => {
	if (!booted) {
		Validator.registerMissedRuleValidator(() => true, '');
		Validator.useLang('en'); // TODO: Make configurable
	}
	
	booted = true;
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
};

// FIXME: This still needs major perf work
const defaultRenderer = ({ form, errors, data, rules, refs, touched }) => {
	const { templates, classnames } = config;
	
	Object.keys(rules).forEach(name => {
		// Stop if we don't have refs to this field
		if (!(name in refs)) {
			return;
		}
		
		const fails = touched.has(name) 
			&& ('input' in refs[name])
			&& document.activeElement !== refs[name].input[0] 
			&& (name in errors);
		
		const passes = touched.has(name) 
			&& !fails 
			&& (name in data);
		
		if ('errors' in refs[name]) {
			if (passes) {
				refs[name].errors[0].innerHTML = '';
			} else if (fails) {
				refs[name].errors[0].innerHTML = errors[name].map(message => `${ templates.error.prefix }${ message }${ templates.error.suffix }`).join('');
			}
		}
		
		Object.entries(refs[name]).forEach(([name, elements]) => {
			elements.forEach(element => {
				if (name in classnames.valid) {
					const passes_classnames = classnames.valid[name].split(' ');
					if (passes_classnames.length) {
						if (passes) {
							element.classList.add(...passes_classnames);
						} else if (fails) {
							element.classList.remove(...passes_classnames);
						}
					}
				}
				
				if (name in classnames.invalid) {
					const fails_classnames = classnames.invalid[name].split(' ');
					if (fails_classnames.length) {
						if (fails) {
							element.classList.add(...fails_classnames);
						} else if (passes) {
							element.classList.remove(...fails_classnames);
						}
					}
				}
				
				if (name in classnames.none) {
					const none_classnames = classnames.none[name].split(' ');
					if (none_classnames.length) {
						if (!passes && !fails) {
							element.classList.add(...none_classnames);
						} else {
							element.classList.remove(...none_classnames);
						}
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

export const connect = (target, rules = {}, messages = {}, form_request = null) => {
	if (!supported) {
		return null;
	}
	
	boot();
	
	const form = resolveElement(target);
	
	const refs = {};
	const storeRef = (parent, component, element) => {
		refs[parent] = refs[parent] || {};
		refs[parent][component] = refs[parent][component] || [];
		refs[parent][component].push(element);
	};
	
	form.querySelectorAll('[data-aire-component]').forEach(element => {
		if ('aireFor' in element.dataset) {
			const parent = element.dataset.aireFor;
			const component = element.dataset.aireComponent;
			
			// Add the component to the refs
			storeRef(parent, component, element);
			
			// If we have a validation key, let the element also be referenced by it
			if ('aireValidationKey' in element.dataset && component !== element.dataset.aireValidationKey) {
				storeRef(parent, element.dataset.aireValidationKey, element);
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
			const data = getData(form);
			validator = new Validator(data, rules, messages);
			// Because some validators may run async, we'll store a reference
			// to the run "id" so that we can cancel the callbacks if another
			// validation started before the callbacks were fired
			const activeRun = ++latestRun;
			
			// If this is the first run, "touch" anything that has a value
			if (1 === activeRun) {
				Object.entries(data).forEach(([key, value]) => {
					if (null === value || 'undefined' === typeof value || '' === value) {
						return;
					}
					
					if (Array.isArray(value) && 0 === value.length) {
						return;
					}
					
					// Don't mark as touched if it has errors in it
					if (key in refs && 'errors' in refs[key] && refs[key].errors[0].childElementCount > 0) {
						return;
					}
					touched.add(key);
				});
			}
			
			const validated = () => {
				if (connected && activeRun === latestRun) {
					renderer({
						form,
						rules,
						touched,
						refs,
						data,
						errors: validator.errors.all(),
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
	
	const disconnect = () => {
		connected = false;
		clearTimeout(debounce);
		form.removeEventListener('change', run);
		form.removeEventListener('keyup', run);
		form.removeEventListener('blur', touch);
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
		get validator() {
			return validator;
		},
		run,
		disconnect,
	};
};
