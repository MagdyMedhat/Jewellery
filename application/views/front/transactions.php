<section id="content" class="container_16">
  <table>
    <thead>
      <tr class="odd">
        <td class="column1"></td>
        <th scope="col" abbr="Home">Item </th>
        <th scope="col" abbr="Home Plus">Price</th>
        <th scope="col" abbr="Business">Status</th>
        <th scope="col" abbr="Business Plus">Date</th>
        <th scope="col" abbr="Business Plus">Copoun</th>
      </tr>
    </thead>
    <tbody>
        
        <?php $counter = 1; ?>
        <?php foreach($transactions as $transaction): ?>
        <?php if($counter%2 == 0): ?>
            <tr class="odd">
        <?php else: ?>
            <tr>        
        <?php endif; ?>
            <th scope="row" class="column1"><?php echo $counter; ?></th>
            <td> <?php echo $transaction['item']; ?></td>
            <td> <?php echo $transaction['price']; ?></td>
            <td> <?php echo $transaction['status']; ?></td>
            <td> <?php echo $transaction['date']; ?></td>
            <td> <?php echo $transaction['copoun']; ?></td>
            
            </tr>
        <?php $counter++; endforeach; ?>
    </tbody>
  </table>
</section>
<footer id="footer">
  <div class="container_16">
    <p class="fl">All copyrights reserved, jewellery &copy;</p>
    <p class="fr">Powered by ZeroWire Labs &copy;</p>
  </div>
</footer>
</body>
</html>