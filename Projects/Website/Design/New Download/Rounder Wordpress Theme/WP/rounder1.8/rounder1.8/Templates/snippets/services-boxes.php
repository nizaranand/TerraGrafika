{if $show == 'true' or $show == '1' or $show == 'yes'}
{if $boxes}
<section class="section services entry-content">
	<div class="sboxes-wrap clearfix">
		{var $width  = 1000}
		{var $margin = 45}
		{var $i = 0}
		
		{foreach $boxes as $box}
		{var $i++}
		{/foreach}
		
		{var sboxesWidth = ($width-(($i-1)*$margin))/$i}

		{foreach $boxes as $box}
			
			<div class="clearfix sbox sbox{$iterator->counter} {if $iterator->first}first-sbox{elseif $iterator->last}last-sbox{/if}" 
				style="width: {ifset $box->options->boxWidth}{$box->options->boxWidth}{!$sboxesWidth}px{/ifset};">
				<div class="sbox-wrap">
					<div class="sbox-content clear clearfix">

						<h2 class="title"><a href="{$box->options->boxLink}">
							<span class="title-text">{$box->title}</span>
							<span class="title-icon">
								<span class="mwrap">
									<span class="molecule">
										<span class="p1wrap"><span class="particle1">&nbsp;</span></span>
										<span class="p2wrap"><span class="particle2">&nbsp;</span></span>
										<span class="p3wrap"><span class="particle3">&nbsp;</span></span>
									</span>
									<img src="{$box->thumbnailSrc}" alt="{$box->title}" width="65" height="65" class="ico">
								</span>
							</span>
						</a></h2>
						<p class="left">{$box->options->boxText}</p>
						<!--<a href="{$box->options->boxLink}" class="more">{$box->options->boxMoreText}</a>-->
				    </div>
				</div>
			</div>
		{/foreach}
	</div><!-- end of services -->
	<div class="rule-double">&nbsp;</div>
</section>
{/if}
{/if}