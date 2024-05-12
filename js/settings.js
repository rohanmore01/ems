(function($) {
    'use strict';
    $(function() {
      $(".nav-settings").click(function() {
        $("#right-sidebar").toggleClass("open");
      });
      $(".settings-close").click(function() {
        $("#right-sidebar,#theme-settings").removeClass("open");
      });
  
      $("#settings-trigger").on("click", function() {
        $("#theme-settings").toggleClass("open");
      });
  
  
      //background constants
      var navbar_classes = "navbar-danger navbar-success navbar-warning navbar-dark navbar-light navbar-primary navbar-info navbar-pink";
      var sidebar_classes = "sidebar-light sidebar-dark";
      var $body = $("body");
  
      //sidebar backgrounds
      $("#sidebar-dark-theme").on("click", function() {
        $body.removeClass(sidebar_classes);
        $body.addClass("sidebar-dark");
        $(".sidebar-bg-options").removeClass("selected");
        $(this).addClass("selected");
      });
      $("#sidebar-light-theme").on("click", function() {
        $body.removeClass(sidebar_classes);
        $body.addClass("sidebar-light");
        $(".sidebar-bg-options").removeClass("selected");
        $(this).addClass("selected");
      });

      $("#sidebar-light-theme, #sidebar-dark-theme").on("click", function() {
        
        var sideBarColor = $(this).attr('id').replace('-theme','');

        $.ajax({
            url: 'user-preferences.php',
            method: 'POST',
            data: {key:'sidebar_skins', sideBarColor:sideBarColor},
            error: err => console.log(err),
            success: function(resp) {}
          });        
      });
  
  
      //Navbar Backgrounds
      $(".tiles.primary").on("click", function() {
        $(".navbar").removeClass(navbar_classes);
        $(".navbar").addClass("navbar-primary");
        $(".tiles").removeClass("selected");
        $(this).addClass("selected");
      });
      $(".tiles.success").on("click", function() {
        $(".navbar").removeClass(navbar_classes);
        $(".navbar").addClass("navbar-success");
        $(".tiles").removeClass("selected");
        $(this).addClass("selected");
      });
      $(".tiles.warning").on("click", function() {
        $(".navbar").removeClass(navbar_classes);
        $(".navbar").addClass("navbar-warning");
        $(".tiles").removeClass("selected");
        $(this).addClass("selected");
      });
      $(".tiles.danger").on("click", function() {
        $(".navbar").removeClass(navbar_classes);
        $(".navbar").addClass("navbar-danger");
        $(".tiles").removeClass("selected");
        $(this).addClass("selected");
      });
      $(".tiles.info").on("click", function() {
        $(".navbar").removeClass(navbar_classes);
        $(".navbar").addClass("navbar-info");
        $(".tiles").removeClass("selected");
        $(this).addClass("selected");
      });
      $(".tiles.dark").on("click", function() {
        $(".navbar").removeClass(navbar_classes);
        $(".navbar").addClass("navbar-dark");
        $(".tiles").removeClass("selected");
        $(this).addClass("selected");
      });
      $(".tiles.default").on("click", function() {
        $(".navbar").removeClass(navbar_classes);
        $(".tiles").removeClass("selected");
        $(this).addClass("selected");
      });

      $(".tiles").on("click", function() {

        var navBarColor = $('.navbar').attr('class').split(' ').pop();

        $.ajax({
          url: 'user-preferences.php',
          method: 'POST',
          data: {key:'header_skins', navBarColor:navBarColor},
          error: err => console.log(err),
          success: function(resp) {}
        });

      });

      $(".navbar-toggler").on("click", function() {

        var getSideBarMinimizeClass = $('body').attr('class').split(' ').pop();
        var sideBarMinimizeClass = (getSideBarMinimizeClass == "sidebar-icon-only") ? " " : "sidebar-icon-only";

        $.ajax({
          url: 'user-preferences.php',
          method: 'POST',
          data: {key:'sidebar_minimize', sideBarMinimizeClass:sideBarMinimizeClass},
          error: err => console.log(err),
          success: function(resp) {}
        });

      });
  
      //Horizontal menu in mobile
      $('[data-toggle="horizontal-menu-toggle"]').on("click", function() {
        $(".horizontal-menu .bottom-navbar").toggleClass("header-toggled");
      });
      // Horizontal menu navigation in mobile menu on click
      var navItemClicked = $('.horizontal-menu .page-navigation >.nav-item');
      navItemClicked.on("click", function(event) {
        if(window.matchMedia('(max-width: 991px)').matches) {
          if(!($(this).hasClass('show-submenu'))) {
            navItemClicked.removeClass('show-submenu');
          }
          $(this).toggleClass('show-submenu');
        }        
      });
  
      $(window).scroll(function() {
        if(window.matchMedia('(min-width: 992px)').matches) {
          var header = $('.horizontal-menu');
          if ($(window).scrollTop() >= 71) {
            $(header).addClass('fixed-on-scroll');
          } else {
            $(header).removeClass('fixed-on-scroll');
          }
        }
      });
  
    });
  })(jQuery);