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
		$this->mapCodeBlocks();
		
		return $this->crawler->html();
	}
	
	protected function mapCodeBlocks() : self
	{
		foreach ($this->crawler->filter('pre > code') as $node) {
			$node->setAttribute('class', 'language-php');
		}
		
		return $this;
	}
}
