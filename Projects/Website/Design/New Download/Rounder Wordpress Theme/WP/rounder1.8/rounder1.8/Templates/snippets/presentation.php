{if $show == 'true' or $show == '1' or $show == 'yes'}
{if $pictures}
<section class="section presentation entry-content" data-effect="{$options->presentationEffect}">

    <div class="pictures-preload" style="display: none;">
        {foreach $pictures as $picture}
        <img src="{!$picture->thumbnailSrc}" alt="{$picture->post_title}" />
        {/foreach}
    </div>

    <div class="picture">
            <a href="{$pictures[0]->options->link}"><img class="img" src="{$pictures[0]->thumbnailSrc}" alt="" /></a>
    </div>

    <div class="cont">

        <h2>{$options->presentationTitle}</h2>

        <div class="picture-buttons clearfix">

            {foreach $pictures as $picture}
            <div class="pic-item {if $iterator->first}active{/if}">

                <h3>{$picture->title}</h3>

                <div class="item-picture" style="display: none;">{!$picture->thumbnailSrc}</div>
                <div class="item-description" style="display: none;">{!$picture->options->description}</div>
                <div class="item-link" style="display: none;">{!$picture->options->link}</div>

            </div><!-- /.item -->
            {/foreach}

        </div>

        <div class="description">
            {!$pictures[0]->options->description}
        </div>

    </div>

<div class="rule-double">&nbsp;</div>
</section>
{/if}
{/if}