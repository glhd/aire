
const fs = require('fs');
const path = require('path');
const puppeteer = require('puppeteer');

const html = fs.readFileSync(path.resolve(__dirname, '..', 'test-form.html'), 'utf8');

const debugOptions = {
	headless: false,
	slowMo: 250,
	devtools: true,
};

const options = {};

async function withTestForm(t, run) {
	const browser = await puppeteer.launch(options);
	const page = await browser.newPage();
	
	await page.setContent(html, { waitUntil: 'load' });
	
	try {
		await run(t, page);
	} finally {
		await page.close();
		await browser.close();
	}
}

module.exports = withTestForm;
