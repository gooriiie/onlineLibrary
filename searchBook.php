<?php
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $searchWord = $_POST['searchWord'];

        $file = fopen("./data/bookList.json", "r");
        while(!feof($file)) {
            $str = fgets($file);
            if($str == null){
                break;
            }
            $str_decode = json_decode($str, true);
            if($searchWord == ""){
                break;
            }
            if(strpos(strtolower($str_decode['name']), strtolower($searchWord)) !== false) {
                echo "<tr>"
                        . "<td><input type=\"checkbox\" name=\"chk\"></td>"
                        . "<td>" . $str_decode['name'] . "</td>"
                        . "<td>" . implode(',',$str_decode['author']) . "</td>"
                        . "<td>" . $str_decode['publishDate'] . "</td>"
                        . "<td>" . $str_decode['publisher'] . "</td>"
                        . "<td><a href=\"\">미리보기</a></td>"
                        . "<td>" . $str_decode['rental'] . "</td>";
            }

            foreach($str_decode['author'] as $value) {
                if(strpos(strtolower($value), strtolower($searchWord)) !== false) {
                    echo "<tr>"
                            . "<td><input type=\"checkbox\" name=\"chk\"></td>"
                            . "<td>" . $str_decode['name'] . "</td>"
                            . "<td>" . implode(',',$str_decode['author']) . "</td>"
                            . "<td>" . $str_decode['publishDate'] . "</td>"
                            . "<td>" . $str_decode['publisher'] . "</td>"
                            . "<td><a href=\"\">미리보기</a></td>"
                            . "<td>" . $str_decode['rental'] . "</td>";
                    break;
                }
            }

            if(strpos(strtolower($str_decode['publishDate']), strtolower($searchWord)) !== false) {
                echo "<tr>"
                        . "<td><input type=\"checkbox\" name=\"chk\"></td>"
                        . "<td>" . $str_decode['name'] . "</td>"
                        . "<td>" . implode(',',$str_decode['author']) . "</td>"
                        . "<td>" . $str_decode['publishDate'] . "</td>"
                        . "<td>" . $str_decode['publisher'] . "</td>"
                        . "<td><a href=\"\">미리보기</a></td>"
                        . "<td>" . $str_decode['rental'] . "</td>";
            }

        }
    }
?>