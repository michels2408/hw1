<?php
    require_once "auth.php";

    header('Content-Type: application/json');

    switch($_GET['type']) {
        case 'pixie': pixie(); break;
        case 'bob': bob(); break;
        case 'long': long(); break;
        case 'bangs': bangs(); break;
        default: break;
    }

    function pixie() {
        $key_img = 'HR9Lrg3RvhXsy8yf2ejE_JPdMXsmq7YRXKYxnfydyN4';

        $url = 'https://api.unsplash.com/search/photos?query=short+hair&orientation=portrait&per_page=3&client_id=' .$key_img;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $res = curl_exec($curl);
        curl_close($curl);

        $json = json_decode($res, true);

        $photosArray = array();
        for ($i = 0; $i < count($json['results']); $i++) {
            $photosArray[] = array('url' => $json['results'][$i]['urls']['full']);
        }

        echo json_encode($photosArray);
    }

    function bob() {
        $key_img = 'HR9Lrg3RvhXsy8yf2ejE_JPdMXsmq7YRXKYxnfydyN4';

        $url = 'https://api.unsplash.com/search/photos?query=medium+hair&per_page=3&orientation=portrait&client_id=' .$key_img;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $res = curl_exec($curl);
        curl_close($curl);

        $json = json_decode($res, true);

        $photosArray = array();
        for ($i = 0; $i < count($json['results']); $i++) {
            $photosArray[] = array('url' => $json['results'][$i]['urls']['full']);
        }

        echo json_encode($photosArray);
    }

    function long() {
        $key_img = 'HR9Lrg3RvhXsy8yf2ejE_JPdMXsmq7YRXKYxnfydyN4';

        $url = 'https://api.unsplash.com/search/photos?query=long+hair&per_page=3&orientation=portrait&client_id=' .$key_img;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $res = curl_exec($curl);
        curl_close($curl);

        $json = json_decode($res, true);

        $photosArray = array();
        for ($i = 0; $i < count($json['results']); $i++) {
            $photosArray[] = array('url' => $json['results'][$i]['urls']['full']);
        }

        echo json_encode($photosArray);
    }

    function bangs() {
        $key_img = 'HR9Lrg3RvhXsy8yf2ejE_JPdMXsmq7YRXKYxnfydyN4';

        $url = 'https://api.unsplash.com/search/photos?query=bangs+girl&per_page=3&orientation=portrait&client_id=' .$key_img;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $res = curl_exec($curl);
        curl_close($curl);

        $json = json_decode($res, true);

        $photosArray = array();
        for ($i = 0; $i < count($json['results']); $i++) {
            $photosArray[] = array('url' => $json['results'][$i]['urls']['full']);
        }

        echo json_encode($photosArray);
    }
?>