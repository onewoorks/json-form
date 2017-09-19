<?php

$rowItem = array(
    array('columns' => 2,'name' => 'ali',),
    
    
    array('columns' => 1, 'name' => 'abu'//'data' => array('town'=>'selangor'),
        ),
    array('columns' => 3, 'name' => 'malik'));
?>
<?php echo $header; ?>

<?php rows(3, $rowItem); ?>

<?php echo $footer; ?>
<?php

function insideRow($noOfColumns, $data = false) {
    for ($i = 0; $i < $noOfColumns; $i++):
        $col_size = 12 / $noOfColumns;
        echo "<div class='col-sm-$col_size text-center' style='border:1px solid #ccc;'>" . $data . " " . ($i + 1) . "</div>";
    endfor;
}

function rows($noOfRows, $rowItem) {
    for ($i = 0; $i < $noOfRows; $i++):
        echo '<div class="row">' . insideRow($rowItem[$i]['columns']) . '</div>';
    endfor;
}
//echo '<pre>'.print_r($rowItem).'</pre>';
?>