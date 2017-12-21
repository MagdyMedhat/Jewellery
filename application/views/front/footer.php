<aside id="asideNav">
  <div class="container_16">
    <div class="slideCont grid_16">
      <div id="overlay-open"><a href="#" class="close"><span class="ex">Expand</span><span class="mi">Minimize</span></a></div>
      <div id="tabs" class="tabs clearfix">
        <ul>
            <?php $category_number = 1; ?>
            <?php foreach($categories as $key => $value): ?>
            <li><a href="#tabs-<?php echo $category_number; ?>"><?php echo $key; ?></a></li>
            <?php $category_number++; ?>
            <?php endforeach; ?>
        </ul>
        
        <?php $category_number = 1; ?>
        <?php foreach($categories as $key => $value): ?>
            <div id="tabs-<?php echo $category_number; ?>">
                <ul class="slide">
                    <ul>
                        <?php $deal_count = 0; ?>
                        <?php foreach($value as $deal): ?>
                        <?php if($deal_count % 20 == 0): ?>
                            </ul>
                            <ul>
                        <?php endif; ?>
                                <li><a href="<?php echo site_url("web/deal_open/$deal[id]"); ?>"><img src="<?php echo site_url() . "uploads/deals_logos/" . $deal['image']; ?>" width="166" height="86"></a></li>
                        <?php $deal_count++; ?>
                        <?php endforeach; ?>
                    </ul>
                </ul>
            </div>
        <?php $category_number++; ?>
        <?php endforeach; ?>
          
      </div>
    </div>
  </div>
</aside>
<footer id="footer">
  <div class="container_16">
    <p class="fl">All copyrights reserved, jewellery &copy;</p>
    <p class="fr">Powered by ZeroWire Labs &copy;</p>
  </div>
</footer>
</body>
</html>