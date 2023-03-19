<?php $this->start('head');?>
<meta content="test">
<?php $this->end();?>

<?php $this->start('body');?>

    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="#">
          <img src="<?=PROOT?>assets/img/bcode.png" width="100px" class="d-inline-block align-top" alt="">
        </a>
      </nav>
    <!-- <div id="result_strip">
        <ul class="thumbnails"></ul>
    </div> -->
    <div id="interactive" class="viewport"></div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" data-backdrop="false">
        <div class="modal-dialog" role="document">
            <center>
                <img id="loading_img" style="display:none;" src="https://media.tenor.com/On7kvXhzml4AAAAj/loading-gif.gif" width="50px" height="50px">
            </center>
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                            <img class="d-block w-100" id="productimage" src="" alt="First slide">
                            </div>
                            
                        </div>
                    </div>

                    <div>
                        <h2 class="modal-price"></h2>
                        <h5 class="modal-vendor"></h5>
                        <h5 class="modal-sku"></h5>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Scan New</button>
                </div>
            </div>
        </div>
    </div>


     <!-- jQuery first, then Popper.js, then Bootstrap JS -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://webrtc.github.io/adapter/adapter-latest.js" type="text/javascript"></script>
    <script src="<?=PROOT?>assets/js/quagga.min.js" type="text/javascript"></script>

    <script>
        Quagga.init({
            inputStream : {
                name : "Live",
                type : "LiveStream",
                target: document.querySelector('#interactive'),    // Or '#yourElement' (optional)
                constraints: {
                    width: 480,
                    height: 320,
                    facingMode: "environment"
                },
            },
            decoder : {
                readers: [
                        "code_128_reader",
                        "ean_reader",
                        "ean_8_reader"
                    ]
            },
            locate: true,
        }, function(err) {
            if (err) {
                console.log(err);
                return
            }
            // console.log("Initialization finished. Ready to start");
            Quagga.start();
            Quagga.onProcessed(function(result) {
                var drawingCtx = Quagga.canvas.ctx.overlay,
                    drawingCanvas = Quagga.canvas.dom.overlay;

                if (result) {
                    if (result.boxes) {
                        drawingCtx.clearRect(0, 0, parseInt(drawingCanvas.getAttribute("width")), parseInt(drawingCanvas.getAttribute("height")));
                        result.boxes.filter(function (box) {
                            return box !== result.box;
                        }).forEach(function (box) {
                            Quagga.ImageDebug.drawPath(box, {x: 0, y: 1}, drawingCtx, {color: "green", lineWidth: 2});
                        });
                    }

                    if (result.box) {
                        Quagga.ImageDebug.drawPath(result.box, {x: 0, y: 1}, drawingCtx, {color: "#00F", lineWidth: 2});
                    }

                    if (result.codeResult && result.codeResult.code) {
                        Quagga.ImageDebug.drawPath(result.line, {x: 'x', y: 'y'}, drawingCtx, {color: 'red', lineWidth: 3});
                        let myAudio = new Audio('sound.mp3');
                        myAudio.play();

                        
                    }
                }
            });
            var lastResult = null;

            Quagga.onDetected(function(result) {
                var code = result.codeResult.code;

                if (lastResult !== code) {
                    lastResult = code;
                   

                    if(code.length >= 12){
                        $("#loading_img").toggle();
                        $.ajax({
                            url : '<?=PROOT?>api',
                            type: "POST",
                            data: { sku: code },
                            success: function (result) {
                                $("#loading_img").toggle();
                                if (result != "") {
                                    let data = JSON.parse(JSON.stringify(result));
                                    console.log(data);
                                    let Variant_SKU = data.Variant_SKU;
                                    let Title = data.Title;
                                    let Variant_Image = data.Variant_Image ;
                                    let Variant_Price = data.Variant_Price;
                                    let Vendor = data.Vendor;



                                    $("#productimage").attr("src", Variant_Image);
                                    $("h5.modal-title").html("<b>"+Title+"</b>");
                                    $("h2.modal-price").html("<b>₦"+Variant_Price+"</b>");
                                    $("h5.modal-vendor").html("By:"+Vendor);
                                    $("h5.modal-sku").html("SKU:"+Variant_SKU);

                                    $('#exampleModalLong').modal('show');
                                    Quagga.stop();
                                } 
                                
                            },
                            error: function(xhr, textStatus, errorThrown) {
                                console.log(xhr.statusText);
                                console.log(textStatus);
                                console.log(errorThrown);
                            }
                        });
                    }
                }
            });
        });
        $('#exampleModalLong').on('hidden.bs.modal', function (e) {
            location.reload();
        });
        
    </script>

   
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  
<?php $this->end();?>
