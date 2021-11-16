const name = $("#name");
const author = $("#author");
const date = $("#date");
const publisher = $("#publisher");
const bookimage = $("#bookimage");
const authorAddBtn = $("#authorAddBtn");
const authorDeleteBtn = $("#authorDeleteBtn");
const saveBtn = $("#saveBtn");

$(function() {
    $("#authorAddBtn").click(function() {
        var inputNode = "<input type=\"text\" name=\"author[]\">";
        if($("#author").nextAll().length < 6) {
            $("#author").after(inputNode);
        }
        else {
            alert("저자 이름은 3명까지 입력할 수 있습니다.");
        }
    });  

    $("#authorDeleteBtn").click(function() {
        if($("#author").nextAll().length > 4) {
            $("#author").next().remove();
        }
    });
});
