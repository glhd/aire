'use strict';

import Validator from 'validatorjs';
import en from 'validatorjs/src/lang/en';
import * as Aire from './Aire';

Validator.setMessages('en', en);

window.Validator = Validator;
window.Aire = Aire;
