$(document).ready(function () {
  // hover menu
//   $(".menu_item").click(function () {
//     $(this).find(".sub_menu").toggle();

//   });
    $(".menu_item").hover(function () {
        $(this).find(".sub_menu").toggle();

    });
    $(".box_shearch").click(function () {
      $(this).parent().find("form").toggle();
    });
    $(".nav-search-close-button").click(function () {
        $(this).parent().toggle();
    });

  // banner slider
  $('.slider_item').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    dots: true,
    autoplay: true,
    autoplaySpeed: 2000,
  });

  // slider gói đề xuất
  $('.silder_package').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    dots: false,
    autoplay: false,
    // autoplaySpeed: 2000,
    responsive: [
      {
        breakpoint: 1025,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 769,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          dots: true
        }
      },
      {
        breakpoint: 480,
        settings: {
          arrows: false,
          slidesToShow: 1,
          slidesToScroll: 1,
          centerMode: true,
          centerPadding: '40px',
        }
      }
    ]
  });

  // fpt category shortcode
  $('.fpt_category_shortcode_slider').slick({
    slidesToShow: 3,
    slidesToScroll: 2,
    // dots: true,
    autoplay: true,
    arrows: true,
    autoplaySpeed: 2000,
    responsive: [
      {
        breakpoint: 1025,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 769,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          dots: true
        }
      },
      {
        breakpoint: 480,
        settings: {
          arrows: false,
          slidesToShow: 1,
          slidesToScroll: 1,
          centerMode: true,
          centerPadding: '40px',
        }
      }
    ]
  });

  // slider internet
  $('.slider_internet').slick({
    slidesToShow: 6,
    slidesToScroll: 1,
    dots: false,
    autoplay: false,
    infinite: false,
    // autoplaySpeed: 2000,
    responsive: [
        {
            breakpoint: 1500,
            settings: {
              slidesToShow: 5,
              slidesToScroll: 1,
              infinite: false,
              dots: true
            }
          },
          {
            breakpoint: 1025,
            settings: {
              slidesToShow: 4,
              slidesToScroll: 1,
              infinite: true,
              dots: false,
              arrows: false
            }
          },
          {
            breakpoint: 769,
            settings: {
              slidesToShow: 4,
              dots: false,
              arrows: false,
              slidesToScroll: 1
    
            }
          },
          {
            breakpoint: 480,
            settings: {
              arrows: false,
              slidesToShow: 2,
              slidesToScroll: 1,
              centerMode: true,
              centerPadding: '40px',
              infinite: true,
            }
          }
    ]
  });
  // slider other news
  $('.slider_other_news').slick({
    slidesToShow: 6,
    slidesToScroll: 1,
    dots: false,
    arrows: true,
    autoplay: false,
    infinite: false,
    // autoplaySpeed: 2000,
    responsive: [
        {
            breakpoint: 1500,
            settings: {
              slidesToShow: 5,
              slidesToScroll: 1,
              infinite: false,
              dots: true
            }
          },
          {
            breakpoint: 1025,
            settings: {
              slidesToShow: 4,
              slidesToScroll: 1,
              infinite: true,
              dots: false,
              arrows: false
            }
          },
          {
            breakpoint: 769,
            settings: {
              slidesToShow: 3,
              dots: false,
              arrows: false,
              slidesToScroll: 1
    
            }
          },
          {
            breakpoint: 480,
            settings: {
              arrows: false,
              slidesToShow: 2,
              slidesToScroll: 1,
              centerMode: false,
              infinite: true,
            }
          }
    ]
  });

  $("#checknha").click(function () {
    var ischecknha = $("#checknha").is(":checked");
      if(ischecknha){
        $(this).parent().parent().parent().find('.nha_rieng').addClass('open');
        $(this).parent().parent().parent().find('.nha_rieng').removeClass('close');
        $(this).parent().parent().parent().find('.chung_cu').removeClass('open');
      }
  });
  $("#checkccu").click(function () {
    var ischeckcc = $("#checkccu").is(":checked");
      if(ischeckcc){
        $(this).parent().parent().parent().find('.chung_cu').addClass('open');
        $(this).parent().parent().parent().find('.chung_cu').removeClass('close');
        $(this).parent().parent().parent().find('.nha_rieng').removeClass('open');
      }
  });
 
  

});




