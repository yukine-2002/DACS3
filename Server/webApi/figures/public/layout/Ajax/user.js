$(".choose-edit").on("click", function () {
    $(this).parent().prev().children().prop("disabled", false);
    $(this).toggleClass("none");
    $(this).next().removeClass("none");
});
$(".choose-save").on("click", function () {
    var value = $(this).parent().prev().children().val();
    var action = $(this).parent().prev().children().data("action");
    $.ajax({
        url: "updateCurrent",
        data: {
            action: action,
            value: value,
        },
    }).done(function (data) {
        console.log(data);
    });
    $(this).parent().prev().children().prop("disabled", true);
    $(this).toggleClass("none");
    $(this).prev().removeClass("none");
});

function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = $(".tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = $(".tablinks");

    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    console.log(tablinks);
    $(`#${cityName}`)[0].style.display = "block";
    evt.currentTarget.className += " active";
}
$("body").on("click", ".order", function () {
    $.ajax({
        type: "GET",
        url: "getOrder",
    })
        .done(function (data) {
            var s = 0;
            var e = 5;
            pagi(data, s, e);
            $(".loadMore").on("click", function () {
                e += 5;
                pagi(data, s, e);
            });
        })
        .fail(function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus + ": " + errorThrown);
        });
});
$("body").on("click", ".product", function () {
    $.ajax({
        type: "GET",
        url: "getProduct",
    })
        .done(function (data) {
            var html = "";
            html = data.map((datas, index) => {
                var htmls = "";
                var danhgia = datas.danhgia === 0 ? 5 : datas.danhgia;
                var htmlStart = "";
                for (let i = 1; i <= 5; i++) {
                    if (Math.floor(danhgia) >= i) {
                        htmlStart += '<i class="fas fa-star vang"></i>';
                    }

                    if (Math.floor(danhgia) < i) {
                        htmlStart += '<i class="fas fa-star"></i>';
                    }
                }
                htmls += `
                <div class="box">
                <div class="imageBox">
                    <img src="/layout/Img/${datas.image}" alt="" />
                    <ul class="action">
                    <a href="">
                        <li>
                        <i class="fas fa-heart"></i>
                        <span>Th??m danh s??ch </span>
                        </li>
                    </a>
                    <div class="cartCt" data-value="${datas.id_pro}">
                        <li>
                        <i class="fas fa-cart-plus"></i>
                        <span class="idPcart">Th??m c??o gi??? h??ng</span>
                        </li>
                    </div>
                    <a href="detailProduct/${datas.id_pro}">
                        <li>
                        <i class="fas fa-eye"></i>
                        <span>xem s???n ph???m</span>
                        </li>
                    </a>
                    </ul>
                </div>

                <div class="contents">
                    <div class="productName">
                    <h3>${datas.name_pro}</h3>
                    </div>
                    <div class="price_raiting">
                    <div class="price">
                        <h5>${
                            datas.price_new === null ? datas.price_old : datas.price_new
                        } VND</h5>
                    </div>
                    <div class="raiting">
                     ${htmlStart}
                    </div>
                    </div>
                </div>
                </div>
                `;
                return htmls;
            });

            $(".product-attention").html(html);
        })
        .fail(function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus + ": " + errorThrown);
        });
});

function pagi(data, start, end) {
    var start = start;
    var end = end;
    var html = "";
    html = data.map((datas, index) => {
        var htmls = "";
        if (index <= end) {
            htmls += `<li class="table-body">
                <div class="col col-1" data-label="STT">${index + 1}</div>
                <div class="col col-1" data-label="M?? GD">${datas.maGD}</div>
                <div class="col col-1" data-label="Tr???ng th??i">${
                    datas.statuss == 1 ? `???? thanh to??n` : `ch??a thanh to??n`
                }</div>
                <div class="col col-1" data-label="Ng??y thanh to??n">${
                    datas.dates
                }</div>
                <div class="col col-1" data-label="Chi ti???t"> <button> Xem </button></div>
        </li>`;
        }
        return htmls;
    });
    $(".showw").html(html);
}
$("#resetPassword").validate({
    rules: {
        password: {
            required: true,
            minlength: 6,
        },
        confirm_password: {
            required: true,
            minlength: 6,
            equalTo: "#inputPassword",
        },
    },
    messages: {
        password: {
            required: "Vui l??ng nh???p m???t kh???u",
            minlength: "Vui l??ng nh???p ??t nh???t 6 k?? t???",
        },
        confirm_password: {
            required: "Vui l??ng nh???p l???i m???t kh???u",
            minlength: "Vui l??ng nh???p ??t nh???t 6 k?? t???",
            equalTo: "M???t kh???u kh??ng tr??ng",
        },
    },
});
$("body").on("click", ".close", function () {
    $(".model-motife").css({ transform: "scale(0)", visibility: "hidden" });
});
$("#resetPassword").submit(function (e) {
    e.preventDefault();
    var datas = $(this).serializeArray();
    $.ajax({
        url: "changePassword",
        type: "post",
        data: datas,
    }).done(function (data) {
        if (data) {
            var html = `<div class="model-motife">
        <div class="model-body">
          <div class="card-motife">
            <div class="model-glass"></div>
            <div class="close">X</div>
            <div class="sub">-</div>
            <div class="motife"></div>
            <div class="model-content">
              <h2 id="nameCr">${data}</h2>
            </div>
          </div>
        </div>
      </div>`;
            $(".show-motife").html(html);
            $(".model-motife").css({
                transform: "scale(1)",
                visibility: "visible",
            });
        }
    });
});
