<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {

        $returnList = $_POST['returnList'];
        $userId = $_POST["userId"];

        $newfile_list = array();

        $file = fopen("./data/bookList.json", "r");

        echo $returnList[0];
        
        while(!feof($file)) {
            $str = fgets($file);
            if($str == null){
                break;
            }
            $str_decode = json_decode($str, true);
            
            if(in_array($str_decode['name'], $returnList)) {
                $str_decode['rental'] = "keep";
            }
            array_push($newfile_list, $str_decode);
        }
        fclose($file);

        $file = fopen("./data/bookList.json", "w");
        
        foreach($newfile_list as $value) {
            fwrite($file, json_encode($value, JSON_UNESCAPED_UNICODE));
            fwrite($file, "\n");
        }

        fclose($file);

        $newfile_list2 = array();

        $file = fopen("./data/{$userId}.json", "r");

        while(!feof($file)) {
            $str = fgets($file);
            if($str == null){
                break;
            }
            $str_decode = json_decode($str, true);

            if(in_array($str_decode['bookName'], $returnList)) {
                continue;
            }
            else{
                array_push($newfile_list2, $str_decode);
            }
        }
        fclose($file);

        $file = fopen("./data/{$userId}.json", "w");
        
        foreach($newfile_list2 as $value) {
            fwrite($file, json_encode($value, JSON_UNESCAPED_UNICODE));
            fwrite($file, "\n");
        }

        fclose($file);

        echo "반환되었습니다.";
    }
?>