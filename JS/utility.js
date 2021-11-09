$(document).ready(function() {
  navIcon();
})

$(window).on("load", function() {
  $(".loader-wrapper").fadeOut("slow");
})

function navIcon() {
  let clicked = false;
  $("#navIcon").hover(function() {
    $("#navMenu").click(function() {
      $("#navMenu").stop(false, false).slideUp(600);
      $("#navIcon").removeClass("icon-transform");
      $("#navIcon").addClass("nav-icon");
      $(".showMenu").stop(false, false).css({
        'opacity': '0',
        'width': '0',
        'padding-right': '0px'
      });
      clicked = false;
    })
    $(this).click(function() {
      $("#navMenu").stop(false, false).slideToggle(600);
      if (!clicked) {
        $(this).removeClass("nav-icon");
        $(this).addClass("icon-transform");
        $(".showMenu").delay(200).stop(false, false).animate({
          'opacity': '1',
          'width': '100%',
          'margin-right': '0px'
        }, 175);
        clicked = true;
      } else {
        $(this).removeClass("icon-transform");
        $(this).addClass("nav-icon");
        $(".showMenu").stop(false, false).css({
          'opacity': '0',
          'width': '0',
          'margin-right': '-60px'
        });
        clicked = false;
      }
    });
  })
}

function formatRupiah(angka, prefix) {
  var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split = number_string.split(','),
    sisa = split[0].length % 3,
    rupiah = split[0].substr(0, sisa),
    ribuan = split[0].substr(sisa).match(/\d{3}/gi);
  if (ribuan) {
    separator = sisa ? '.' : '';
    rupiah += separator + ribuan.join('.');
  }
  rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
  return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}
