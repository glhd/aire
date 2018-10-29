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
		$this->mapHeadings()
			->mapParagraphs()
			->mapInlineCode()
			->mapCodeBlocks();
		
		return $this->crawler->html();
	}
	
	protected function mapHeadings() : self
	{
		foreach ($this->crawler->filter('h1') as $node) {
			$node->setAttribute('class', 'mt-6 mb-2 font-semibold text-grey-darkest text-lg');
		}
		
		foreach ($this->crawler->filter('h2, h3, h4') as $node) {
			$node->setAttribute('class', 'mt-4 mb-2 font-semibold text-grey-darkest text-base');
		}
		
		return $this;
	}
	
	protected function mapParagraphs() : self
	{
		foreach ($this->crawler->filter('p') as $node) {
			$node->setAttribute('class', 'my-4 text-base');
		}
		
		return $this;
	}
	
	protected function mapInlineCode() : self
	{
		foreach ($this->crawler->filter('code') as $node) {
			$node->setAttribute('class', 'bg-grey-lightest text-purple-darker inline-block px-1');
		}
		
		return $this;
	}
	
	protected function mapCodeBlocks() : self
	{
		foreach ($this->crawler->filter('pre') as $node) {
			$node->setAttribute('class', 'bg-grey-lightest border rounded-sm p-2');
		}
		
		return $this;
	}
}
