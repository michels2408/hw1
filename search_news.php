<?php
    require_once "auth.php";

    header('Content-Type: application/json');

    switch($_GET['type']) {
        case 'hair_removal': hairRemoval(); break;
        case 'face_mask': faceMask(); break;
        case 'face_cleaning': faceCleaning(); break;
        default: break;
    }

    function hairRemoval() {
        $key_news = '4b6c56e5af81e62b6d1f20722e507600';

        $url = 'http://api.mediastack.com/v1/news?access_key=' . $key_news . '&languages=it&keywords=depilazione-calciatori&limit=5';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $res = curl_exec($curl);
        curl_close($curl);

        $json = json_decode($res, true);

        $newsArray = array();
        for ($i = 0; $i < count($json['data']); $i++) {
            $newsArray[] = array('title' => $json['data'][$i]['title'],
                                    'author' => $json['data'][$i]['author'],
                                    'article' => $json['data'][$i]['description'],
                                    'url' => $json['data'][$i]['url']);
        }

        echo json_encode($newsArray);
    }

    function faceMask() {
        $key_news = '4b6c56e5af81e62b6d1f20722e507600';

        $url = 'http://api.mediastack.com/v1/news?access_key=' . $key_news . '&languages=it&keywords=maschera+viso&limit=5';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $res = curl_exec($curl);
        curl_close($curl);

        $json = json_decode($res, true);

        $newsArray = array();
        for ($i = 0; $i < count($json['data']); $i++) {
            $newsArray[] = array('title' => $json['data'][$i]['title'],
                                    'author' => $json['data'][$i]['author'],
                                    'article' => $json['data'][$i]['description'],
                                    'url' => $json['data'][$i]['url']);
        }

        echo json_encode($newsArray);
    }

    function faceCleaning() {
        $key_news = '4b6c56e5af81e62b6d1f20722e507600';

        $url = 'http://api.mediastack.com/v1/news?access_key=' . $key_news . '&languages=it&keywords=pulizia+del+viso+skincare&limit=5';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $res = curl_exec($curl);
        curl_close($curl);

        $json = json_decode($res, true);

        print_r($json);

        $newsArray = array();
        for ($i = 0; $i < count($json['data']); $i++) {
            $newsArray[] = array('title' => $json['data'][$i]['title'],
                                'article' => $json['data'][$i]['description'],
                                'url' => $json['data'][$i]['url']);
        }

        echo json_encode($newsArray);
    }

?>