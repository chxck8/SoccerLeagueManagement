<?php

    include 'init.php';
    $search = $_GET['content'];

    if (isset($_GET['content'])) {
        
        $search = $_GET['content'];

        //parameters to do the search by multi_match using first_name or last_name
        $params = ['index' => 'players',
                    'type' => 'player',
                    'body' => [
                    'query' => [
                    'multi_match' => [
                    'fields' => ['first_name', 'last_name'],
                    'query' => $search
                              ]
                            ]
                        ]
                    ];

        //using the E-S method to search
        $query = $es->search($params);

        if ($query['hits']['total'] >= 1) {
            $results = $query['hits']['hits']; 
        }

        $json = array();

        //creating the array with the results
        if (isset($results)){
            foreach ($results as $result){
                $json[] = array(
                'dni' => $result['_source']['dni'],
                'first_name' => $result['_source']['first_name'],
                'last_name' => $result['_source']['last_name'],
                'position' => $result['_source']['position'],
                'number' => $result['_source']['number'],
                'club' => $result['_source']['club'],
                'status' => $result['_source']['status']
                );
            }
        }

        $jsonstring = json_encode($json, JSON_UNESCAPED_UNICODE);
        echo $jsonstring;
    };

?>

