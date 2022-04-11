<?php
function getinfo(){
    $info = 'conninfo.json';
    if(!file_exists($info)) {
        echo '파일이 없습니다.';
        exit;
    }
    $info_json = file_get_contents($info);
    return(json_decode($info_json));
}

?>