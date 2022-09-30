



<br>

<div class="container" id="topBtn">

    <div class="btn-group">
        <button type="button" style="margin: 0 40px" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo $chapter ?>
        </button>
        <div class="dropdown-menu">
            <?php 
            // dd($chapters);
                foreach($chapters as $isi){
                    $link = base_url('read').'/'.$manga.'/'.$isi['chapters'];
                    echo "<a class='dropdown-item' href='$link'>{$isi['chapters']}</a>";
                }
            
            ?>
        </div>
        <?php 
        if($chapter>1){
            $prev = $chapter -1;
            $link = base_url('read').'/'.$manga.'/'.$prev;
            echo <<<EOT
            <a href="$link">
            <button type="button" class="btn btn-danger">Previous Chapter</button>
            </a>
            EOT;
        }
        
        if($chapter<$total){
            $next = $chapter +1;
                $link = base_url('read').'/'.$manga.'/'.$next;
            echo <<<EOT
            <a href="$link">
                <button type="button" style="margin:0 40px" class="btn btn-danger">Next Chapter</button>
            </a>
            EOT;
        }
        ?>
    </div>
    <?php
        foreach($files as $file){
            $next = $counter + 1;
            $location =base_url('manga').'/'.$src.'/'.$file;
            echo <<<EOT
            <a href="#{$next}" id="{$counter}"><img src="$location" class="img-fluid mx-auto d-block" style="padding-left: 40px; padding-right: 40px; padding-top: 20px; padding-bottom: 40px;"></a>
            EOT;
            $counter++;
        }

    ?>
    <a href="#topBtn" id="toTopBtn" class="cd-top text-replace js-cd-top cd-top--is-visible cd-top--fade-out" data-abc="true"></a>
</div>