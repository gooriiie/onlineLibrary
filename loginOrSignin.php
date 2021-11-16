<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $userId = $_POST['userId'];
        $userPw = $_POST['userPw'];

        $userIdPattern = '/^([A-Za-z0-9]){6,15}$/';
        $userPwPattern = '/^.*(?=^.{8,15}$)(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%^&+=]).*$/';

        $type = $_POST['type'];

        if($userId == "" || $userPw == ""){
            echo "아이디 또는 패스워드의 입력양식을 체크해주세요.";
            return;
        }

        if(!preg_match($userIdPattern, $userId) || !preg_match($userPwPattern, $userPw)) {
            echo "아이디 또는 패스워드의 입력양식을 체크해주세요.";
            return;
        }

        if($type == "SignIn") { // 회원가입 버튼을 누른 경우

            $person = new stdClass();
            $person -> id = $userId;
            $person -> Password = $userPw;

            if(!file_exists('./data/person.json')){
                $json_file = fopen('./data/person.json', "w");
                fwrite($json_file, json_encode($person, JSON_UNESCAPED_UNICODE));
                fwrite($json_file, "\n");
                fclose($json_file);
    
                echo "회원가입이 완료되었습니다.";
            }
            else{
                $json_file = fopen('./data/person.json', "a");
                fwrite($json_file, json_encode($person, JSON_UNESCAPED_UNICODE));
                fwrite($json_file, "\n");
                fclose($json_file);
    
                echo "회원가입이 완료되었습니다.";
            }
        }
        else if($type == "Submit"){   // 로그인 버튼을 누른 경우

            $file = fopen("./data/person.json", "r");
            while(!feof($file)) {
                $str = fgets($file);
                if($str == null){
                    break;
                }
                $str_decode = json_decode($str, true);
        
                if(($str_decode['id'] == $userId) && 
                    $str_decode['Password'] == $userPw) {
                        
                        session_start();
                        $_SESSION['id'] = $userId;
                        $_SESSION['pw'] = $userPw;
                        echo $userId;
                        break;
                }
            }
        }

    }
?>