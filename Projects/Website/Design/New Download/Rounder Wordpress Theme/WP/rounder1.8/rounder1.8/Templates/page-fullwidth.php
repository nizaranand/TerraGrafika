{extends $layout}


{var $sectionsOrder = isset($post->options('sections-order')->overrideGlobal) ? $post->options('sections-order')->order : null}


{block content}

{if trim($post->content) != ""}
<section class="section content-section">

<div id="container" class="subpage clearfix onecolumn">

	<div id="content" class="entry-content" role="main">
		<div class="content-wrapper">

			<header class="entry-title clearfix">
				{include snippets/header-icon.php}
				<h1>{$post->title}</h1>
				<span class="breadcrumbs">{__ 'You are here:'} {breadcrumbs}</span>
			</header>

			{!$post->content}

		</div> <!-- /.content-wrapper -->

		{include comments.php, closeable => $themeOptions->general->closeComments, defaultState => $themeOptions->general->defaultPosition}

	</div> <!-- /#content -->

</div> <!-- /#container -->

<div class="rule-double">&nbsp;</div>

</section>	
{/if}

{/block}


{? isset($post->options('slider')->overrideGlobal) ? $slider = 'slider' : $slider = 'xa'}
{define $slider}
	{include snippets/slider.php, options => $post->options('slider')}
{/define}

{? isset($post->options('testimonials')->overrideGlobal) ? $sectionB = 'sectionB' : $sectionB = 'xb'}
{define $sectionB}
	{include snippets/testimonials.php, show => $post->options('testimonials')->showTestimonials, options => $post->options('testimonials')}
{/define}

{? isset($post->options('service-boxes')->overrideGlobal) ? $sectionC = 'sectionC' : $sectionC = 'xc'}
{define $sectionC}
	{include snippets/services-boxes.php, show => $post->options('service-boxes')->showServiceBoxes, boxes => $site->create('service-box', $post->options('service-boxes')->category)}
{/define}

{? isset($post->options('presentation')->overrideGlobal) ? $sectionD = 'sectionD' : $sectionD = 'xd'}
{define $sectionD}
	{include snippets/presentation.php, show => $post->options('presentation')->showPresentation, options => $post->options('presentation'), pictures => $site->create('presentation', $post->options('presentation')->presentationType) }
{/define}