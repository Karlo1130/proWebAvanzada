<?php

    session_start();

    if(!isset($_SESSION['data'])){
        header("Location: index.php");
        exit;
    }

    $productController = new ProductController();

    class ProductController{
        function getProducts() : array {

            $sessionData = $_SESSION['data'];

            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$sessionData['token']),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            
            $response = json_decode($response, true);
            $data = $response['data'];

            return $data;
        }

        function getProductBySlug() : object {

            if(!isset($_GET['slug'])){
                header("Location: index.php");
                exit;
            }

            $data = $_SESSION['data'];

            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products/slug/'.$_GET['slug'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$data['token']),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            $response = json_decode($response);

            $data = $response->data;

            return $data;
        }

    }
    

?>
