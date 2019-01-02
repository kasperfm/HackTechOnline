var got;
var chars;
var speed = 50;
var t;
var randomchars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz?!*_-., ";

jQuery(document).ready(function() {
    $(".password_field").change(function(){
        var passwordField = $(".password_field");
        if(passwordField.val() == ""){
            passwordField.removeClass("text-green");
            passwordField.addClass("text-red");
        }
    });

    $("#passwd_cracker_form").bind("submit", function(e) {
        //startDecrypt(speed);
        var passwordField = $(".password_field");
        var passwordValue = passwordField.val();

        var realPassword = decrypt_str($.base64.decode(passwordValue + "="), 6);
        $(".decrypt-text").text(realPassword);
        $(".decrypt-text").decodeEffect();
        e.preventDefault();
        return false;
    });

    $(".decrypt-text").on('change', function(){
        $(".password_field").val($(".decrypt-text").text());
    });
});

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

jQuery.fn.decodeEffect = (function ($) {
    var defaultOptions = {
        duration:      3000,
        stepsPerGlyph: 10,
        codeGlyphs:    "ABCDEFGHIJKLMNOPQRSTUWVXYZ1234567890qwertyuiopasdfghjklzxcvbnm",
        className:     "code"
    };

    // get a random string from the given set,
    // or from the 33 - 125 ASCII range
    function randomString(set, length) {
        var string = "", i, glyph;
        for(i = 0 ; i < length ; i++) {
            glyph = Math.random() * set.length;
            string += set[glyph | 0];
        }
        return string;
    }

    // this function starts the animation. Basically a closure
    // over the relevant vars. It creates a new separate span
    // for the code text, and a stepper function that performs
    // the animation itself
    function animate(element, options) {
        var text = element.text(),
            inputBox = $(".password_field").val(""),
            span = $("<span/>").addClass(options.className).insertAfter(element).css('display' ,'none'),
            interval = options.duration / (text.length * options.stepsPerGlyph),
            step = 0,
            length = 0,
            stepper = function () {
                if(++step % options.stepsPerGlyph === 0) {
                    length++;
                    element.text(text.slice(0, length));
                }
                if(length <= text.length) {
                    span.text(randomString(options.codeGlyphs, text.length - length));
                    inputBox.val(text.slice(0, length) + span.text());
                    setTimeout(stepper, interval);
                } else {
                    span.remove();
                }
            };
        element.text("");
        stepper();
    }

    // Basic jQuery plugin pattern
    return function (options) {
        options = $.extend({}, defaultOptions, (options || {}));
        return this.each(function () {
            animate($(this), options);
        });
    };
}(jQuery));