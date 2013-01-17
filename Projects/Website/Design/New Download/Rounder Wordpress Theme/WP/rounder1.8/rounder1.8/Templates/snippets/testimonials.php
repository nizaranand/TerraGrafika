{if !empty($options->testimonialsText)}
    {if $show == 'true' or $show == '1' or $show == 'yes'}
    <section class="section testimonials entry-content">
        <div class="testimonials-container">
            <div class="testimonials defaultContentWidth clearfix">
                <p>{!$options->testimonialsText}</p>
            </div>
            <style type="text/css" scoped="scoped">
                .section.testimonials .testimonials-container   { background-color: {!$options->testimonialsBgColor}; }
                .section.testimonials                           { color: {!$options->testimonialsColor}; }
                .section.testimonials a,
                .section.testimonials a:hover,
                .section.testimonials a:visited                 { color: {!$options->testimonialsLinkColor}; }
            </style>
        </div>
        <div class="rule-double">&nbsp;</div>
    </section>
    {/if}
{/if}