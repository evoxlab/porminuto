function change(price, subtotal, cost, nextPrice) { 
    document.getElementById("show_price").innerHTML = price;
    price = Number(price);
    nextPrice = Number(nextPrice)
    const formatSubtotal = subtotal.replace(/,/g, '');
    subtotal = Number(formatSubtotal) - cost;
    if (subtotal >= price && nextPrice === 0 && subtotal <= 3000) {
        document.getElementById('btn_submit').disabled = false;
    } else {
        if (subtotal >= price && subtotal < nextPrice) {
            document.getElementById('btn_submit').disabled = false;
        } else {
            document.getElementById('btn_submit').disabled = true;
        }
    }
}

function removeSessionStorage() {
    sessionStorage.removeItem("selection");
}

function validationMax(event, btnId) {
    const btn = document.getElementById(`a_${btnId}`)
    const txt = document.getElementById(`txt_${btnId}`)
    const value = event.target.value
    const maxValue = event.target.getAttribute("max")
    const max = parseInt(maxValue)

    if (value > max) {
        btn.disabled = true;
        btn.classList.add('btn-danger')
        txt.textContent = "No stock";
    } else {
        btn.disabled = false;
        btn.classList.remove('btn-danger')
        txt.textContent = "Agregar al carro";
    }
}

function add_cart(id, name, price, contable, point) {
    var a = "a_" + id;
    var aa = "aa_" + id;
    document.getElementById(a).disabled = true;
    document.getElementById(a).innerHTML = "<span class='spinner-border spinner-border-sm' role='status'></span>";
    var qty = "qty_" + id;
    qty = document.getElementById(qty).value;
    $.ajax({
        type: "post",
        url: site + "backoffice_new/planes/add_cart",
        dataType: "json",
        data: {
            id: id,
            name: name,
            price: price,
            qty: qty,
            contable: contable,
            point: point
        },
        success: function (data) {
            if (data.status == true) {
                document.getElementById(a).style.display = "none";
                document.getElementById(aa).style.display = "block";
            }
        }
    });
}

function edit(row_id, qty) {
    edit_button = "edit_" + row_id;
    document.getElementById(edit_button).innerHTML = "<span class='spinner-border spinner-border-sm' role='status'></span>";
    qty = document.getElementById(qty).value;
    $.ajax({
        type: "post",
        url: site + "backoffice_new/planes/carrito_edit",
        dataType: "json",
        data: {
            row_id: row_id,
            qty: qty
        },
        success: function (data) {
            if (data.status == true) {
                window.setTimeout(function () {
                    location.reload();
                }, 0);
            } else {
                window.setTimeout(function () {
                    location.reload();
                }, 1000);
            }
        }
    });
}

function deleted(row_id) {
    sessionStorage.removeItem("selection");
    Swal.fire({
        title: 'Confirma que desea eliminar el producto?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Confirmo'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "post",
                url: site + "backoffice_new/planes/carrito_delete",
                dataType: "json",
                data: { row_id: row_id },
                success: function (data) {
                    if (data.status == true) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: "Eliminado",
                            showConfirmButton: false,
                        });
                        window.setTimeout(function () {
                            location.reload();
                        }, 1000);
                    } else {
                        window.setTimeout(function () {
                            location.reload();
                        }, 1000);
                    }
                }
            });
        } else {
            document.getElementById("btn_submit").disabled = false;
            document.getElementById("btn_submit").innerHTML = "Enviar";
        }
    });
}

function deleted_adm(row_id) {
    sessionStorage.removeItem("selection");
    Swal.fire({
        title: 'Confirma que desea eliminar el producto?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Confirmo'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "post",
                url: site + "/dashboard/nueva_venta/carrito_delete",
                dataType: "json",
                data: { row_id: row_id },
                success: function (data) {
                    if (data.status == true) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: "Eliminado",
                            showConfirmButton: false,
                        });
                        window.setTimeout(function () {
                            location.reload();
                        }, 1000);
                    } else {
                        window.setTimeout(function () {
                            location.reload();
                        }, 1000);
                    }
                }
            });
        } else {
            document.getElementById("btn_submit").disabled = false;
            document.getElementById("btn_submit").innerHTML = "Enviar";
        }
    });
}

function update_cart() {
    oData = new FormData(document.forms.namedItem("form"));
    $.ajax({
        url: site + "backoffice_new/planes/update_cart",
        method: "POST",
        data: oData,
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
            if (data.status == true) {
                console.log("chaged")
            }
        }
    });
}

function descount_price(products, max) {
    let total = parseFloat(document.getElementById("total").innerHTML);

    if (total == max) {
        document.getElementById("warning_message").innerHTML = "Ha llegado al máximo";
    } else {
        document.getElementById("warning_message").innerHTML = "";
    }

    products.map((product) => {
        const price = product.price
        const input = document.getElementById(product.id);
        let prevValue = parseInt(input.value);

        input.addEventListener("input", () => {
            const currentValue = parseInt(input.value);

            if (currentValue > prevValue) {
                const subTotal = price + total;
                if (subTotal <= max) {
                    total = subTotal
                    prevValue = currentValue
                } else {
                    input.value = prevValue
                }
            } else if (currentValue < prevValue) {
                total = total - price;
            }

            document.getElementById("total").innerHTML = total;
        });
    })
}

function created_payment() {
    document.getElementById("create_button").disabled = true;
    document.getElementById("create_button").innerHTML = "<span class='spinner-border spinner-border-sm' role='status'></span> Procesando...";
    var text = document.getElementById("payment_name");
    var button = document.getElementById("create_button");
    var select = document.getElementById("payment_id");
    if (text.value == "") {
        text.focus();
    } else {
        Swal.fire({
            title: 'Confirma que desea agregar un nuevo método?',
            icon: 'warning',
            customClass: 'sweetalert-bg',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Confirmo'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: site + "dashboard/nueva_venta/nuevo_metodo",
                    dataType: "json",
                    data: { payment_name: text.value },
                    success: function (data) {
                        if (data.status == true) {
                            button.innerHTML = data.message;
                            window.setTimeout(function () {
                                location.reload();
                            }, 1000);
                        } else {
                            Swal.fire({
                                position: 'center',
                                icon: 'info',
                                title: data.message
                            });
                            document.getElementById("create_button").disabled = false;
                            document.getElementById("create_button").innerHTML = "Crear";
                        }
                    }
                });
            } else {
                document.getElementById("create_button").disabled = false;
                document.getElementById("create_button").innerHTML = "Crear";
            }
        });
    }
}

function pay_adm() {
    //document.getElementById("submit_pay").disabled = true;
    //document.getElementById("submit_pay").innerHTML = "<span class='spinner-border spinner-border-sm' role='status'></span> Procesando...";
    oData = new FormData(document.forms.namedItem("form"));
    Swal.fire({
        title: 'Confirma que desea realizar la compra?',
        icon: 'warning',
        customClass: 'sweetalert-bg',
        showCancelButton: true,
        confirmButtonColor: '#3085d6', 
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Confirmo'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: site + "/dashboard/nueva_venta/procesar_venta",
                method: "POST",
                data: oData,
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    var data = JSON.parse(data);
                    if (data.status == true) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            customClass: 'sweetalert-bg',
                            title: data.message,
                            showConfirmButton: false,
                        });
                        window.setTimeout(function () {
                            window.location = site + "dashboard/nueva_venta";
                        }, 1000);
                    } else {
                        Swal.fire({
                            position: 'center',
                            icon: 'info',
                            customClass: 'sweetalert-bg',
                            title: data.message
                        });
                        document.getElementById("submit_pay").disabled = false;
                        document.getElementById("submit_pay").innerHTML = "<i class='fa fa-usd' aria-hidden='true'></i> Pagar con Monedero";
                    }
                }
            });
        } else {
            document.getElementById("submit_pay").disabled = false;
            document.getElementById("submit_pay").innerHTML = "<i class='fa fa-usd' aria-hidden='true'></i> Pagar con Monedero";
        }
    });
}

function wallet_pay() {
    //document.getElementById("submit_monedero").disabled = true;
    //document.getElementById("submit_monedero").innerHTML = "<span class='spinner-border spinner-border-sm' role='status'></span> Procesando...";
    oData = new FormData(document.forms.namedItem("form"));
    Swal.fire({
        title: 'Confirma que desea realizar la compra?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Confirmo'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: site + "backoffice_new/planes/activar_monedero",
                method: "POST",
                data: oData,
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    var data = JSON.parse(data);
                    if (data.status == true) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: data.message,
                            showConfirmButton: false,
                        });
                        window.setTimeout(function () {
                            window.location = site + "backoffice_new/facturas";
                        }, 2500);
                    } else {
                        Swal.fire({
                            position: 'center',
                            icon: 'info',
                            title: data.message
                        });
                        document.getElementById("submit_monedero").disabled = false;
                        document.getElementById("submit_monedero").innerHTML = "<i class='fa fa-usd' aria-hidden='true'></i> Pagar con Monedero";
                    }
                }
            });
        } else {
            document.getElementById("submit_monedero").disabled = false;
            document.getElementById("submit_monedero").innerHTML = "<i class='fa fa-usd' aria-hidden='true'></i> Pagar con Monedero";
        }
    });
}

function stores_pay() {
    document.getElementById("submit_tienda").disabled = true;
    document.getElementById("submit_tienda").innerHTML = "<span class='spinner-border spinner-border-sm' role='status'></span> Procesando...";
    oData = new FormData(document.forms.namedItem("form"));
    Swal.fire({
        title: 'Confirma que desea pagar en la tienda?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Confirmo'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: site + "backoffice_new/planes/activar_tienda",
                method: "POST",
                data: oData,
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    var data = JSON.parse(data);
                    if (data.status == true) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: data.message,
                            showConfirmButton: false,
                        });
                        window.setTimeout(function () {
                            window.location = site + "backoffice_new/facturas";
                        }, 2500);
                    } else {
                        Swal.fire({
                            position: 'center',
                            icon: 'info',
                            title: data.message
                        });
                        document.getElementById("submit_tienda").disabled = false;
                        document.getElementById("submit_tienda").innerHTML = "<i class='fa fa-usd' aria-hidden='true'></i> Pagar con Monedero";
                    }
                }
            });
        } else {
            document.getElementById("submit_tienda").disabled = false;
            document.getElementById("submit_tienda").innerHTML = "<i class='fa fa-usd' aria-hidden='true'></i> Pagar con Monedero";
        }
    });
}

document.addEventListener("DOMContentLoaded", () => {
    let max_value = document.getElementById("subtotal_max").innerHTML
    let max = 0
    if (max_value.toLocaleLowerCase().includes("s/")) {
        max = parseFloat(max_value.replace(/s\/\./g, ''))
    } else {
        max = parseFloat(max_value)        
    }
    const inputsPay = Array.from(document.getElementsByClassName("input-pay"))
    const btn = document.getElementById("btn-pay")
    const error = document.getElementById("error_total")
    const alert = document.getElementById("content_alert")

    if (alert) {
        alert.style.display = "none"
        alert.style.display = "block"
    }

    if (btn) {
        btn.setAttribute('hidden', true);
    }

    if (error) {
        error.innerHTML = "Monto insuficiente"
    }

    function validate_pays() {
        const total = inputsPay.reduce((total, input) => {
            const inputValue = parseFloat(input.value) || 0;
            return total + inputValue;
        }, 0);

        if (total > max) {
            btn.setAttribute('hidden', true);

            if (alert) {
                alert.style.display = "block"
            }

            if (error) {
                error.innerHTML = "Monto excedido"
            }
        } else if (total < max) {
            btn.setAttribute('hidden', true);

            if (alert) {
                alert.style.display = "block"
            }

            if (error) {
                error.innerHTML = "Monto insuficiente"
            }
        } else {
            if (error.textContent.trim() !== "") {
                if (alert) {
                    alert.style.display = "none"
                }

                if (error) {
                    error.innerHTML = ""
                }

                btn.removeAttribute('hidden');
            }
        }
    }

    inputsPay.forEach(inputPay => {
        inputPay.addEventListener("input", () => validate_pays());
    });
})