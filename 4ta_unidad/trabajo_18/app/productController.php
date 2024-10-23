<?php

    session_start(); 

    if(isset($_POST["action"])){
        switch($_POST["action"]){
            case "addProduct":

                
                $name = $_POST["name"];
                $slug = $_POST["slug"];
                $description = $_POST["description"];
                $features = $_POST["features"];
                
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
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array('name' => $name,'slug' => $slug,'description' => $description,'features' => $features),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer '.$sessionData['token']),
                ));

                $response = curl_exec($curl);

                curl_close($curl);
                
                $response = json_decode($response, true);

                var_dump($response);

                if(isset($response) && $response['code'] == 4){
                    header("Location: ../home.php?status=ok");
                } else {
                    header("Location: ../home.php?status=error");
                }

                break;

            case "editProduct":
            
                $name = $_POST["name"];
                $slug = $_POST["slug"];
                $description = $_POST["description"];
                $features = $_POST["features"];
                $id = $_POST["id"];
                
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
                CURLOPT_CUSTOMREQUEST => 'PUT',
                CURLOPT_POSTFIELDS => http_build_query(array(
                    'name' => $name,
                    'slug' => $slug,
                    'description' => $description,
                    'features' => $features,
                    'id' => $id,
                )),
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/x-www-form-urlencoded',
                    'Authorization: Bearer '.$sessionData['token']),
                ));

                $response = curl_exec($curl);

                curl_close($curl);
                
                $response = json_decode($response, true);

                if(isset($response) && $response['code'] == 4){
                    header("Location: ../home.php?status=ok");
                } else {
                    header("Location: ../home.php?status=error");
                }

                break;
        }
    }

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
