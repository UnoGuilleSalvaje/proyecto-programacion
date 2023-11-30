$(document).ready(function () {
    $(".contenedor-formularios")
      .find("input, textarea")
      .on("keyup blur focus", function (e) {
        var $this = $(this),
          label = $this.prev("label");
  
        if (e.type === "keyup") {
          if ($this.val() === "") {
            label.removeClass("active highlight");
          } else {
            label.addClass("active highlight");
          }
        } else if (e.type === "blur") {
          if ($this.val() === "") {
            label.removeClass("active highlight");
          } else {
            label.removeClass("highlight");
          }
        } else if (e.type === "focus") {
          if ($this.val() === "") {
            label.removeClass("highlight");
          } else if ($this.val() !== "") {
            label.addClass("highlight");
          }
        }
      });
  
    $(".tab a").on("click", function (e) {
      e.preventDefault();
  
      $(this).parent().addClass("active");
      $(this).parent().siblings().removeClass("active");
  
      target = $(this).attr("href");
  
      $(".contenido-tab > div").not(target).hide();
  
      $(target).fadeIn(600);
    });
  });
  

  
$('#nmberone').click(function() {
  $('#mainCoantiner, #formBg').removeClass('mystyleSec');
$('#mainCoantiner, #formBg').removeClass('mystylethird');
event.stopPropagation();
});



$('#nmbertwo').click(function() {
 $('#mainCoantiner, #formBg').removeClass('mystylethird');
  $('#mainCoantiner, #formBg').addClass('mystyleSec');
event.stopPropagation();
});


$('#numberthree').click(function() {
 /* $('#catbox').removeClass('cat2');*/
  $('#mainCoantiner, #formBg').addClass('mystylethird');
event.stopPropagation();
});

const wrapper = document.querySelector(".wrapper"),
        signupHeader = document.querySelector(".signup header"),
        loginHeader = document.querySelector(".login header");
      loginHeader.addEventListener("click", () => {
        wrapper.classList.add("active");
      });
      signupHeader.addEventListener("click", () => {
        wrapper.classList.remove("active");
      });