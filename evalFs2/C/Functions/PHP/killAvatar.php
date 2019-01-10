
<?php
    function killAvatar($avatar){
        /* Set root dir of an artist */
            /* Kill each file in a dir */
                unlink($avatar);
        return true;
    }
?>