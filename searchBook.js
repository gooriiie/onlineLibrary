$(document).ready(function() {
    $("#loginWindowOpenBtn").click(function() {
        if($("#loginWindowOpenBtn").text() == "로그인"){
            $("#loginWindow").css("visibility", "visible");
        }
        else if($("#loginWindowOpenBtn").text() == "로그아웃"){
            alert("로그아웃이 되었습니다.");
            $("#myId").empty();
            $("#loginWindowOpenBtn").text("로그인");
        }
    });
    
    $("#loginWindowCloseBtn").click(function() {
        $("#userId").val("");
        $("#userPw").val("");
        $("#loginWindow").css("visibility", "hidden");
    });

    $("#signInBtn").click(function() {
        $.post(
            "./loginOrSignin.php",
            {
                userId: $("#userId").val(),
                userPw: $("#userPw").val(),
                type: $(this).val()
            },
            function(data) {
                alert(data);
                $("#userId").val("");
                $("#userPw").val("");
                $("#loginWindow").css("visibility", "hidden");
            }
        );
    });

    $("#submitBtn").click(function() {
        $.post(
            "./loginOrSignin.php",
            {
                userId: $("#userId").val(),
                userPw: $("#userPw").val(),
                type: $(this).val()
            },
            function(data){
                if(data == "아이디 또는 패스워드의 입력양식을 체크해주세요."){
                    alert(data);
                }
                else if(data != ""){
                    $("#myId").append(data);
                    $("#loginWindowOpenBtn").text("로그아웃");
                }
                $("#userId").val("");
                $("#userPw").val("");
                $("#loginWindow").css("visibility", "hidden");
            }
        );
    });

    $("#searchBtn").click(function() {
        $.post(
            "./searchBook.php",
            {
                searchWord: $("#searchWord").val()
            },
            function(data) {
                $("#resultTable td").remove();
                $("#resultTable").append(data);
            }
        );
    });
    
    $("#rentBtn").click(function() {
        var checkList = [];

        $("input[name=\"chk\"]:checked").each(function() {
            checkList.push($.trim($(this).parent().next().text()));
        });

        $.post(
            "./rentBook.php",
            {
                rentList: checkList,
                userId: $("#myId").text()
            },
            function(data) {
                alert(data);
                if(data == "대출되었습니다."){
                    $("input[name=\"chk\"]:checked").each(function() {
                        $(this).parent().parent().children().eq(6).text("rented");
                    });
                }
            }
        );
    });

    $("#myRental").click(function() {
        if($("#myId").text() == ""){
            alert("로그인 후, 대출정보 보기가 가능합니다.");
        }
        else{
            window.open("./myRental.php", "나의 대출정보", "width=800px, height=700px");
        }
    });

    $("#returnBookBtn").click(function() {
        var checkList2 = [];

        $("input[name=\"chk2\"]:checked").each(function() {
            checkList2.push($.trim($(this).parent().next().text()));
        });

        $.post(
            "./returnBook.php",
            {
                returnList: checkList2,
                userId: $("#myid").text()
            },
            function(data) {
                alert(data);
                $("input[name=\"chk2\"]:checked").each(function() {
                    $(this).parent().parent().remove();
                });
            }
        );
    });
});
