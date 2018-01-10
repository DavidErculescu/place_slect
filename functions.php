<?php

    function access_token_exist(){
        return isset($_GET['tkid']);
    }

    function token_data_create(){
        $id = uniqid();

        file_put_contents('./jsons/'.$id.'.json', json_encode([
            'users' => [],
            'venues' => []
        ]));
        return $id;
    }

    function get_file_data($tkid){
        return file_get_contents('./jsons/'.$tkid.'.json');
    }

    function update_file($tkid, $data){
        file_put_contents('./jsons/'.$tkid.'.json', $data);
    }

    function get_users($tkid){
        $file_data = get_file_data($tkid);
        $data = json_decode($file_data, true);
        return $data['users'];
    }

    function get_venues($tkid){
        $file_data = get_file_data($tkid);
        $data = json_decode($file_data, true);
        return $data['venues'];
    }

    function add_user($tkid, $user){
        $file_data = get_file_data($tkid);
        $data = json_decode($file_data, true);
        $data['users'][] = $user;
        $updated_data = json_encode($data);
        update_file($tkid, $updated_data);
    }

    function add_venue($tkid, $venue){
        $file_data = get_file_data($tkid);
        $data = json_decode($file_data, true);
        $data['venues'][] = $venue;
        $updated_data = json_encode($data);
        update_file($tkid, $updated_data);
    }

?>