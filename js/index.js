var mailnumber=1;
document.cookie="mailnumber=1";
content='<input type="email" name="tomail_'   +String(mailnumber)+'  " class="form-control" placeholder="请输入收信人的邮箱">   '
function add(){
    $("#tomail").append(content);
    mailnumber+=1;
    document.cookie="mailnumber="+String(mailnumber);
}
function minus(){
    if(mailnumber>0){
        $('#tomail').children(':last-child').remove();
        mailnumber-=1;
        document.cookie="mailnumber"+String(mailnumber);
    }
}