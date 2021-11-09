$(document).ready(function() {
  // cartItemSelectAll();
  fillerSummary();
  changeQuantity();
});

// function cartItemSelectAll() {
//   $("#addAllItem").click(function() {
//     for (let i = 0; i < bnykItem; i++) {
//       if (document.getElementById('addAllItem').checked) {
//         $("#cartItemCheck" + i).prop("checked", true);
//       } else {
//         $("#cartItemCheck" + i).prop("checked", false);
//       }
//     }
//   });
// }

function changeQuantity() {
  for (let i = 0; i < bnykBarang; i++) {
    $("#increaseQuantity" + i).click(function() {
      document.getElementById('quantityItem' + i).value = (+document.getElementById('quantityItem' + i).value + 1);
      bnykBarangItem[i] = (+bnykBarangItem[i] + 1);
      fillerSummary();
    });
    $("#decreaseQuantity" + i).click(function() {
      if (document.getElementById('quantityItem' + i).value > 1) {
        document.getElementById('quantityItem' + i).value -= 1;
        bnykBarangItem[i] -= 1;
        fillerSummary();
      }
    });
  }
}

function fillerSummary() {
  let jumlahBarang = 0;
  let totalHargaItem = [];
  let totalHarga = 0;
  for (var i = 0; i < bnykBarang; i++) {
    jumlahBarang = (+jumlahBarang + +bnykBarangItem[i]);
    totalHargaItem[i] = hargaItem[i] * bnykBarangItem[i];
    totalHarga = (+totalHarga + +totalHargaItem[i]);
  }
  for (var i = 0; i < bnykBarang; i++) {
    $("#itemCounter" + i).html(bnykBarangItem[i]);
    $("#totalPrice" + i).html(formatRupiah((totalHargaItem[i]).toString(), 'Rp. ') + ",00");
    $("#totalBarang").html(jumlahBarang);
    document.getElementById('itemCounterInput' + i).value = bnykBarangItem[i];
    document.getElementById('totalSemuaBarang').value = jumlahBarang;
  }
  document.getElementById('totalBiayaBarang').value = totalHarga;
  $("#totalBiaya").html(formatRupiah(totalHarga.toString(), 'Rp. ') + ",00");
}
