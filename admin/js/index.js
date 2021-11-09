$(document).ready(function() {
  inputImg = [
    $("#imgInp"),
    $("#imgBarangInp")
  ];
  counterTambahan = 0;
  disTipeProduk = true;
  // getChartData();
  profilePic();
  continueProduction();
  changeTypeFill();
  inputImg.forEach(function(img, index) {
    img.change(function() {
      readURL(this);
    });
  })
})

function changeTypeFill() {
  let changeIndex = findIndex(document.getElementById("changeTypeValue").value, objectTipe.idTipe);
  let deleteIndex = findIndex(document.getElementById("deleteTypeValue").value, objectTipe.idTipe);
  if (changeIndex == objectTipe.idTipe.length) {
    document.getElementById('changeTypeSubmit').disabled = true;
    document.getElementById("changeKodeTipe").disabled = true;
    document.getElementById("changeNamaTipe").disabled = true;
    document.getElementById("changeKodeTipe").value = "Input Kode Tipe Barang";
    document.getElementById("changeNamaTipe").value = "Input Nama Tipe Barang";
  } else {
    document.getElementById('changeTypeSubmit').disabled = false;
    document.getElementById("changeKodeTipe").disabled = false;
    document.getElementById("changeNamaTipe").disabled = false;
    document.getElementById("changeKodeTipe").value = objectTipe.kodeTipe[changeIndex];
    document.getElementById("changeNamaTipe").value = objectTipe.namaTipe[changeIndex];
  }
  if (deleteIndex == objectTipe.idTipe.length) {
    document.getElementById('deleteTypeSubmit').disabled = true;
    document.getElementById("deleteKodeTipe").value = "Kode Tipe Barang";
    document.getElementById("deleteNamaTipe").value = "Nama Tipe Barang";
  } else {
    document.getElementById('deleteTypeSubmit').disabled = false;
    document.getElementById("deleteKodeTipe").value = objectTipe.kodeTipe[deleteIndex];
    document.getElementById("deleteNamaTipe").value = objectTipe.namaTipe[deleteIndex];
  }
}

function displayTipeProduk() {
  if (disTipeProduk) {
    $("#tabelTipeProduk").stop(false, false).slideUp();
    disTipeProduk = false;
  } else {
    $("#tabelTipeProduk").stop(false, false).slideDown();
    disTipeProduk = true;
  }
}

function changeProductFill() {
  let changeIndex = findIndex(document.getElementById("changeProductValue").value, objectProduct.idProduct);
  let deleteIndex = findIndex(document.getElementById("deleteTypeValue").value, objectProduct.idProduct);
  if (changeIndex == objectProduct.idProduct.length) {
    $('#uploadImgChangeProduct').attr('src', "nodata");
    document.getElementById('imgBarangChangeProduct').disabled = true;
    document.getElementById('changeProductNamaBarang').disabled = true;
    document.getElementById("changeProductTipeBarang").disabled = true;
    document.getElementById("changeProductHargaBarang").disabled = true;
    document.getElementById("changeProduksiBarang").disabled = true;
    document.getElementById("changeProductJumlahBarang").disabled = true;
    document.getElementById("changeProductDescBarang").disabled = true;
    document.getElementById("changeProductSubmit").disabled = true;
    document.getElementById("changeProductDec").disabled = true;
    document.getElementById("changeProductinc").disabled = true;
    document.getElementById("changeKodeTipe").value = "Input Kode Tipe Barang";
    document.getElementById("changeNamaTipe").value = "Input Nama Tipe Barang";
  } else {
    console.log(objectProduct.idProduct[changeIndex]);
    document.getElementById('deleteValueProduct').value = objectProduct.idProduct[changeIndex];
    if (objectProduct.gambar == "0") {
      $('#uploadImgChangeProduct').hide();
      // $('#uploadImgChangeProduct').attr('src', "NoPicture");
      // document.getElementById('imgBarangChangeProduct').value = "NoPicture";
    } else {
      $('#uploadImgChangeProduct').show();
      $('#uploadImgChangeProduct').attr('src', objectProduct.gambar[changeIndex]);
      // document.getElementById('imgBarangChangeProduct').value = objectProduct.gambar[changeIndex];
    }
    document.getElementById('changeProductNamaBarang').value = objectProduct.namaProduct[changeIndex];
    document.getElementById("changeProductTipeBarang").value = objectProduct.tipeBarang[changeIndex];
    document.getElementById("changeProductHargaBarang").value = objectProduct.hargaBarang[changeIndex];
    if (objectProduct.produksiBarang[changeIndex] == "1") {
      $("#changeProductinputBnykBarang").hide(300);
      document.getElementById("changeProduksiBarang").checked = true;
    } else {
      document.getElementById("changeProduksiBarang").checked = false;
      $("#changeProductinputBnykBarang").show(300);
    }
    document.getElementById("changeProductJumlahBarang").value = objectProduct.jumlahBarang[changeIndex];
    document.getElementById("changeProductDescBarang").value = objectProduct.descBarang[changeIndex];
    // document.getElementById('imgBarangChangeProduct').disabled = false;
    // document.getElementById('changeProductNamaBarang').disabled = false;
    // document.getElementById("changeProductTipeBarang").disabled = false;
    // document.getElementById("changeProductHargaBarang").disabled = false;
    // document.getElementById("changeProduksiBarang").disabled = false;
    // document.getElementById("changeProductJumlahBarang").disabled = false;
    // document.getElementById("changeProductDescBarang").disabled = false;
    document.getElementById("changeProductSubmit").disabled = false;
    // document.getElementById("changeProductDec").disabled = false;
    // document.getElementById("changeProductinc").disabled = false;

  }
  // if (deleteIndex == objectProduct.idProduct.length) {
  //   document.getElementById('deleteTypeSubmit').disabled = true;
  //   document.getElementById("deleteKodeTipe").value = "Kode Tipe Barang";
  //   document.getElementById("deleteNamaTipe").value = "Nama Tipe Barang";
  // } else {
  //   if (objectProduct.gambar == "0") {
  //     $('#uploadImgChangeProduct').hide();
  //     // $('#uploadImgChangeProduct').attr('src', "NoPicture");
  //     // document.getElementById('imgBarangChangeProduct').value = "NoPicture";
  //   } else {
  //     $('#uploadImgChangeProduct').show();
  //     $('#uploadImgChangeProduct').attr('src', objectProduct.gambar[changeIndex]);
  //     // document.getElementById('imgBarangChangeProduct').value = objectProduct.gambar[changeIndex];
  //   }
  //   document.getElementById('changeProductNamaBarang').value = objectProduct.namaProduct[changeIndex];
  //   document.getElementById("changeProductTipeBarang").value = objectProduct.tipeBarang[changeIndex];
  //   document.getElementById("changeProductHargaBarang").value = objectProduct.hargaBarang[changeIndex];
  //   if (objectProduct.produksiBarang[changeIndex] == "1") {
  //     $("#changeProductinputBnykBarang").hide(300);
  //     document.getElementById("changeProduksiBarang").checked = true;
  //   } else {
  //     document.getElementById("changeProduksiBarang").checked = false;
  //     $("#changeProductinputBnykBarang").show(300);
  //   }
  //   document.getElementById("changeProductJumlahBarang").value = objectProduct.jumlahBarang[changeIndex];
  //   document.getElementById("changeProductDescBarang").value = objectProduct.descBarang[changeIndex];
  //   document.getElementById('deleteTypeSubmit').disabled = false;
  //   document.getElementById("deleteKodeTipe").value = objectTipe.kodeTipe[deleteIndex];
  //   document.getElementById("deleteNamaTipe").value = objectTipe.namaTipe[deleteIndex];
  // }
}

function findIndex(input, det) {
  let index = 0;
  for (let i = 0; i < det.length; i++) {
    if (input == det[i]) {
      break;
    } else {
      index += 1;
    }
  }
  return index;
}

function changeTambahan(det) {
  if (det == 1) {
    if (counterTambahan < 3) {
      document.getElementById('imgBarangTambah' + counterTambahan).required = true;
      $("#containerTambahan" + counterTambahan).show();
      counterTambahan += 1;
    } else {
      alert("Max 3 gambar tambahan!");
    }
  } else {
    if (counterTambahan > 0) {
      counterTambahan -= 1;
      document.getElementById("imgBarangTambah" + counterTambahan).value = '';
      document.getElementById('imgBarangTambah' + counterTambahan).required = false;
      $("#containerTambahan" + counterTambahan).hide();
    }
  }
}

function continueProduction() {
  $("#produksiBarang").click(function() {
    if (document.getElementById('produksiBarang').checked) {
      document.getElementById('inputBnykBarang').required = false;
      $("#inputBnykBarang").hide(300);
    } else {
      document.getElementById('inputBnykBarang').required = true;
      $("#inputBnykBarang").show(300);
    }
  });
  $("#changeProduksiBarang").click(function() {
    if (document.getElementById('changeProduksiBarang').checked) {
      document.getElementById('changeProductJumlahBarang').required = false;
      $("#changeProductinputBnykBarang").hide(300);
    } else {
      document.getElementById('changeProductJumlahBarang').required = true;
      $("#changeProductinputBnykBarang").show(300);
    }
  });
}

function readURL(input) {
  console.log("ada");
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      // $('#uploadImg').attr('src', e.target.result);
      if (input == document.getElementById('imgInp')) {
        $('#uploadImg').show();
        $('#uploadImg').attr('src', e.target.result);
      } else if (input == document.getElementById('imgBarangInp')) {
        $('#uploadImgBarang').show();
        $('#uploadImgBarang').attr('src', e.target.result);
      }
    }
    reader.readAsDataURL(input.files[0]);
  }
}

function profilePic() {
  $("#profilePic").hover(function() {
    $("#addPic").stop(false, false).show(300);
  }, function() {
    $("#addPic").stop(false, false).hide(300);
  })
}

function getChartData(data, chart) {
  dataChart = {
    normal: {
      idElement: [],
      data: {}
    },
    pie: {
      idElement: [],
      data: {}
    }
  };
  for (let i = 0; i < chartCount; i++) {
    dataChart.normal.idElement.push(document.getElementById('myChart' + i).getContext('2d'));
    dataChart.pie.idElement.push(document.getElementById('myPieChart' + i).getContext('2d'));
    canvasChart(dataChart.normal.idElement[i]);
    canvasPieChart(dataChart.pie.idElement[i]);
  }
}

function canvasChart(ctx) {
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Month 1', 'Month 2', 'Month 3', 'Month 4', 'Month 5', 'Month 6', 'Month 7', 'Month 8', 'Month 9', 'Month 10', 'Month 11', 'Month 12'],
      datasets: [{
        label: 'INCOME',
        data: [12, 19, 3, 5, 2, 3, 12, 19, 3, 5, 2, 3],
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)',
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)'
        ],
        borderColor: [
          'rgba(255, 99, 132, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)',
          'rgba(255, 99, 132, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)'
        ],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      }
    }
  });
}

function canvasPieChart(ctx) {
  var myPieChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: ['Month 1', 'Month 2', 'Month 3', 'Month 4', 'Month 5', 'Month 6', 'Month 7', 'Month 8', 'Month 9', 'Month 10', 'Month 11', 'Month 12'],
      datasets: [{
        label: 'INCOME',
        data: [12, 19, 3, 5, 2, 3, 12, 19, 3, 5, 2, 3],
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)',
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)'
        ],
        borderColor: [
          'rgba(255, 99, 132, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)',
          'rgba(255, 99, 132, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)'
        ],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      }
    }
  });
}
