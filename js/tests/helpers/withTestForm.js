
const fs = require('fs');
const path = require('path');
const puppeteer = require('puppeteer');

const html = fs.readFileSync(path.resolve(__dirname, '..', 'test-form.html'), 'utf8');
const javascript = path.resolve(__dirname, '..', '..', 'dist', 'aire.js');

async function withTestForm(t, run) {
	const browser = await puppeteer.launch();
	const page = await browser.newPage();
	
	await page.setContent(html, { waitUntil: 'load' });
	await page.addScriptTag({ path: javascript });
	
	try {
		await run(t, page);
	} finally {
		await page.close();
		await browser.close();
	}
}

module.exports = withTestForm;