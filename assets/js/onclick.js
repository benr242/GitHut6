$(document).ready(function(){
    $(".division  > li").click(function(){
        $(this).addClass('active')
            .siblings()
            .removeClass('active');

        //OR
        //$('.active').removeClass('active');
        //$(this).addClass('active');

        //OR
        //$(this).addClass('active');
        //$('li').not(this).removeClass('active');

        //works--
        //alert($(this).text());
        alert($(this).children("a").text());
    });
});
