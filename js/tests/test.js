import test from 'ava';
import withTestForm from './helpers/withTestForm';

// test('keypress and change events trigger validation', withTestForm, async (t, page) => {
// 	page.on('console', log => console.log(log.text()));
//
// 	await page.evaluate(() => window.testSubject = window.Aire.connect('form'));
//
// 	await page.type('#demo', 'h');
// 	const keyPressRunCount = await page.evaluate(() => window.testSubject.runCount);
//
// 	const changeRunCount = await page.evaluate(() => {
// 		document.querySelector('#demo').blur();
// 		return window.testSubject.runCount;
// 	});
//
// 	t.true(1 === keyPressRunCount);
// 	t.true(2 === changeRunCount);
// });

test('Aire is initialized after load', withTestForm, async (t, page) => {
	const aire_exists = await page.evaluate(() => ('undefined' !== typeof window.Aire));
	t.true(aire_exists, 'window.Aire should be defined');
});

test('alpha validation rule fails', withTestForm, async (t, page) => {
	await page.type('[name="alpha"]', '1234');
	await page.waitFor(500);
	const html = await page.evaluate(() => document.querySelector('[data-aire-for="alpha"]').innerHTML);
	
	t.true(html.includes('must contain only alphabetic characters'));
});

test('alpha validation rule passes', withTestForm, async (t, page) => {
	await page.type('[name="alpha"]', 'abc');
	await page.waitFor(500);
	const html = await page.evaluate(() => document.querySelector('[data-aire-for="alpha"]').innerHTML);
	
	t.false(html.includes('must contain only alphabetic characters'));
});
