<?php
    if (isset($_GET['text1'])) {
        $temp = $_GET['text1'];
        if ($temp == "1") {
            $handle = fopen("http://104.198.0.197:8080/legislators?per_page=all", "rb");
        }
        
        else if ($temp == "2")  {
            $handle = fopen("http://104.198.0.197:8080/legislators?per_page=all&chamber=house", "rb");
        } 
        else if ($temp == "3")  {
            $handle = fopen("http://104.198.0.197:8080/legislators?per_page=all&chamber=senate", "rb");
        } 
            
    $contents = '';
    while (!feof($handle)) {
      $contents .= fread($handle, 8192);
    }
    fclose($handle);

    $contents = json_decode($contents);
    global $array;
    $array = $contents->results;
    $arrlen = count($array);
    $ret = json_encode($array);
    echo "$ret";
    
    }

    if(isset($_GET['view'])) {
        $temp = $_GET['view'];
        $json = file_get_contents("http://104.198.0.197:8080/legislators?&bioguide_id=$temp&all_legislators=true");
        $json = json_decode($json);
        $array1 = $json->results;   
        $bio = array('bio'=>$array1);
        
        $json = file_get_contents("http://104.198.0.197:8080/committees?member_ids=$temp");
        $json = json_decode($json);
        $array2 = $json->results;   
        $comm = array('comm'=>$array2);
        $merged_arrays = array_merge($bio, $comm);
        
        $json = file_get_contents("http://104.198.0.197:8080/bills?sponsor_id=$temp");
        $json = json_decode($json);
        $array3 = $json->results;   
        $bill = array('bill'=>$array3);
        $merged_three = array_merge($merged_arrays, $bill);
        
        $ret = json_encode($merged_three);
        
        echo "$ret";
    }

    if(isset($_GET['text2'])) {
        $temp = $_GET['text2'];
        if ($temp == "1") {
            $json = file_get_contents("http://104.198.0.197:8080/bills?history.active=true&per_page=50");
        }
        if ($temp == "2") {
            $json = file_get_contents("http://104.198.0.197:8080/bills?history.active=false&per_page=50");
        }
        
        $json = json_decode($json);
        $array = $json->results;   
        
        
        $ret = json_encode($array);
        
        echo "$ret";
    }
    if(isset($_GET['view2'])) {
        $temp = $_GET['view2'];
        
            $json = file_get_contents("http://congress.api.sunlightfoundation.com/bills?bill_id=$temp");
        
        
        $json = json_decode($json);
        $array = $json->results;   
        
        
        $ret = json_encode($array);
        
        echo "$ret";
    }
    if(isset($_GET['view3'])) {
            $temp = $_GET['view3'];

                $json = file_get_contents("http://104.198.0.197:8080/committees?committee_id=$temp");


            $json = json_decode($json);
            $array = $json->results;   


            $ret = json_encode($array);

            echo "$ret";
        }
    if(isset($_GET['text3'])) {
        $temp = $_GET['text3'];
        if ($temp == "1") {
            $json = file_get_contents("http://104.198.0.197:8080/committees?&chamber=house&per_page=all");
        }
        if ($temp == "2") {
            $json = file_get_contents("http://104.198.0.197:8080/committees?&chamber=senate&per_page=all");
        }
        if ($temp == "3") {
            $json = file_get_contents("http://104.198.0.197:8080/committees?&chamber=joint&per_page=all");
        }
        
        $json = json_decode($json);
        $array = $json->results;   
        
        
        $ret = json_encode($array);
        
        echo "$ret";
    }
    
    
?>