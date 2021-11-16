<?php
    session_start();
    $userId = $_SESSION['id'];
    $rentalList = [];

    if(file_exists("./data/{$userId}.json")){
        $file = fopen("./data/{$userId}.json", "r");
        while(!feof($file)) {
            $str = fgets($file);
            if($str == null){
                break;
            }
            $str_decode = json_decode($str, true);
            
            array_push($rentalList, $str_decode);            
        }
    }
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>나의 대출정보</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="./searchBook.css">
</head>
<body>
    <div id="headerDiv">
        <span id="myid"><?= $userId; ?></span> 회원
    </div>
    <div id="rentalDiv">
        <table id="rentalTable">
            <tr>
                <th>선택</th>
                <th>책 제목</th>
                <th>대출 날짜</th>
            </tr>
            <?php
            foreach($rentalList as $record) {
            ?>
            <tr>
            <td>
                <input type="checkbox" name="chk2">
            </td>
            <td>
                <?= $record['bookName'] ?>
            </td>
            <td>
                <?= $record['rentalDate'] ?>
            </td>
            </tr>
            <?php
            }
            ?>
        </table>

        <button id="returnBookBtn">반납하기</button>
    <script src="./searchBook.js"></script>
</body>
</html>