var got;
var chars;
var speed = 50;
var t;
var randomchars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz?!*_-., ";

function change()
{
    randstring = "";
    rslength = chars.length - got.length;

    for(x=0;x<rslength;x++)
    {
        i = Math.floor(Math.random() * randomchars.length);
        randstring += randomchars.charAt(i);
    }

    if(randstring.charAt(0) == chars.charAt(got.length))
    {
        got += randstring.charAt(0);
        randstring = "";
    }
    else
    {
        $(".password_field").val(randstring);
    }

    if(chars.length > got.length)
    {
        t = setTimeout("change()", speed);
    }
    else
    {
        $(".password_field").val("");
    }

    $(".password_field").val(got+randstring);

    if ($(".password_field").val() == chars) {
        $(".password_field").removeClass("text-red");
        $(".password_field").addClass("text-green");
    }
}

function startDecrypt(breakSpeed)
{
    speed = breakSpeed;
    chars = decrypt_str($.base64.decode($(".password_field").val()+"="), 6);
    $(".password_field").addClass("text-red");
    $(".password_field").val("");
    got = "";
    t = setTimeout("change()", speed);
}

jQuery(document).ready(function() {
    clearTimeout(t);
    //speed = parent.getHardwareInfo('cpu') / 100;
    speed = 12;
    $(".password_field").val("");
    $(".password_field").removeClass("text-red");
    $(".password_field").removeClass("text-green");

    $(".crack_btn").click(function(){
        startDecrypt(speed);
        return false;
    });

    $("#passwd_cracker_form").bind("submit", function(e) {
        startDecrypt(speed);
        e.preventDefault();
        return false;
    });
});

function encrypt_str(text, key)
{
    var to_enc = text;

    var xor_key=key;
    var the_res="";
    for(i=0;i<to_enc.length;++i)
    {
        the_res+=String.fromCharCode(xor_key^to_enc.charCodeAt(i));
    }
    return the_res;
}

function decrypt_str(text, key)
{
    var to_dec=text;
    var the_res = "";

    var xor_key=key;
    for(i=0;i<to_dec.length;i++)
    {
        the_res+=String.fromCharCode(xor_key^to_dec.charCodeAt(i));
    }
    return the_res;
}

