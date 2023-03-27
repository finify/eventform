<?php $this->start('head');?>
<meta content="test">
<style>
    @font-face {
    font-family: myFirstFont;
    src: url(<?=PROOT?>assets/css/adineue-PRO-Bold.ttf);
    }
  
    h2 {
        font-family: myFirstFont !important;
        
    }
    h4 {
        font-family: myFirstFont !important;
    }

    em {
        font-family: myFirstFont !important;
        
    }

    svg {
	 width: 100px;
	 display: block;
	 margin: 40px auto 0;
}
 .path {
	 stroke-dasharray: 1000;
	 stroke-dashoffset: 0;
}
 .path.circle {
	 -webkit-animation: dash .9s ease-in-out;
	 animation: dash .9s ease-in-out;
}
 .path.line {
	 stroke-dashoffset: 1000;
	 -webkit-animation: dash .9s .35s ease-in-out forwards;
	 animation: dash .9s .35s ease-in-out forwards;
}
 .path.check {
	 stroke-dashoffset: -100;
	 -webkit-animation: dash-check .9s .35s ease-in-out forwards;
	 animation: dash-check .9s .35s ease-in-out forwards;
}
 p {
	 text-align: center;
	 margin: 20px 0 60px;
	 font-size: 1.25em;
}
 p.success {
	 color: #73AF55;
}
 p.error {
	 color: #D06079;
}
 @-webkit-keyframes dash {
	 0% {
		 stroke-dashoffset: 1000;
	}
	 100% {
		 stroke-dashoffset: 0;
	}
}
 @keyframes dash {
	 0% {
		 stroke-dashoffset: 1000;
	}
	 100% {
		 stroke-dashoffset: 0;
	}
}
 @-webkit-keyframes dash-check {
	 0% {
		 stroke-dashoffset: -100;
	}
	 100% {
		 stroke-dashoffset: 900;
	}
}
 @keyframes dash-check {
	 0% {
		 stroke-dashoffset: -100;
	}
	 100% {
		 stroke-dashoffset: 900;
	}
}
 

</style>
<?php $this->end();?>

<?php $this->start('body');?>
	<!-- Form -->
	<section class="multi_step_form" style="background-image: url('<?=PROOT?>assets/img/background.jpg'); object-fit: cover;">
      <form id="msform" style="background: rgba(162, 154, 154, 0.49); object-fit: cover;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover; opacity: 0.99;
  box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
backdrop-filter: blur(7.4px);
-webkit-backdrop-filter: blur(7.4px);
  
  ">

  <div class="bg-image"></div>
        <!-- Tittle -->
        <div class="tittle">
            <img src="<?=PROOT?>assets/img/adidas.png" width="100px" alt="">
          <h2 style="font-size:40px; margin-top:15px;">Welcome</h2>
        </div>
        <h4>
            Sorry we are maxed out for the event but .... </br>
          </h4>
          <em> This will only take you a few seconds to complete</em>
        
        <fieldset>
            <h3>Enter Information</h3>
            <div class="form-group fg_2">
                <input
                id="email_address"
                type="Email"
                class="form-control"
                placeholder="Enter Email Address"
                />
            </div>
            <div class="form-group fg_2">
                <input
                id="full_name"
                type="text"
                class="form-control"
                placeholder="Enter Full Name"
                />
            </div>
            <div class="form-group fg_2">
                <input type="checkbox" id="subscribe"/> <span>Subscribe to our newsletter</span>
            </div>
            <center>
            <div class="loader"></div>
            </center>
            <span class="form-group" id="submit_new">Submit</span>

            <svg class="success" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                <circle class="path circle" fill="none" stroke="#73AF55" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1"/>
                <polyline class="path check" fill="none" stroke="#73AF55" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 "/>
            </svg>
            <h2 class="success">Your Details have been submitted successfully</h2>
            <h4 class="success">Please Check your Email to confirm this invitation</h4>

            <svg class="failed" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                <circle class="path circle" fill="none" stroke="#D06079" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1"/>
                <line class="path line" fill="none" stroke="#D06079" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="34.4" y1="37.9" x2="95.8" y2="92.3"/>
                <line class="path line" fill="none" stroke="#D06079" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="95.8" y1="38" x2="34.4" y2="92.2"/>
            </svg>
            <h2 class="failed">Sorry but Email address already exists in our Database</h2>
            <h4 class="failed">Please refresh this page and choose a different email</h4>
            
            
                
            <!-- <div id="mail">

            </div> -->
            
                
            
          
          <!-- <a href="#" class="action-button">Finish</a> -->
        </fieldset>
      </form>
    </section>
		<!-- /Form -->

    <!-- partial -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.2/js/intlTelInput.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>
    <script src="<?=PROOT?>assets/js/script.js"></script>

    <script>
            $(document).ready(function(){
                $(".loader").toggle();
                $('#cont').prop('disabled', true);
                $("#maxed").css("display","none");

                $(".failed").css("display","none");
                $(".success").css("display","none");
                
                $("#cont").css("display","none");
                $("#submit_btn").css("display","none");

                $("#submit_new").click(function(){
                    
                    var email_address = $("#email_address").val();  
                    var full_name = $("#full_name").val();  
                    var Event_Day = 0;
                    var confirmed1 = false;
                    var confirmed2 = false;

                    if(document.getElementById('subscribe').checked) {
                        var checked = 1;
                    } else {
                        var checked = 0;
                    }

                    $(".failed").css("display","none");
                    $(".success").css("display","none");

                    $(".error").remove();
                    if (email_address.length < 1) {  
                        $('#email_address').after('<span class="error">This field is required</span>');  
                    } else {  
                        var regEx = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;  
                        var validEmail = regEx.test(email_address);  
                        if (!validEmail) {  
                            $('#email_address').after('<span class="error">Enter a valid email</span>');  
                        }else{
                            confirmed1 = true;
                        } 
                    }

                    if (full_name.length < 1) {  
                        $('#full_name').after('<span class="error">This field is required</span>');  
                    }else{
                        confirmed2 = true; 
                    }  

                    if(confirmed1 && confirmed2){
                        $(".loader").toggle();
                        $.ajax({
                            url : '<?=PROOT?>api/addnew',
                            type: "POST",
                            data: { event_day: Event_Day, email_address : email_address, full_name: full_name, subscribe: checked  },
                            success: function (result) {
                                if (result != "") {
                                    $(".loader").toggle();
                                   
                                    let data = JSON.parse(JSON.stringify(result));
                                    console.log(data);
                                    let status = data.status;
                                    

                                    if(status == 'foundemail'){
                                        $(".failed").css("display","block");
                                        $(".form-group").css("display","none");
                                    }else if(status == 'inserted'){
                                        $(".success").css("display","block");
                                        $(".form-group").css("display","none");
                                        // let mail = data.mail;
                                        // $("#mail").append(mail);
                                    }
                                   
                                } 
                                
                            },
                            error: function(xhr, textStatus, errorThrown) {
                                console.log(xhr.statusText);
                                console.log(textStatus);
                                console.log(errorThrown);
                            }
                        });
                    }

                    
                });

            });
    </script>
        
<?php $this->end();?>