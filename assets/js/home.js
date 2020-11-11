$(function () {
  "use strict";
  function s() {
    return /(Android|webOS|Phone|iPad|iPod|BlackBerry|Windows Phone)/i.test(
      navigator.userAgent
    );
  }
  function e() {
    $(".homepage-header").css({
      width: $(window).width(),
      height: $(window).height(),
    });
  }
  function a(s) {
    $(".vegas-container").each(function () {
      $(this).vegas("pause");
    }),
      $("#" + s)[0]._vegas && $("#" + s).vegas("play"),
      $("body").addClass("demo-playing");
  }

  $(".homepage-header").vegas({
    overlay: "/assets/img/overlays/04.png",
    delay: 1e4,
    slidesToKeep: 1,
    transition: "fade2",
    transitionDuration: 8e3,
    animation: "random",
    animationDuration: 1e4,
    slides: [
      { src: backimage, color: "#DBC9B3" },
      { src: backimage, color: "#93CAC5" },
      /*{ src: "/uploads/user/home-slider/home-bg-01.jpg", color: "#D3A87E" },
      { src: "/img/unsplash5.jpg", color: "#E2DC56" },
              { src: "/img/unsplash4.jpg", color: "#DBC9B3" },
              { src: "/img/unsplash6.jpg", color: "#93CAC5" },
              { src: "/img/unsplash8.jpg", color: "#A58A6F" },*/
    ],
    walk: function (s, e) {
      (s = null),
        $(".homepage-info").find("a").css("color", e.color),
        $(".jaybar-buttons").css("background", e.color),
        $(".vegas-timer-progress").css("backgroundColor", e.color);
    },
  });
});
