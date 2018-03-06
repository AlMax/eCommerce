$(function() {
    $('#login-form-link').click(function(e) {
      $("#login-form").delay(100).fadeIn(100);
   		$("#register-form").fadeOut(100);
  		$('#register-form-link').removeClass('active');
  		$(this).addClass('active');
  		e.preventDefault();
	});
	$('#register-form-link').click(function(e) {
		$("#register-form").delay(100).fadeIn(100);
 		$("#login-form").fadeOut(100);
		$('#login-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});
});

function ruolo(){
  if(!document.getElementById("usernameL").value.localeCompare("ResponsabileMagazzino") && !document.getElementById("passwordL").value.localeCompare("Magazzino")){
    form=document.getElementById('login-form');
    form.target='_blank';
    form.action='magazzino.php';
    form.submit();
  }else if(!document.getElementById("usernameL").value.localeCompare("ResponsabileMarketing") && !document.getElementById("passwordL").value.localeCompare("Marketing")){
    form=document.getElementById('login-form');
    form.target='_blank';
    form.action='marketing.php';
    form.submit();
  }else if(!document.getElementById("usernameL").value.localeCompare("ResponsabileSpedizioni") && !document.getElementById("passwordL").value.localeCompare("Spedizioni")){
    form=document.getElementById('login-form');
    form.target='_blank';
    form.action='spedizioni.php';
    form.submit();
  }else if(!document.getElementById("usernameL").value.localeCompare("ResponsabileOrdinazione") && !document.getElementById("passwordL").value.localeCompare("Ordinazione")){
    form=document.getElementById('login-form');
    form.target='_blank';
    form.action='ordine.php';
    form.submit();
  }else{
    form=document.getElementById('login-form');
    form.target='_blank';
    form.action='acquisti.php';
    form.submit();
  }
};
