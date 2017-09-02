$(document).ready(function(){


		var timestamp = Math.floor(Date.now() / 1000);
		$("#trackingNumber").html(timestamp);
		$("#transactionVal").html(timestamp);

	$("#closeWindow").on("click",function(){

		var timestamp = Math.floor(Date.now() / 1000);
		$("#trackingNumber").html(timestamp);
		$("#transactionVal").html(timestamp);

		for (var i = 0; i < $("input").length; i++) {
			$("input").removeClass('accepted');
			$("input").removeClass('missing');
		}
		$(".alert ").hide(500);	

	});

	$("#closeWindowAlert").on("click",function(){
		$(".alert").hide(500);

		var timestamp = Math.floor(Date.now() / 1000);

		for (var i = 0; i < $("input").length; i++) {
			// $("input").removeClass('accepted');
			// $("input").removeClass('missing');
		}


	});

	$("#newTransaction").on("click",function(){
		var timestamp = Math.floor(Date.now() / 1000);
		$("#trackingNumber").html(timestamp);
		$("#transactionVal").html(timestamp);

		for (var i = 0; i < $("input").length; i++) {
			$("input").removeClass('accepted');
			$("input").removeClass('missing');
		}
		$(".alert ").hide(500);	

	});


	$("#btnSendPackage").on("click",function(){

		var trackingNumber = $("#trackingNumber").text();
		var sender = $("#sender").val();
		var sno = $("#sno").val();
		var semail = $("#semail").val();
		var sadd = $("#sadd").val();
		var receiver = $("#receiver").val();
		var rno = $("#rno").val();
		var remail = $("#remail").val();
		var radd = $("#radd").val();
		var size = $("#size option:selected").text();
		var sizeCheck = $("#size").val();
		var areaCheck = $("#area").val();
		var area = $("#area option:selected").text();
		var amount = $("#amount").val();

			var charge = 0;
			var areas = "";
			var sizes = "";
			var ins = 0;
			var s = $("#size").val();
			var a = $("#area").val();;
			var income = 0;



			if(s == 1 && a == 1) {
				charge = 200;
			}
			else if(s == 1 && (a == 2 || a == 3)) {
				charge = 255;
			}

			else if(s == 1 && (a == 4 || a == 5)) {
				charge = 265;
			}

			else if(s == 2 && a == 1) {
				charge = 325;
			}
			else if(s == 2 && (a == 2 || a == 3)) {
				charge = 400;
			}

			else if(s == 2 && (a == 4 || a == 5)) {
				charge = 435;
			}

			else if(s == 3 && a == 1) {
				charge = 600;
			}
			else if(s == 3 && (a == 2 || a == 3)) {
				charge = 800;
			}

			else if(s == 3 && (a == 4 || a == 5)) {
				charge = 870;
			}

			else if(s == 4 && a == 1) {
				charge = 1235;
			}
			else if(s == 4 && (a == 2 || a == 3)) {
				charge = 1425;
			}

			else if(s == 4 && (a == 4 || a == 5)) {
				charge = 1558;
			}


			ins = (amount/500)*50;
			income = charge + ins;


		if (trackingNumber == "" || sender == "" || sno == "" || semail == "" || sadd == "" || receiver == "" || rno == "" || remail == "" || radd == "" || sizeCheck == "" || areaCheck == "" || amount == "") {

			if (sender == "") {
				$("#sender").addClass('missing');
			} else {
				$("#sender").removeClass('missing');
			}	

			if (sno == "") {
				$("#sno").addClass('missing');
			} else {
				$("#sno").removeClass('missing');
			}	

			if (semail == "") {
				$("#semail").addClass('missing');
			} else {
				$("#semail").removeClass('missing');
			}	

			if (sadd == "") {
				$("#sadd").addClass('missing');
			} else {
				$("#sadd").removeClass('missing');
			}	

			if (receiver == "") {
				$("#receiver").addClass('missing');
			} else {
				$("#receiver").removeClass('missing');
			}	

			if (rno == "") {
				$("#rno").addClass('missing');
			} else {
				$("#rno").removeClass('missing');
			}	

			if (remail == "") {
				$("#remail").addClass('missing');
			} else {
				$("#remail").removeClass('missing');
			}	

			if (radd == "") {
				$("#radd").addClass('missing');
			} else {
				$("#radd").removeClass('missing');
			}	

			if (sizeCheck == "") {
				$("#size").addClass('missing');
			} else {
				$("#size").removeClass('missing');
			}	

			if (areaCheck == "") {
				$("#area").addClass('missing');
			} else {
				$("#area").removeClass('missing');
			}	

			if (amount == "") {
				$("#amount").addClass('missing');
			} else {
				$("#amount").removeClass('missing');
			}	
			$(".alert-danger").show(500);

		}else {

			console.log(trackingNumber);
			console.log(sender);
			console.log(sno);
			console.log(semail);
			console.log(sadd);
			console.log(receiver);
			console.log(rno);
			console.log(remail);
			console.log(size);
			console.log(area);
			console.log(amount);
			console.log(charge);
			console.log(ins);

			var xhr = new XMLHttpRequest();
			xhr.onreadystatechange = function(){

				if (xhr.readyState == 1 || xhr.readyState == 2 || xhr.readyState == 3){

					$(".alert-danger").html("sending sms and email to the receiver. please wait...");
					$(".alert-danger").show(500);
				}

				else if (xhr.readyState == 4 && xhr.status == 200) {
					
					$("#transactionVal").val(trackingNumber);
					$("#chargeVal").text(charge);
					$(".alert-danger").hide(500);
					$(".alert-success").show(500);
					$("#trackingNumber").html(""); $("#sender").val(""); $("#sno").val(""); $("#semail").val(""); $("#sadd").val(""); $("#receiver").val(""); $("#rno").val(""); $("#remail").val(""); $("#radd").val(""); $("#amount").val("");
					$("#size").val("Choose Size"); $("#area").val("Choose Destination"); 

				}	
			}
			xhr.open("GET","ajaxRequest.php?trackingNumber="+trackingNumber+"&sender="+sender+"&sno="+sno+"&semail="+semail+"&sadd="+sadd+"&receiver="+receiver+"&rno="+rno+"&remail="+remail+"&radd="+radd+"&size="+size+"&area="+area+"&amount="+amount+"&charge="+charge+"&insurance="+ins,true);
			xhr.send();

			// $.ajax({
			// 	type: "GET",
			// 	url: "ajaxRequest.php",
			// 	data: {trackingNumber: trackingNumber, sender: sender, sno: sno, semail: semail, sadd: sadd, receiver: receiver, rno: rno, 
			// 		remail: remail,radd: radd, size: size, area: area, amount: amount, charge: charge, insurance: ins},
			// 	success: function(result){

			// 		$("#transactionVal").val(trackingNumber);
			// 		$("#chargeVal").text(charge);
			// 		$(".alert-danger").hide(500);
			// 		$(".alert-success").show(500);
			// 		$("#trackingNumber").html(""); $("#sender").val(""); $("#sno").val(""); $("#semail").val(""); $("#sadd").val(""); $("#receiver").val(""); $("#rno").val(""); $("#remail").val(""); $("#radd").val(""); $("#amount").val("");
			// 		$("#size").val("Choose Size"); $("#area").val("Choose Destination"); 
			// 	}
			// });

		}

	});
 

	$("#btnSendMoney").on("click",function(){


		var trackingNumber = $("#trackingNumber").text();
		var sender = $("#sender").val();
		var sno = $("#sno").val();
		var receiver = $("#receiver").val();
		var rno = $("#rno").val();
		var remail = $("#remail").val();
		var amount = $("#amount").val();
		var charge = $("#charge").val();
		var bpickup = $("#bpickup").val();


		if(trackingNumber == "" || sender == "" || sno == "" || receiver == "" || remail == "" || amount == "" || charge == "" || bpickup == "") {

			if (sender == "") {
				$("#sender").addClass('missing');
			} else {
				$("#sender").removeClass('missing');
			}

			 if (sno == "") {
				$("#sno").addClass('missing');
			}else {
				$("#sno").removeClass('missing');
			}

			 if (receiver == "") {
				$("#receiver").addClass('missing');
			}else {
				$("#receiver").removeClass('missing');
			}

			 if (rno == "") {
				$("#rno").addClass('missing');
			}else {
				$("#rno").removeClass('missing');
			}

			if (isValidEmailAddress(remail) && remail != ""){
				$("#remail").removeClass('missing');
			}else {
				$("#remail").addClass('missing');
			}

			 if (amount == "") {
				$("#amount").addClass('missing');
			}else {
				$("#amount").removeClass('missing');
			}


			 if (charge == "") {
				$("#charge").addClass('missing');
			}else {
				$("#chargeVal").removeClass('missing');
			}

			 if (bpickup == "") {
				$("#bpickup").addClass('missing');
			}else {
				$("#bpickup").removeClass('missing');
			}
			$(".alert-danger").show(500);

		}else {


			var xhr = new XMLHttpRequest();
			xhr.onreadystatechange = function(){

				if (xhr.readyState == 1 || xhr.readyState == 2 || xhr.readyState == 3){

					$(".alert-danger").html("sending sms and email to the receiver. please wait...");
					$(".alert-danger").show(500);
				}

				else if (xhr.readyState == 4 && xhr.status == 200) {
					
					$("#transactionVal").val(trackingNumber);
					$("#chargeVal").text(charge);
					$(".alert-danger").hide(500);
					$(".alert-success").show(500);
					$("#trackingNumber").html(""); $("#sender").val(""); $("#sno").val(""); $("#receiver").val(""); $("#rno").val(""); $("#remail").val(""); $("#amount").val(""); $("#charge").val("");$("#bpickup").val("");
					console.log(xhr.responseText);
				}	
			}
			xhr.open("GET","ajaxRequest.php?trackingNumber="+trackingNumber+"&sender="+sender+"&sno="+sno+"&receiver="+receiver+"&rno="+rno+"&remail="+remail+"&amount="+amount+"&charge="+charge+"&bpickup="+bpickup,true);
			xhr.send();

			// $.ajax({
			// 	type: "GET",
			// 	url: "ajaxRequest.php",
			// 	data: {trackingNumber: trackingNumber, sender: sender, sno: sno, receiver: receiver, rno: rno, remail: remail, amount: amount, charge: charge, bpickup: bpickup},
			// 	success: function(result){

			// 		$("#transactionVal").val(trackingNumber);
			// 		$("#chargeVal").text(charge);
			// 		$(".alert-danger").hide(500);
			// 		$(".alert-success").show(500);
			// 		$("#trackingNumber").html(""); $("#sender").val(""); $("#sno").val(""); $("#receiver").val(""); $("#rno").val(""); $("#remail").val(""); $("#amount").val(""); $("#charge").val("");$("#bpickup").val("");
			// 	}
			// });
		}


	});


	$("#amount").on("blur",function(){
		
		var amount = $("#amount").val();

		if (amount <= 100) {
			$("#charge").val("6");
		}else if (amount <= 200){
			$("#charge").val("15");
		}else if (amount <= 300){
			$("#charge").val("20");
		}else if (amount <= 400){
			$("#charge").val("25");
		}else if (amount <= 500){
			$("#charge").val("30");
		}else if (amount <= 600){
			$("#charge").val("35");
		}else if (amount <= 700){
			$("#charge").val("40");
		}else if (amount <= 800){
			$("#charge").val("45");
		}else if (amount <= 1000){
			$("#charge").val("50");
		}else if (amount <= 1500){
			$("#charge").val("75");
		}else if (amount <= 2000){
			$("#charge").val("100");
		}else if (amount <= 2500){
			$("#charge").val("125");
		}else if (amount <= 3000){
			$("#charge").val("150");
		}else if (amount <= 4000){
			$("#charge").val("180");
		}else {
			$("#charge").val("220");
		}

	});

});



	function validate(val) {

		var x = $(val);
		if (x.val() == ""){
			x.addClass('missing');
		}else {
			x.removeClass('missing');
		}
	}

	function isValidEmailAddress(emailAddress) {
	    var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
	    return pattern.test(emailAddress);
	
	};


	 function PrintDiv() {    
       var divToPrint = document.getElementById('divToPrint');
       var popupWin = window.open('', '_blank', 'width=300,height=300');
       popupWin.document.open();
       popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
        popupWin.document.close();
     
     }


function viewDetails(x){
	
	var tnumber = x;
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function(){
		if (xhr.readyState == 4 && xhr.status == 200) {

			$("#content").fadeOut(300,function(){
				$("#content").html(xhr.responseText);
				$("#content").slideDown(300);
			});
		
		}	
	}
	xhr.open("GET","ajaxRequest.php?viewDetails="+tnumber,true);
	xhr.send();

}


function editRemittance(x){

	var tnumber = x;
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function(){
		if (xhr.readyState == 4 && xhr.status == 200) {
			
			$("#content").fadeOut(300,function(){
				$("#content").html(xhr.responseText);
				$("#content").slideDown(300);
			});
		}	
	}
	xhr.open("GET","ajaxRequest.php?editRemittance="+tnumber,true);
	xhr.send();
}

function updateStatus(x){

	var tnumber = x;
	var choice = $("#updateChoice").val();
	
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function(){
		if (xhr.readyState == 4 && xhr.status == 200) {
			
			$(".alert-success").html("Successfully Updated.");
			$(".alert-success").show(500);
			$(".alert-success").delay(3000).hide(500);
			
			if (xhr.responseText == "MoneyRemittance"){
				displayMoneyRemittance();
			}else{
				displayPackageRemittance();
			}
	
		}	
	}
	xhr.open("GET","ajaxRequest.php?edit="+tnumber+"&choice="+choice,true);
	xhr.send();


}

function deleteRecord(x){
	var tnumber = x;
	
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function(){
		if (xhr.readyState == 4 && xhr.status == 200) {
			
			$(".alert-success").html("Reservation successlly moved to achive.");
			$(".alert-success").show(500);
			$(".alert-success").delay(3000).hide(500);

			if (xhr.responseText == "MoneyRemittance"){
				displayMoneyRemittance();
			}else{
				displayPackageRemittance();
			}
			
			$(".formDesign").slideUp("slow",function(){
				$(".formDesign").html("");

			})	
		}	
	}
	xhr.open("GET","ajaxRequest.php?moveToArchive="+tnumber,true);
	xhr.send();


}


function deleteRemittance(x){

	$("#content").fadeOut(300,function(){
		$("#content").html('<div class="formDesign"><center><h1 class="title">'+x+'</h1><h2>are you sure you want to delete this record?</h2><button class="btn btn-danger" onclick="deleteRecord('+x+')">Confirm Delete</button> <button class="btn btn-primary" onclick="cancelWindow()">Cancel</button></center></div>');
		$("#content").fadeIn(300);
	});
	
}

function cancelWindow(){
	$("#content").fadeOut("slow",function(){
		$("#content").html("");
		$("#content").show("slow");
	})
}

function displayMoneyRemittance(){

	var tnumber = "x";
	
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function(){
		if (xhr.readyState == 4 && xhr.status == 200) {
			
			$("#tableContent").html(xhr.responseText);

		}	
	}
	xhr.open("GET","ajaxRequest.php?displayMoneyRemittance="+tnumber,true);
	xhr.send();
}



function displayPackageRemittance(){

	var tnumber = "x";
	
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function(){
		if (xhr.readyState == 4 && xhr.status == 200) {
			
			$("#tableContent").html(xhr.responseText);

		}	
	}
	xhr.open("GET","ajaxRequest.php?displayPackageRemittance="+tnumber,true);
	xhr.send();


}

function searchTnumber(){

	var tnumber =$("#tnumber").val();
	
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function(){
		if (xhr.readyState == 4 && xhr.status == 200) {
			
			$("#displayDetails").fadeOut(300,function(){
				$("#displayDetails").html(xhr.responseText);
				$("#displayDetails").fadeIn(300);
				
			});

		}	
	}
	xhr.open("GET","ajaxRequest.php?searchTnumber="+tnumber,true);
	xhr.send();

}

function lookupTNumber(){
	var tnumber =$("#tnumber").val();

	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function(){
		if (xhr.readyState == 4 && xhr.status == 200) {
			
			$("#displayDetails").fadeOut(300,function(){
				$("#displayDetails").html(xhr.responseText);
				$("#displayDetails").fadeIn(300);
				
			});

		}	
	}
	xhr.open("GET","ajaxRequest.php?lookupTNumber="+tnumber,true);
	xhr.send();

	
}

function claimMoneyRemittance(x){

	var tnumber =$("#tnumber").val();

	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function(){

		if (xhr.readyState == 1 || xhr.readyState == 2 || xhr.readyState == 3){

			$("#displayDetails").html("<center><label>sending sms to the sender of the remittance.<br/> please wait...</label></center>");
			$("#displayDetails").show(500);
		}
		

		else if (xhr.readyState == 4 && xhr.status == 200) {

			$("#displayDetails").fadeOut(300,function(){
				$("#displayDetails").html(xhr.responseText);
				$("#displayDetails").fadeIn(300);
				
			});

		}	
	}
	xhr.open("GET","ajaxRequest.php?claimMoneyRemittance="+tnumber,true);
	xhr.send();
}

function claimPackageRemittance(x){

	var tnumber =$("#tnumber").val();

	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function(){

		if (xhr.readyState == 1 || xhr.readyState == 2 || xhr.readyState == 3){

			$("#displayDetails").html("<center><label>sending sms to the sender of the remittance.<br/> please wait...</label></center>");
			$("#displayDetails").show(500);
		}

		else if (xhr.readyState == 4 && xhr.status == 200) {
			
			$("#displayDetails").fadeOut(300,function(){
				$("#displayDetails").html(xhr.responseText);
				$("#displayDetails").fadeIn(300);
				
			});

		}	
	}
	xhr.open("GET","ajaxRequest.php?claimPackageRemittance="+tnumber,true);
	xhr.send();
}

function searchMoneyTNumber(){

	var tnumber = $("#searchTNumber").val();
	
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function(){
		if (xhr.readyState == 4 && xhr.status == 200) {
			

			$("#tableContent").fadeOut(300,function(){
			$("#tableContent").html(xhr.responseText);
			$("#tableContent").fadeIn(300);
			});
			$("#searchTNumber").val("");

		}	
	}
	xhr.open("GET","ajaxRequest.php?searchMoneyTNumber="+tnumber,true);
	xhr.send();

}

function searchPackageTNumber(){

	var tnumber = $("#searchTNumber").val();
	
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function(){
		if (xhr.readyState == 4 && xhr.status == 200) {
			

			$("#tableContent").fadeOut(300,function(){
			$("#tableContent").html(xhr.responseText);
			$("#tableContent").fadeIn(300);
			});
			$("#searchTNumber").val("");

		}	
	}
	xhr.open("GET","ajaxRequest.php?searchPackageTNumber="+tnumber,true);
	xhr.send();

}


// -------------navbar-----------------

(function($) {

  $.fn.menumaker = function(options) {
      
      var cssmenu = $(this), settings = $.extend({
        title: "Menu",
        format: "dropdown",
        breakpoint: 768,
        sticky: false
      }, options);

      return this.each(function() {
        cssmenu.find('li ul').parent().addClass('has-sub');
        if (settings.format != 'select') {
          cssmenu.prepend('<div id="menu-button">' + settings.title + '</div>');
          $(this).find("#menu-button").on('click', function(){
            $(this).toggleClass('menu-opened');
            var mainmenu = $(this).next('ul');
            if (mainmenu.hasClass('open')) { 
              mainmenu.hide().removeClass('open');
            }
            else {
              mainmenu.show().addClass('open');
              if (settings.format === "dropdown") {
                mainmenu.find('ul').show();
              }
            }
          });

          multiTg = function() {
            cssmenu.find(".has-sub").prepend('<span class="submenu-button"></span>');
            cssmenu.find('.submenu-button').on('click', function() {
              $(this).toggleClass('submenu-opened');
              if ($(this).siblings('ul').hasClass('open')) {
                $(this).siblings('ul').removeClass('open').hide();
              }
              else {
                $(this).siblings('ul').addClass('open').show();
              }
            });
          };

          if (settings.format === 'multitoggle') multiTg();
          else cssmenu.addClass('dropdown');
        }

        else if (settings.format === 'select')
        {
          cssmenu.append('<select style="width: 100%"/>').addClass('select-list');
          var selectList = cssmenu.find('select');
          selectList.append('<option>' + settings.title + '</option>', {
                                                         "selected": "selected",
                                                         "value": ""});
          cssmenu.find('a').each(function() {
            var element = $(this), indentation = "";
            for (i = 1; i < element.parents('ul').length; i++)
            {
              indentation += '-';
            }
            selectList.append('<option value="' + $(this).attr('href') + '">' + indentation + element.text() + '</option');
          });
          selectList.on('change', function() {
            window.location = $(this).find("option:selected").val();
          });
        }

        if (settings.sticky === true) cssmenu.css('position', 'fixed');

        resizeFix = function() {
          if ($(window).width() > settings.breakpoint) {
            cssmenu.find('ul').show();
            cssmenu.removeClass('small-screen');
            if (settings.format === 'select') {
              cssmenu.find('select').hide();
            }
            else {
              cssmenu.find("#menu-button").removeClass("menu-opened");
            }
          }

          if ($(window).width() <= settings.breakpoint && !cssmenu.hasClass("small-screen")) {
            cssmenu.find('ul').hide().removeClass('open');
            cssmenu.addClass('small-screen');
            if (settings.format === 'select') {
              cssmenu.find('select').show();
            }
          }
        };
        resizeFix();
        return $(window).on('resize', resizeFix);

      });
  };
})(jQuery);

(function($){
$(document).ready(function(){

$(document).ready(function() {
  $("#cssmenu").menumaker({
    title: "Menu",
    format: "dropdown"
  });

  $("#cssmenu a").each(function() {
  	var linkTitle = $(this).text();
  	$(this).attr('data-title', linkTitle);
  });
});

});
})(jQuery);



// end of navbar---------------------

function registerAccount(){
	var name = $("#fname").val();
	var username = $("#username").val();
	var password = $("#password").val();
	var type = $("#type").val();

	if (name == "" || username == "" || password == "" || type == "") {

		$(".alert").slideUp(200,function(){
			$(this).html("Please fill up all the forms");
			$(this).slideDown(500);
			$(this).delay(1000).slideUp(500);
		});

	}else {

		var xhr = new XMLHttpRequest();
		xhr.onreadystatechange = function(){

			if (xhr.readyState == 4 && xhr.status == 200) {

				if (xhr.responseText == "existing"){
					$(".alert").slideUp(200,function(){
						$(this).removeClass("alert-success");
						$(this).addClass("alert-danger");
						$(this).html("Username already exist.");
						$(this).slideDown(500);
						$(this).delay(1000).slideUp(500);
					});
				}else {
					$(".alert").slideUp(200,function(){
						$(this).removeClass("alert-danger");
						$(this).addClass("alert-success");
						$(this).html("Successfully registered.");
						$(this).slideDown(500);
						$(this).delay(1000).slideUp(500);
					});
				}				
			}
		}	

		xhr.open("GET","ajaxRequest.php?name="+name+"&username="+username+"&password="+password+"&type="+type,true);
		xhr.send();

	}

}

//ctr ung pang count kpag nag kakamali ng  type ng password ung staff
ctr = 0
function loginAccount(){
	//kunin muna ung inputtext data sa html
	var un = $("#username").val();
	var pw = $("#password").val();

	//validate lang kung walang laman
	if (un == "" | pw == "") {

		// mag aalert lang kapag empty field ung inputtext
		$(".alert").html("Some forms are missing.");
		$(".alert").show(500);		

	}else {
			//kapg may laman ung un at pw, ajax call na
			var xhr = new XMLHttpRequest();
			xhr.onreadystatechange = function(){
				//eto ung simula ng mga alert depende dun sa ibabatong data na galing sa ajaxRequest
				if (xhr.readyState == 4 && xhr.status == 200) {

					//eto ung kapag incorrect ung pw, mag ccoung ng plus 1 ung ctr tpos mag aalert lang 
					if (xhr.responseText == "staffIncorrectPassword"){
						ctr++;
						if((3-ctr) != 0) {
							//.html ung babaguhin ung content ng html
							$(".alert").html("Password mismatch. Tries Left: "+" "+(3-ctr));
							$(".alert").show(500);
							//ung delay as is sya. iddelay muna ung command for a sec tpos eexcute ung hide function
							$(".alert").delay(1000).hide(500);					
						} else {
							// eto ung kapag morethan 3 tries na ung staff/ ma bblock na
							$.ajax({
								type: "GET",
								url: "ajaxRequest.php",
								data: {usernameToBlock:un}, // etong line na to ung mag babato ng data sa ajaxRequest, keys and values
								success: function(result){
									console.log(result);
								}
							});
							//eto ung alert na nablock na ung staff
							$(".alert").html("You are block from using the system.Contact the admin for assistance in retrieving access to your account.");
							$(".alert").show(500);
							$(".alert").delay(3000).hide(500);
							ctr = 0
						}
						// eto ung ggawin kapag mali ung password ng admin, d mag ccount ung ctr
					} else if (xhr.responseText == "adminIncorrectPassword") {

							$(".alert").html("Password password is mismatch admin");
							$(".alert").show(500);
							$(".alert").delay(1000).hide(500);
						//eto ung alert na ssabihin kpag block ung binato ng ajax			
					}else if (xhr.responseText == "block"){
							$(".alert").html("Your account is block. Please contract the admin for assistance.");
							$(".alert").show(500);	
							$(".alert").delay(3000).hide(500);
						//eto naman kpag not found/ lahat ng mga to nanggaling sa ajax / php
					}else if (xhr.responseText == "notfound"){
							$(".alert").html("Username not found.");
							$(".alert").show(500);	
							$(".alert").delay(1000).hide(500);
					//eto ung mag sset ng session pra sa admin
					}else if (xhr.responseText == "admin"){
						$(".alert").removeClass("alert-danger");
						$(".alert").addClass("alert-success");
						$(".alert").html("Information Accepted. Loggin in...");
						$(".alert").show(500);
						ctr = 0;
						setSession(un,"admin");
						//redirect to dashboard. // access admin

					// eto ung mag sset ng session pra sa staff
					} else if (xhr.responseText == "staff") {
						$(".alert").removeClass("alert-danger");
						$(".alert").addClass("alert-success");
						$(".alert").html("Information Accepted. Loggin in...");
						$(".alert").show(500);
						ctr = 0;
						setSession(un,"staff");
						//redirect to dashboard. // access staff
					}else {

						//eto kung skali lang na mag error
						$(".alert").html("for unknown reason we got some error. Sorry for the inconvenience.");
						$(".alert").show(500);
						ctr = 0;
					}
				}	
			}
			//eto ung data na ibabato sa php (ajaxRequest.php)
			xhr.open("GET","ajaxRequest.php?loginAccount="+un+"&pw="+pw,true);
			xhr.send();

	}

}
//eto ung sa set session, pra lang matawag mo sa buong dashboard pag kailangan
function setSession(username,access){
	console.log(username + " " + access);
		
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function(){

		//kpag set na mag rredirect lang sya sa redirect.php // may sleep function lang pra mag kickin ung session
		//mablis kasi masyado ung ajax kaya dapat may ganito pra gumana ung session sa dashboard.
		if (xhr.readyState == 4 && xhr.status == 200) {
			window.location.replace("redirect.php");
		}	
	}
	//same ajax request lang din
	xhr.open("GET","ajaxRequest.php?setSessionUn="+username+"&setSessionAccess="+access,true);
	xhr.send();
}

function openModal(){



	var tnumber = $("#transactionVal").text();
	
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function(){
		if (xhr.readyState == 4 && xhr.status == 200) {

			$(".modal-content").html(xhr.responseText);
			$(".modal").slideDown(500);
		}	
	}
	xhr.open("GET","ajaxRequest.php?printReceipt="+tnumber,true);
	xhr.send();

}

function closeModal(){
	$(".modal").slideUp(500);
}


$("#btnPrint").printPreview({
	                obj2print:'.divToPrint',
	                top: 0,
	                height: '500px'

	});



function deleteUser(x){

	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function(){
		if (xhr.readyState == 4 && xhr.status == 200) {
			
				$("#notification").html(xhr.responseText);
				$(".alert").slideDown(500);
				loadUsersContent();
				$(".alert").delay(2000).slideUp(500);
				
		}	
	}
	xhr.open("GET","ajaxRequest.php?usernameToDelete="+x,true);
	xhr.send();
}

function changeAccess(x){

	var y = x.split("*");
	var action = y[0];
	var user = y[1];
	
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function(){
		if (xhr.readyState == 4 && xhr.status == 200) {
			
				$("#notification").html(xhr.responseText);
				$(".alert").slideDown(500);
				loadUsersContent();
				$(".alert").delay(4000).slideUp(500);
				
		}	
	}
	xhr.open("GET","ajaxRequest.php?changeAccess="+user+"&action="+action,true);
	xhr.send();

}

function changeLevel(x){

	var y = x.split("*");
	var action = y[0];
	var user = y[1];
	
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function(){
		if (xhr.readyState == 4 && xhr.status == 200) {
			
				$("#notification").html(xhr.responseText);
				$(".alert").slideDown(500);
				loadUsersContent();
				$(".alert").delay(4000).slideUp(500);
				
		}	
	}
	xhr.open("GET","ajaxRequest.php?changeLevel="+user+"&action="+action,true);
	xhr.send();
}


function loadUsersContent(){

	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function(){
		if (xhr.readyState == 4 && xhr.status == 200) {
			
				$("#usersContent").html(xhr.responseText);
		}	
	}
	xhr.open("GET","ajaxRequest.php?loadUsers=yes",true);
	xhr.send();
}

function deleteCompletely(x){
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function(){
		if (xhr.readyState == 4 && xhr.status == 200) {
			
			$(".alert").slideDown(500);
			loadArchive();
			$(".alert").delay(2000).slideUp(500);

		}	
	}
	xhr.open("GET","ajaxRequest.php?deleteCompletely="+x,true);
	xhr.send();
}

function loadArchive(){

	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function(){
		if (xhr.readyState == 4 && xhr.status == 200) {
			
			$("#archiveContent").html(xhr.responseText);
		}	
	}
	xhr.open("GET","ajaxRequest.php?loadArchive=yes",true);
	xhr.send();
}

function searchTnumberHome(){

	var tnumber =$("#tnumber").val();

	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function(){
		if (xhr.readyState == 4 && xhr.status == 200) {
			
			$("#displayDetails").fadeOut(300,function(){
				$("#displayDetails").html(xhr.responseText);
				$("#displayDetails").fadeIn(300);
				
			});

		}	
	}
	xhr.open("GET","ajaxRequest.php?searchTnumberHome="+tnumber,true);
	xhr.send();

}

function updateInformation(){
	var orig = $("#origUsername").text();
	var n = $("#name").val();
	var un = $("#username").val();
	var pw = $("#password").val();

	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function(){
		if (xhr.readyState == 4 && xhr.status == 200) {
			$(".alert-info").show(500);
			$(".alert-info").delay(4000).hide(500);
		}	
	}
	xhr.open("GET","ajaxRequest.php?updateName="+n+"&updateUsername="+un+"&updatePassword="+pw+"&orig="+orig,true);
	xhr.send();

}