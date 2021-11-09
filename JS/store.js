$(document).ready(function() {
  filterSelection("all");
  selectBox();
  sliderPrice();
})

function selectBox() {
  let checkedItem = ["all"];
  $(".radioType").click(function() {
    if (document.getElementById(this.id).checked) {
      if (checkedItem[0] == "NOVALUE") {
        checkedItem.splice(0, 1);
      }
      checkedItem.push(this.value);
    } else {
      if (checkedItem.length > 1) {
        for (let i = 0; i < checkedItem.length; i++) {
          if (checkedItem[i] == this.value) {
            checkedItem.splice(i, 1);
          }
        }
      } else {
        checkedItem.splice(0, 1);
        checkedItem.push("NOVALUE");
      }
    }
    filterSelection(checkedItem);
  });
}

function filterSelection(data) {
  itemFilter = data.slice();
  var x, i;
  x = document.getElementsByClassName("filterDiv");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
    RemoveClass(x[i], "show");
  }
  for (let j = 0; j < itemFilter.length; j++) {
    if (itemFilter[j] == "all") itemFilter[j] = "";
    for (i = 0; i < x.length; i++) {
      if (x[i].className.indexOf(itemFilter[j]) > -1) {
        x[i].style.display = "block";
        AddClass(x[i], "show");
      }
    }
  }
}

function AddClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    if (arr1.indexOf(arr2[i]) == -1) {
      element.className += " " + arr2[i];
    }
  }
}

function RemoveClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    while (arr1.indexOf(arr2[i]) > -1) {
      arr1.splice(arr1.indexOf(arr2[i]), 1);
    }
  }
  element.className = arr1.join(" ");
}

function mySearchFunction() {
  var input, filter, ul, li, a, i, txtValue, count;
  count = 0;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  ul = document.getElementById("containerItem");
  li = ul.getElementsByTagName("a");
  console.log(li);
  for (i = 0; i < li.length; i++) {
    a = li[i].getElementsByClassName("itemName")[0];
    txtValue = a.textContent || a.innerText;
    if (count < bnykItem) {
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        if (li[i].classList.contains("show")) {
          li[i].style.display = "block";
        }
      } else {
        if (li[i].classList.contains("show")) {
          li[i].style.display = "none";
        }
      }
      count += 1;
    }
  }
}

function sliderPrice() {
  let priceSlider = {
    min: 0,
    max: 300000
  }
  $('#slider-container').slider({
    range: true,
    min: priceSlider.min,
    max: priceSlider.max,
    values: [priceSlider.min, priceSlider.max],
    create: function() {},
    slide: function(event, ui) {
      var mi = ui.values[0];
      var mx = ui.values[1];
      filterSystem(mi, mx);
    }
  })
}

function filterSystem(minPrice, maxPrice) {
  $(".item").hide().filter(function() {
    var price = parseInt($(this).data("price"), 10);
    $("#minCost").text(minPrice);
    $("#maxCost").text(maxPrice);
    return price >= minPrice && price <= maxPrice;
  }).show();
}
