'use strict';

import Validator from 'validatorjs';

export default class Aire {
	constructor(form) {
		this.form = form;
		this.fields = document.querySelectorAll('[data-validate="true"]');
	}
	
	validate() {
		const validator = new Validator();
	}
	
	debug() {
		console.log(this.form, this.fields);
	}
}
