<?php

if (!function_exists('backpack_pro_badge')) {
    /**
     * Echo a purple badge to tell the viewer this is a PRO feature.
     *
     * @param string $string
     *
     * @return string
     */
    function backpack_pro_badge(string $string = 'PRO')
    {
        return '<a href="https://backpackforlaravel.com/pricing" target="_blank" class="badge badge-pill bg-primary mx-2" tabindex="-1">'.$string.'</a>';
    }
}

if (!function_exists('backpack_new_badge')) {
    /**
     * Echo a yellow badge to tell the viewer this is a NEW feature.
     *
     * @param string $string
     *
     * @return string
     */
    function backpack_new_badge(string $string = 'NEW')
    {
        return '<span class="badge badge-pill bg-warning mx-2">'.$string.'</span>';
    }
}

if (!function_exists('backpack_free_badge')) {
    /**
     * Echo a green badge to tell the viewer this is a FREE feature.
     *
     * @param string $string
     *
     * @return string
     */
    function backpack_free_badge(string $string = 'FREE')
    {
        return '<span class="badge badge-pill bg-success mx-2">'.$string.'</span>';
    }
}
