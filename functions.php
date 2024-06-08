<?php

    /* Include main framework file */
    require_once(get_template_directory() . '/library/loader.php');

function SearchFilter($query) {
  if ($query->is_search) {
    $query->set('post_type', 'pixad-autos');
  }
  return $query;
}
add_filter('pre_get_posts','SearchFilter');




function numerki ($godzina, $arr1, $arr2, $arr3, $arr4, $arr5, $arr6, $arr7, $arr8) {

    $return = array();

    if(in_array($godzina, $arr1)) {
        array_push($return, "D");
    }
    if(in_array($godzina, $arr2)) {
        array_push($return, "d");
    }
    if(in_array($godzina, $arr3)) {
        array_push($return, "x");
    }
    if(in_array($godzina, $arr4)) {
        array_push($return, "w");
    }
    if(in_array($godzina, $arr5)) {
        array_push($return, "n");
    }
    if(in_array($godzina, $arr6)) {
        array_push($return, "S");
    }
    if(in_array($godzina, $arr7)) {
        array_push($return, "1");
    }
    if(in_array($godzina, $arr8)) {
        array_push($return, "S, 1");
    }


    $return = array_unique($return);


    usort($return, function($a, $b) {
        return (strtotime($a) > strtotime($b));
    });

    $return_final ="";

    foreach($return as $char) {
        $return_final.=', '.$char;
    }

    $return_final = substr($return_final,1,strlen($return_final));



    return $return_final;
}

