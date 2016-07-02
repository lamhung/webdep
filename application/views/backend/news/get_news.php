<?php 
    echo count($records);
    foreach($records as $record)
    {
        
        echo $record->href;
        //echo $title->href;
        //echo $title;
        //echo $a = $title->find('a', 0);
        //echo $a->attr['title'];
        echo "</hr>";
    }

    
?>

<hr>