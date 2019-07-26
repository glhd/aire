<?php /** @var string $title */ ?>
<?php /** @var string $component */ ?>
<?php /** @var \Illuminate\View\Factory $__env */ ?>

<div class="border rounded my-12 relative">
	<h2 class="m-0 px-6 py-3 border-b text-salmon">
		{{ $title }}
	</h2>
	
	<div id="component-{{ $component }}" class="flex items-stretch max-w-full">
		
		<div class="w-1/2 relative flex items-center bg-gray-100 overflow-x-auto">
			<pre class="my-0 border-0 rounded-none" style="overflow: visible"><code class="language-php"><?php
					$src = file_get_contents($__env->getFinder()->find("components.{$component}"));
					$src = trim($src);
					// $src = preg_replace('/^\s*<\?php\s*echo e\((.*?)\);\s*/is', '$1;', $src);
					$src = preg_replace('/^\s*<\?php\s*/i', '', $src);
					$src = preg_replace('/echo e\(([^;]+)\);/ms', '$1;', $src);
					$src = str_replace("\t", '  ', $src);
					echo e($src);
					?></code></pre>
		</div>
		
		<div class="w-1/2 border-l p-6 flex items-center">
			<div class="flex-1">
				@include("components.{$component}")
			</div>
		</div>
	
	</div>
</div>
