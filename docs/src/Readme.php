<?php

namespace Docs;

use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\File;
use Symfony\Component\DomCrawler\Crawler;

class Readme implements Htmlable
{
	/**
	 * @var Crawler
	 */
	protected $crawler;
	
	public function __construct()
	{
		config()->set('markdown.html_input', 'allow');
		
		$readme_markdown = File::get(__DIR__.'/../../README.md');
		$readme_html = Markdown::convertToHtml($readme_markdown);
		$this->crawler = new Crawler($readme_html);
	}
	
	public function __toString()
	{
		return $this->toHtml();
	}
	
	public function toHtml()
	{
		$this->stripLogo();
		$this->applyTypeClassNames();
		$this->applyListClassNames();
		$this->applyCodeClassNames();
		
		return $this->crawler->html();
	}
	
	protected function stripLogo() : self
	{
		foreach ($this->crawler->filter('img[src$="logo.svg"]') as $node) {
			$node->parentNode->appendChild(
				$node->ownerDocument->createTextNode('Aire')
			);
			$node->parentNode->removeChild($node);
		}
		
		return $this;
	}
	
	protected function applyTypeClassNames() : self
	{
		foreach ($this->crawler->filter('h1') as $node) {
			$node->setAttribute('class', 'text-2xl text-gray-900');
		}
		
		foreach ($this->crawler->filter('h2') as $node) {
			$node->setAttribute('class', 'text-xl text-gray-600 mt-9');
		}
		
		foreach ($this->crawler->filter('h3') as $node) {
			$node->setAttribute('class', 'text-lg text-gray-800 mt-6');
		}
		
		return $this;
	}
	
	protected function applyListClassNames() : self
	{
		foreach ($this->crawler->filter('ul') as $node) {
			$node->setAttribute('class', 'list-disc pl-8 pb-4');
		}
		
		foreach ($this->crawler->filter('ol') as $node) {
			$node->setAttribute('class', 'list-decimal pl-8 pb-4');
		}
		
		return $this;
	}
	
	protected function applyCodeClassNames() : self
	{
		foreach ($this->crawler->filter('pre > code') as $node) {
			$node->setAttribute('class', 'language-php');
		}
		
		return $this;
	}
}
