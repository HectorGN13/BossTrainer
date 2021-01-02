<?php

use antkaz\vue\VueAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii2assets\pdfjs\PdfJs;

/* @var $this yii\web\View */
/* @var $model common\models\Gym */

VueAsset::register($this);
?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
<script>
    function CreatePDFfromHTML() {
        var HTML_Width = $(".html-content").width();
        var HTML_Height = $(".html-content").height();
        var top_left_margin = 15;
        var PDF_Width = HTML_Width + (top_left_margin * 2);
        var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
        var canvas_image_width = HTML_Width;
        var canvas_image_height = HTML_Height;

        var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

        html2canvas($(".html-content")[0]).then(function (canvas) {
            var imgData = canvas.toDataURL("image/jpeg", 1.0);
            var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
            pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
            for (var i = 1; i <= totalPDFPages; i++) {
                pdf.addPage(PDF_Width, PDF_Height);
                pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
            }
            pdf.save("invoice.pdf");
            $(".html-content").hide();
        });
    }
</script>
<div id="content" ref="content" class="invoice-box html-content" class="vue">
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="4">
                <table>
                    <tr>
                        <td class="title">
                            <img src="<?= $model->profile_img ?>" style="width:100%; max-width:300px;">
                        </td>

                        <td>
                            Fecha: {{ timestamp }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="information">
            <td colspan="4">
                <table>
                    <tr>
                        <td>
                            <?= Html::encode($model->name) ?><br>
                            <?= Html::encode($model->address) ?><br>
                            Sanlucar de Bda, Cádiz <br>
                            11540 <br>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="heading">
            <td colspan="3">Método de pago</td>
            <td>#</td>
        </tr>

        <tr class="details">
            <td colspan="3"><select v-model="selected">
                    <option disabled value="">Seleccione un elemento</option>
                    <option>Tarjeta</option>
                    <option>Efectivo</option>
                    <option>Bizum</option>
                </select></td>
            <td><span>{{ selected }}</span></td>
        </tr>

        <tr class="heading">
            <td>Item</td>
            <td>Precio unitario</td>
            <td>Cantidad</td>
            <td>Precio</td>
        </tr>

        <tr class="item" v-for="item in items">
            <td><input v-model="item.description" /></td>
            <td><input type="number" v-model="item.price" /> €</td>
            <td><input type="number" v-model="item.quantity" /></td>
            <td>{{ item.price * item.quantity | currency }} €</td>
        </tr>

        <tr>
            <td colspan="4">
                <button class="btn-add-row" @click="addRow">Añadir fila</button>
            </td>
        </tr>

        <tr class="total">
            <td colspan="3"></td>
            <td>Total: {{ total | currency }} €</td>
        </tr>
    </table>
</div>
<div class="container my-5">
    <div class="vue">
        <div class="d-flex justify-content-center">
            <button onclick="CreatePDFfromHTML()" class="btn btn-lg btn-dark">Descargar PDF</button>
        </div>
    </div>
</div>

<script>
    const app = new Vue({
        el: "table",
        data: {
            items: [
                { description: "Descripción", quantity: 1, price: 0 },
            ],
            selected: '',
            timestamp: '',
        },
        created() {
            setInterval(this.getNow, 1000);
        },
        computed: {
            total() {
                return this.items.reduce(
                    (acc, item) => acc + item.price * item.quantity,
                    0
                );
            }
        },
        methods: {
            addRow() {
                this.items.push({ description: "", quantity: 1, price: 0 });
            },
            getNow() {
                const today = new Date();
                const date = today.getDate()+'/'+(today.getMonth()+1)+'/'+today.getFullYear();
                const time = today.getHours() + ":" + today.getMinutes();
                this.timestamp = date + ' a las ' + time;
            },
            download() {
                const doc = new jsPDF();
                /** WITH CSS */
                var canvasElement = document.createElement('canvas');
                html2canvas(this.$refs.content, { canvas: canvasElement
                }).then(function (canvas) {
                    const img = canvas.toDataURL("image/jpeg", 0.8);
                    doc.addImage(img,'JPEG',20,20);
                    doc.save("invoice.pdf");
                });
            },
        },
        filters: {
            currency(value) {
                return value.toFixed(2);
            }
        }
    });

    var vue_det = new Vue({
        el: '#intro',
        data: {
            timestamp: ""
        },
        created() {
            setInterval(this.getNow, 1000);
        },
        methods: {
            getNow: function() {
                const today = new Date();
                const date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
                const time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
                const dateTime = date +' '+ time;
                this.timestamp = dateTime;
            }
        }
    });
</script>