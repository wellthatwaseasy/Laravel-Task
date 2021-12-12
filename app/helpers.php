<?php

    function theme($item)
    {
        $colors = ['pink','blue','red','indigo','purple','green','yellow','gray' ];

        if ($item == 'bg') {
            return 'indigo';
        }
        if ($item == 'text') {
            return 'indigo';
        }
        if ($item == 'border') {
            return 'indigo';
        }
        if ($item == 'error') {
            return 'red';
        }
        if ($item == 'success') {
            return 'green';
        }
    }
?>
