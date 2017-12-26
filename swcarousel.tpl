<div class="swcarousel-cont">
    <div class="container">
        <div id="swcarousel" class="owl-carousel owl-theme swcarousel swcarousel-cont__box">
            {foreach $images as $image}
                <div class="item swcarousel-cont__item">
                    <a href="{$image.url}">
                        <img class="swcarousel-cont__img" src="{$base_uri}/{$image.src}"/>
                    </a>
                </div>
            {/foreach}
        </div>
    </div>
</div>

<script type="text/javascript">
    {literal}
    $('#swcarousel').owlCarousel({
        loop: true,
        autoplay: {/literal}{$autoplay}{literal},
        margin: 20,
        nav: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            }
        }
    });
    $(".owl-prev").html('<i class="icon-chevron-left"></i>');
    $(".owl-next").html('<i class="icon-chevron-right"></i>');
    {/literal}
</script>