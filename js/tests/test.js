import test from 'ava';
import withTestForm from './helpers/withTestForm';

test('keypress and change events trigger validation', withTestForm, async (t, page) => {
	page.on('console', log => console.log(log.text()));
	
	await page.evaluate(() => window.testSubject = window.Aire.connect('form'));
	
	await page.type('#demo', 'h');
	const keyPressRunCount = await page.evaluate(() => window.testSubject.runCount);
	
	const changeRunCount = await page.evaluate(() => {
		document.querySelector('#demo').blur();
		return window.testSubject.runCount;
	});
	
	t.true(1 === keyPressRunCount);
	t.true(2 === changeRunCount);
});
