// Sidebar start
$(document).ready(function () {
  $('.menuBtn').click(function () {
    $('.mobMenu').toggleClass('show');
    $('body').toggleClass('body_overlay');
  });
  $('.btn-close').click(function () {
    $('.mobMenu').toggleClass('show');
    $('body').toggleClass('body_overlay');
  });
  
  $('.dsMobBtn').click(function () {
    $('.dashSearch').toggleClass('active');
  });

  // Footer Menu Toggle //
  jQuery('.nehFM ul li a').click(function(e) {
    jQuery(this).next('ul').slideToggle(0);

    jQuery(this).toggleClass('showSM');

  });  

});


// Scroll to Top
$(document).ready(function () {
  "use strict";
  var offSetTop = 100;
  var $scrollToTopButton = $('.scrollToTop');
  //Check to see if the window is top if not then display button
  $(window).scroll(function () {
    if ($(this).scrollTop() > offSetTop) {
      $scrollToTopButton.fadeIn();
    } else {
      $scrollToTopButton.fadeOut();
    }
  });
  //Click event to scroll to top
  $scrollToTopButton.click(function () {
    $('html, body').animate({ scrollTop: 0 }, 300);
    return false;
  });
});


jQuery(document).ready(function ($) {
  $('li.dropdown-submenu a').on('click', function (event) {
    // event.preventDefault();
    // event.stopPropagation();
    $('li.dropdown-submenu').not($(this).parent()).removeClass('open');
    $(this).parent().toggleClass('open');
  });
});



// Menu More JQuery //
  // MAIN MENU
  // const $mainMenu = $("#mainMenu");
  // const $autoNav = $("#autoNav");
  // const $autoNavMore = $("#autoNavMore");
  // const $autoNavMoreList = $("#autoNavMoreList");
  // autoNavMore = () => {
  //   let childNumber = 2;

  //   if ($(window).width() >= 320) {
  //     // GET MENU AND NAV WIDTH
  //     const $menuWidth = $mainMenu.width();
  //     const $autoNavWidth = $autoNav.width();
  //     if ($autoNavWidth > $menuWidth) {
  //       // CODE FIRES WHEN WINDOW SIZE GOES DOWN
  //       $autoNav
  //         .children(`li:nth-last-child(${childNumber})`)
  //         .prependTo($autoNavMoreList);
  //       autoNavMore();
  //     } else {
  //       // CODE FIRES WHEN WINDOW SIZE GOES UP
  //       const $autoNavMoreFirst = $autoNavMoreList
  //       .children("li:first-child")
  //       .width();
  //       // CHECK IF ITEM HAS ENOUGH SPACE TO PLACE IN MENU
  //       if ($autoNavWidth + $autoNavMoreFirst < $menuWidth) {
  //         $autoNavMoreList.children("li:first-child").insertBefore($autoNavMore);
  //       }
  //     }
  //     if ($autoNavMoreList.children().length > 0) {
  //       $autoNavMore.show();
  //       childNumber = 2;
  //     } else {
  //       $autoNavMore.hide();
  //       childNumber = 1;
  //     }
  //   }
  // };
  // // INIT
  // autoNavMore();
  // $(window).resize(autoNavMore);
  // MAIN MENU END
  $(document).ready(function () {
    const $mainMenu = $("#mainMenu");
    const $autoNav = $("#autoNav");
    const $autoNavMore = $("#autoNavMore");
    const $autoNavMoreList = $("#autoNavMoreList");
  
    const autoNavMore = () => {
     
      let childNumber = 2;
      const $menuWidth = $mainMenu.width();
      const $autoNavWidth = $autoNav.width();
  
      // Function to move items back from the "More" dropdown to the main menu
      const moveItemsBack = () => {
        while ($autoNavMoreList.children().length > 0) {
          const $autoNavMoreFirst = $autoNavMoreList.children("li:first-child").width();
          if ($autoNavWidth + $autoNavMoreFirst <= $menuWidth) {
            // Move item back to the main menu if there is space
            $autoNavMoreList.children("li:first-child").insertBefore($autoNavMore);
          } else {
            break; // Break if there's no more space to move items back
          }
        }
      };
  
      if ($(window).width() >= 320) {
        // When shrinking the screen, move items to the "More" dropdown
        if ($autoNavWidth > $menuWidth) {
          $autoNav
            .children(`li:nth-last-child(${childNumber})`)
            .prependTo($autoNavMoreList);
          $autoNavMore.show(); // Ensure "More" is visible when items are moved
          autoNavMore(); // Recursively check again if more items need to be moved
        } else {
          moveItemsBack(); // Move items back to the main menu when resizing larger
        }
  
        // Show or hide the "More" button based on whether there are items in the dropdown
        if ($autoNavMoreList.children().length > 0) {
          $autoNavMore.show(); // Show "More" if there are items in the dropdown
          childNumber = 2;
        } else {
          $autoNavMore.hide(); // Hide "More" if no items are in the dropdown
          childNumber = 1;
        }
      }
    };
  
    // Initialize and handle window resize
    autoNavMore();
    $(window).resize(autoNavMore);
  });
  