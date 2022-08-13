<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

function getNextSubmenuURL($mainmenu_id, $submenu_id) {
    $submenu_permi = DB::table("tbl_submenu_permi")->select('id')
            ->where("user_id", Auth::User()->id)
            ->where("submenu_id", $submenu_id)
            ->where("mainmenu_id", $mainmenu_id)
            ->get();
    foreach ($submenu_permi as $single_sub) {
        $id = $single_sub->id;
    }

    $next_id = DB::select(DB::raw('SELECT min(`id`) as id FROM `tbl_submenu_permi` WHERE `user_id`=' . Auth::User()->id . ' and `id`> ' . $id . ' And `mainmenu_id`=' . $mainmenu_id));
    foreach ($next_id as $single_id) {
        $id = $single_id->id;
    }
    //  echo $id;
    $submenu_all = DB::table("tbl_submenu_permi")->select('submenu_id')
            ->where("id", $id)
            ->get();
    foreach ($submenu_all as $subm) {
        $submenu_id_1 = $subm->submenu_id;
    }
    // echo $submenu_id_1;
    $submenu_all_url = DB::table("tbl_submenu")->select('submenu_url')
            ->where("submenu_id", $submenu_id_1)
            ->get();
    foreach ($submenu_all_url as $url) {
        $submenu_url = $url->submenu_url;
    }

    $lastWord = substr($submenu_url, strrpos($submenu_url, '/') + 1);
    return $lastWord;
}

//GetTheNextURL
function GetTheNextURL($mainmenu_id, $submenu_id, $baseURL) {
    $submenu_permi = DB::table("tbl_submenu_permi")->select('id')
            ->where("user_id", Auth::User()->id)
            ->where("submenu_id", $submenu_id)
            ->where("mainmenu_id", $mainmenu_id)
            ->get();
    foreach ($submenu_permi as $single_sub) {
        $id = $single_sub->id;
    }

    $next_id = DB::select(DB::raw('SELECT min(`id`) as id FROM `tbl_submenu_permi` WHERE `user_id`=' . Auth::User()->id . ' and `id`> ' . $id . ' And `mainmenu_id`=' . $mainmenu_id));
    foreach ($next_id as $single_id) {
        $id = $single_id->id;
    }

    if (empty($id)) {
        if($mainmenu_id == 2){
            $lastWord = $baseURL.'/deduction/mainPage';
        }
        else if($mainmenu_id == 3){
            $lastWord = $baseURL.'/otherdetails/mainPage';
        }
        else if($mainmenu_id == 4){
            $lastWord = $baseURL.'/review/final';
        }
        return $lastWord;
    } else {
        $submenu_all = DB::table("tbl_submenu_permi")->select('submenu_id')
                ->where("id", $id)
                ->get();
        foreach ($submenu_all as $subm) {
            $submenu_id_1 = $subm->submenu_id;
        }
        // echo $submenu_id_1;
        $submenu_all_url = DB::table("tbl_submenu")->select('submenu_url')
                ->where("submenu_id", $submenu_id_1)
                ->get();
        foreach ($submenu_all_url as $url) {
            $submenu_url = $url->submenu_url;
        }

        $lastWord = substr($submenu_url, strrpos($submenu_url, '/') + 1);
        return $lastWord;
    }
}
