function glitch(canvasID, imagePath) {
    var canvas = document.getElementById(canvasID)
        , context = canvas.getContext('2d')
        , img = new Image()
        , w
        , h
        , offset
        , glitchInterval;

    img.src = imagePath;
    img.onload = function () {
        init();
        window.onresize = init;
    };

    var init = function () {
        canvas.opacity = 0.5;
        clearInterval(glitchInterval);
        canvas.width = w = img.width;
        //canvas.width = w = window.innerWidth;
        //offset = w * .1;
        offset =  1;
        canvas.height = h = img.height;
        //canvas.height = h = ~~(175 * ((w - (offset * 2)) / img.width));
        glitchInterval = setInterval(function () {
            clear();
            //context.drawImage(img, 0, 110, img.width, 175, offset, 0, w - (offset * 2), h);
            context.drawImage(img, 0, 1, img.width, h, offset, 0, w - (offset * 2), h);

            setTimeout(glitchImg, randInt(250, 1000));
        }, 1000);
    };

    var clear = function () {
        context.rect(0, 0, w, h);
        context.fillStyle = "black";
        context.fill();

    };

    var glitchImg = function () {
        for (var i = 0; i < randInt(1, 13); i++) {
            var x = Math.random() * w;
            var y = Math.random() * h;
            var spliceWidth = w - x;
            var spliceHeight = randInt(5, h / 3);
            context.drawImage(canvas, 0, y, spliceWidth, spliceHeight, x, y, spliceWidth, spliceHeight);
            context.drawImage(canvas, spliceWidth, y, x, spliceHeight, 0, y, x, spliceHeight);
        }
    };

    var randInt = function (a, b) {
        return ~~(Math.random() * (b - a) + a);
    };
}
