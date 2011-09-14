# Hydro - A Language File to HTML Parser

## Huh?  What is it?

I got annoyed with passing variables from my language files, to my controller, to my views, piece by piece by piece.  I figured, why not make use of the existing paradigm in FuelPHP of generating HTML dynamically through the framework and just structure my language files to generate my HTML markup from them?

## Installing

Currently only available as download or clone from Github. Like any other package it must be put in its own 'hydro' dir in the packages dir and added to your app/config/config.php as an always loaded package.

Make sure you put your API key in the config/hydro.php

## Usage

Make sure you have a well formed array of content in a lang file, in this format:

```php
return array(
	'content' => array(
		'meat' => array(
			'h1.intro' => 'This is a heading.',
			'p.intro' => 'This is an intro paragraph.',
			'h2.goals' => 'A subheading',
			'ul' => array(
				'A list item',
				'Another list item'
			), 
		),
		'veggies' => array(
			'about_me' => array(
				'h3' => 'Supporting content',
				'p' => 'Something to say'
			)
		)
	)
);
```

And call it, pass to your view like this in your controller:

```php
Lang::load('home', 'home');
$html = Hydro::parse(
	Lang::line('home.content')
);
$data['page_content'] = $html;	
		
$this->template->content = View::factory('home/index', $data, false);
```

This will pump HTML into your view that looks like this:

```php
<div class="meat">
	<h1 class="intro">This is a heading</h1>
	<p class="intro">This is an intro paragraph.</p>
	<h2 class="goals">A subheading</h2>
	<ul>
		<li>A list item</li>
		<li>Another list item</li>
	</ul>
</div>
<div class="veggies">
	<div class="about_me">
		<h3>Supporting content</h3>
		<p>Something to say</p>
	</div>
</div>
```

As you can see, any array key which does not have a '.' in it and is not a valid HTML tag is automatically assumed to be a div, and a div is created with that key as its class.

You should also note that for tags like <ul>, you don't have to create keys for the children.

The one word of caution, and the one limitation at this point, is that you cannot have multiple occurrences of the same array key.  You'll need to do el.class for each and every paragraph, for example.  A check for a parent with numeric keys could be added if someone wants to help there = ).

Ask me if any questions.  I coded this up in about an hour, so there may be bugs.  Enjoy = )

## LICENSE: 

Copyright (c) 2011 Calvin Froedge

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
