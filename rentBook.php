<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {

        $rentList = $_POST["rentList"];
        $userId = $_POST["userId"];

        $newfile_list = array();

        if($userId == ""){
            echo "로그인 후 대출 가능합니다.";
            return;
        }

        $file = fopen("./data/bookList.json", "r");

        while(!feof($file)) {
            $rental = new stdClass();

            $str = fgets($file);
            if($str == null){
                break;
            }
            $str_decode = json_decode($str, true);

            if(in_array($str_decode['name'], $rentList)) {
                if($str_decode['rental'] == "rented") {
                    echo "대출 가능한 도서만 선택해 주세요.";
                    return false;
                }

                $rental -> bookName = $str_decode['name'];
                $rental -> rentalDate = date("Y-m-d");

                if(!file_exists("./data/{$userId}.json")){
                    $json_file = fopen("./data/{$userId}.json", "w");
                }
                else{
                    $json_file = fopen("./data/{$userId}.json", "a");
                }
                fwrite($json_file, json_encode($rental, JSON_UNESCAPED_UNICODE));
                fwrite($json_file, "\n");
                fclose($json_file);
    
                $str_decode['rental'] = "rented";
            }
            array_push($newfile_list, $str_decode);
        }
        fclose($file);

        $file = fopen('./data/bookList.json', "w");
        
        foreach($newfile_list as $value) {
            fwrite($file, json_encode($value, JSON_UNESCAPED_UNICODE));
            fwrite($file, "\n");
        }

        fclose($file);

        // 회원 대출정보 생성
        

        

        echo "대출되었습니다.";
    }
?>