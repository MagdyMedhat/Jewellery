<section id="content" class="container_16">
  <article id="mainOfferCont" class="clearfix">
    <section class="grid_10">
      <div class="box_cont posR">
        <div class="mainImageCont loading"><img class="mainImage" src="<?php echo site_url() . "uploads/deals_logos/$deal[image]"; ?>"></div>
        <div class="box_images_btns">
            <?php $image = explode('/', $deal['image']); ?>
            <img src="<?php echo site_url() . "uploads/deals_logos/$image[0]/tile_$image[1]"; ?>" data-src="<?php echo site_url() . "uploads/deals_logos/$deal[image]"; ?>">
            <?php $image = explode('/', $deal['image2']); ?>
            <img src="<?php echo site_url() . "uploads/deals_logos/$image[0]/tile_$image[1]"; ?>" data-src="<?php echo site_url() . "uploads/deals_logos/$deal[image2]"; ?>">
            <?php $image = explode('/', $deal['image3']); ?>
            <img src="<?php echo site_url() . "uploads/deals_logos/$image[0]/tile_$image[1]"; ?>" data-src="<?php echo site_url() . "uploads/deals_logos/$deal[image3]"; ?>">
        </div>
        <div class="info"></div>
        <div class="infoData">
          <div class="pad_10">
              <h2><?php echo $deal['title']; ?></h2>
              <p> <?php echo $deal['description']; ?> </p>
          </div>
        </div>
      </div>
    </section>
    <aside class="grid_6">
      <div class="toolsSection">
        <article class="toolsSectionHeader row">
          <div class="mainContent">
            <h2><?php echo $deal['title']; ?></h2>
            <h3><?php echo $deal['sub_title']; ?></h3>
            <div class="onsale"></div>
          </div>
        </article>
        <footer class="clearfix">
          <div class="priceList">
            <div class="row">
                <h1 class="originalPrice fl">$<?php echo $deal['price']; ?></h1>
              <div class="discount fl">
                <div class="rightA">
                  <div class="srow">Discount</div>
                  <div class="num"><?php echo $deal['discount']; ?>%</div>
                </div>
              </div>
                <h1 class="afterDiscount fr"><?php echo $deal['price'] - ($deal['price'] * $deal['discount'] / 100); ?></h1>
              <div class="clear"></div>
            </div>
            <div class="fl">
              <div class="row">
                <div class="c1">Retail:</div>
                <div class="c2">$<?php echo $deal['price'] * $deal['discount'] / 100; ?></div>
                <div class="clear"></div>
              </div>
              <div class="row">
                <div class="c1">Units Left:</div>
                <div class="c2"><?php echo $deal['unit_left']; ?></div>
                <div class="clear"></div>
              </div>
            </div>
                
            <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" id="payment">
            <input type="hidden" name="cmd" value="_xclick">  
            <input type="hidden" name="business" value="seller_1320057921_biz@live.com">
            <input type="hidden" name="item_name" value="<?php echo $deal['title']; ?>">  
                <input type="hidden" name="item_number" value="none">  
                <input type="hidden" name="amount" value="<?php echo $deal['price'] - ($deal['price'] * $deal['discount'] / 100); ?>">  
                <input type="hidden" name="currency_code" value="USD">  
                <input type="hidden" name="no_shipping" value="1">
                <input type="hidden" name="no_note" value="1">
                
                <input type="hidden" name="return" value="http://zwlhost.com/jewelmenow/web/payment">
                <input type="hidden" name="rm" value="2">
                <input type="hidden" name="cancel_return" value="http://zwlhost.com/jewelmenow/web/payment">
                <input type="hidden" name="image_url" value="<?php echo site_url() . "includes/"; ?>images/Logo.png">
            </form>
              <script>
                  function buy()
                  {
                    var paymentForm =document.getElementById('payment');
                    paymentForm.submit();
                  }
              </script>
            <a href="javascript:buy()" class="buy fr">Buy</a>
          
            <div class="clear"></div>
          </div>
          <div class="text_align_c row">Time Remaining</div>
          
          <?php $date = explode('-', $deal['end_date']); ?>
          <script>
            $(function(){
                    $('#mainOfferCont #timer').countdown({ until: new Date(<?php echo $date['0'];?>,<?php echo $date['1'];?>-1,<?php echo $date['2'];?>) })
            });
        </script>

          <div id="timer" class="clearfix"></div>
        </footer>
      </div>
    </aside>
  </article>
</section>