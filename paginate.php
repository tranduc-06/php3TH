<nav aria-label="Page navigation example">
  <ul class="pagination">
      <li class="page-item"><a class="page-link" href="?per_page=4&page=1">Previous</a></li>
      <?php for ($num = 1 ; $num <= $total_page; $num ++) { ?>
        <?php if ($num != $current_page) { ?>
        <li class="page-item"><a class="page-link" href="?per_page=<?=$item_per_page?>&page=<?=$num?>"><?=$num?></a></li>
        <?php } else {?>
            <strong class="page-link"> <?=$num?> </strong>
        <?php } ?>

      <?php } ?>

    <li class="page-item"><a class="page-link" href="?per_page=4&page=2">Next</a></li>
  </ul>
</nav>