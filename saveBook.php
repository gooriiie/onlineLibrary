<?php
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $name = $_POST['name'];
        $author = $_POST['author'];
        $date = $_POST['date'];
        $publisher = $_POST['publisher'];
        $bookimage = $_POST['bookimage'];

        $book = new stdClass();
        $book -> name = $name;
        $book -> author = $author;
        $book -> publishDate = $date;
        $book -> publisher = $publisher;
        $book -> fileName = $bookimage;
        $book -> rental = "keep";

        if(!file_exists('./data/bookList.json')){
            $json_file = fopen('./data/bookList.json', "w");
            fwrite($json_file, json_encode($book, JSON_UNESCAPED_UNICODE));
            fwrite($json_file, "\n");
            fclose($json_file);

            echo "저장되었습니다.";
        }
        else{
            $json_file = fopen('./data/bookList.json', "a");
            fwrite($json_file, json_encode($book, JSON_UNESCAPED_UNICODE));
            fwrite($json_file, "\n");
            fclose($json_file);

            echo "저장되었습니다.";
        }
    }

?>