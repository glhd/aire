import test from 'ava';
import withTestForm from './helpers/withTestForm';

test('window.Aire is defined', withTestForm, async (t, page) => {
	const typeof_aire = await page.evaluate(() => {
		return typeof(window.Aire);
	});
	
	t.true('function' === typeof_aire);
});
