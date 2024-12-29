
function change_btn1() {
    document.getElementById("chage_text").innerHTML = "Giá bảo hành tại nhà";
}
function change_btn2() {
    document.getElementById("chage_text").innerHTML = "Giá online";
}
$(document).ready(function(){
    $('.product_slider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 5,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: false
                }
            },
            {
                breakpoint: 480,
                dots: false,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            }
        ]
    });

    $('.box_img .slider_for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        fade: true,
        asNavFor: '.box_img .slider_nav'
    });
    $('.box_img .slider_nav').slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        asNavFor: '.box_img .slider_for',
        arrows: true,
        dots: false,
        focusOnSelect: true
    });

    $(".slider_for").popupLightbox({
        // width: 600,
        // height: 450
    });

    $('.show_mobile').click(function(){
        $(this).parent().find('.speci_content').css("max-height", "none");
        $(this).parent().find('.speci_content').find('li').css("display","block");
        $('.speci_content.hidden_element tr:nth-child(n + 9)').show()
        $(this).remove();
    });
    $('.btn_readmore-info').click(function(){
        $(this).parent().parent().css("max-height", "none");
        $(this).parent().remove();
    });
    $('.custom_tab-item').click(function(){

        $(this).parent().children().removeClass('active');
        $(this).addClass('active');

    });
});
var h = screen.availHeight;
var max_height = h - 200;
$('.box_popup .speci_content').css("max-height", max_height);
$(".hidden_element ul li:gt(8)").css("display","none");

