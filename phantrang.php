<?php
        if($current_page>3){
            $firs_page=1;
        ?>
        <a class="page-item" href="?per_page=<?=$item_per_page?>&page=<?=$firs_page?>">First</a>
            <?php }?>
            
        <?php
        for($num=1;$num<=$totalPage;$num++){?>
            <?php if($num!=$current_page){ ?>
                <?php if ($num>$current_page-3 &&$num<$current_page+3){?>
                    <a class="page-item" href="?per_page=<?=$item_per_page?>&page=<?=$num?>"><?=$num?></a>
        <?php }?>
        <?php }else{ ?></else>
            <strong  class="current-page page-item"><?=$num?></strong>
            <?php }?>
        <?php } 
          if($current_page<$totalPage-3){
              $end_page=$totalPage;
          ?>
          <a class="page-item" href="?per_page=<?=$item_per_page?>&page=<?=$end_page?>">Last</a>
              <?php }?>
        