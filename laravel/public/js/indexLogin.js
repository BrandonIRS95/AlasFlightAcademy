$(function(){

'use strict';

// The following values are used to test as dummy data only so that
// we can fake a successful login…
var _boxyWrap = document.getElementById('boxy-login-wrapper');
var _boxyLoginForm = document.forms['boxy-login-form'];
var _boxyFormInner = $(_boxyLoginForm).find('div.boxy-form-inner');

//var _boxySide = jQuery.makeArray( $(_boxyFormInner).find('span.side') );
var _boxySide = $(_boxyFormInner).find('span.side');
var	_boxySideA = _boxySide[0],
	_boxySideB = _boxySide[1],
	_boxySideC = _boxySide[2],
	_boxySideD = _boxySide[3];

var _boxyInput;
var _boxyPassword;
var _boxyEmail;

var _boxyButton = [ $(_boxySideA).find('button.boxy-button').attr('data-step','0'),
					$(_boxySideB).find('button.boxy-button').attr('data-step','1'),
					$(_boxySideC).find('button.boxy-button').attr('data-step','2'),
					$(_boxySideC).find('input[name=remember-me]'),
					$(_boxySideC).find('label[for=remember-me]'),
					$(_boxySideD).find('button.boxy-button').attr('data-step','9')
					];

var _boxyEndCaps = $(_boxyFormInner).find('span.end-cap');

var _boxyLeftCap = $(_boxyEndCaps[0]);
var _boxyRightCap = $(_boxyEndCaps[1]);

var _toLogin = _boxyLeftCap.find('.glyphicon-user'),
	_okLogin = _boxyRightCap.find('.icon-success'),
	_badLogin = _boxyRightCap.find('.icon-failure');

var _boxyButtonA = _boxyButton[0],
	_boxyButtonB = _boxyButton[1],
	_boxyButtonC = _boxyButton[2],
	_boxyButtonD = _boxyButton[5];

var _boxyButtonInput = _boxyButton[3],
	_boxyButtonCombined = _boxyButton[4],
	_boxyMessage = $(_boxyWrap).find('em.small-forgot'),
	_rememberMeOp = $('input#remember-me');

var _checked = $(_boxyWrap).find('span.boxy-checked'),
	_unchecked = $(_boxyWrap).find('span.boxy-unchecked'),
	_boxyRefreshButton = $(_boxyWrap).find('.boxy-refresh'),
	_boxyForgot = $(_boxyWrap).find('.boxy-forgot');



var _toolTipOps = {'placement' : 'top',
					'data-html' : true,
					'data-animation' : true,
					'selector' : '[data-toggle=tooltip]',
					'trigger' : 'hover',
					'delay' : { 'show': 250,
								'hide': 150
							}
					};

// Inits Bootstrap Tooltips
$(_boxyWrap).tooltip( _toolTipOps );


// Sets focus on next available input field
$(_boxyFormInner).on('keydown', '#boxy-input , #boxy-password', function(evt) {

	  var keyCode = evt.keyCode || evt.which;

	  if (keyCode == 9) {
      evt.preventDefault();

	    $(this).next('button').click();

      $(this).parent().next('.side').find('input').focus();
	  }
});


$(_toLogin).on('click', function(evt){

		$(_boxyFormInner).removeClass('rotateFirst3d');
		$(this).next('.side').find('input').focus();
		//var _stepVal = Math.floor( $(this).attr('data-step') );
		evt.preventDefault();
		return false;
	});

	// Next -- Username field
	_boxyButtonA.on('click', function(evt){
		$(this).next('.side').find('input').focus();
		var _stepVal = Math.floor( $(this).attr('data-step') );
		evt.preventDefault();
		return validateForm(_stepVal);
	});

	// Next -- Password field
	_boxyButtonB.on('click', function(evt){
		var _stepVal = Math.floor( $(this).attr('data-step') );
		evt.preventDefault();
		return validateForm(_stepVal);
	});

	// OK button -- check login and submit
	_boxyButtonC.on('click', function(evt){
		var _stepVal = Math.floor( $(this).attr('data-step') );

		$(_boxyFormInner).addClass('rotate3d');

		evt.preventDefault();
		return validateForm(_stepVal);
	});

	_boxyButtonD.on('click', function(evt){
		var _stepVal = Math.floor( $(this).attr('data-step') );
		evt.preventDefault();
		return validateForm(_stepVal);
	});



function validateForm(_step){

	_boxyInput = document.forms['boxy-login-form']['email'];
	_boxyPassword = document.forms['boxy-login-form']['password'];


	if( $(_boxyWrap).hasClass('shake') ){
				$(_boxyWrap).removeClass('shake');
			}

	switch(_step){
		case 0:
/****************************************************************************************/
	// Checks to make sure we are passing a value for the username field
	if( !_boxyInput.value ){

    if( $(_boxyWrap).hasClass('shake') ){
        $(_boxyWrap).removeClass('shake');
      }
			$(_boxyWrap).addClass('shake');
			$(_boxyMessage).fadeIn('slow');

			document.getElementsByName('email')[0].placeholder = 'enter your username to continue';

	}else if( _boxyInput.value ){

			$(_boxyLoginForm).find('.boxy-form-inner').addClass('rotated90');
			$(_boxyMessage).fadeOut('slow');
	}
/****************************************************************************************/
		break;
		case 1:
/****************************************************************************************/
	if( !_boxyPassword.value ){

    if( $(_boxyWrap).hasClass('shake') ){
        $(_boxyWrap).removeClass('shake');
      }
		$(_boxyWrap).addClass('shake');
		$(_boxyMessage).fadeIn('slow');
		$(_boxyRefreshButton).fadeIn('slow');
		document.getElementsByName('password')[0].placeholder = 'enter your password to continue';

	}else if( _boxyPassword.value ){

    if( $(_boxyWrap).hasClass('shake') ){
        $(_boxyWrap).removeClass('shake');
      }

		$(_boxyLoginForm).find('.boxy-form-inner').addClass('rotated180');
		$(_boxyMessage).fadeOut('slow');
	}
/****************************************************************************************/
		break;
		case 2:
alert("nose por que aqui");
		break;
		case 9:
/****************************************************************************************/
	if( !_boxyEmail.value ){

      if( $(_boxyWrap).hasClass('shake') ){
        $(_boxyWrap).removeClass('shake');
      }

		$(_boxyWrap).addClass('shake');
		$(_boxyRefreshButton).fadeIn('slow');

		document.getElementsByName('email')[0].placeholder = 'enter your email for instructions';

	}else if( _boxyEmail.value ){

    if( $(_boxyWrap).hasClass('shake') ){
        $(_boxyWrap).removeClass('shake');
      }

		//$(_boxyRefreshButton).fadeOut('slow');
    $(_boxyLoginForm).find('.boxy-form-inner').addClass('rotated180');
		$(_boxyMessage).fadeOut('slow');
		$(_boxyRefreshButton).click();

	}
/****************************************************************************************/
		break;
	}
}
			$(_boxyRefreshButton).on('click',function(evt){

				if( $(this).hasClass('animate-refresh') ){
							$(this).removeClass('animate-refresh');
						}

				var _usernameInput = document.getElementsByName('email')[0];
				var _passwordInput = document.getElementsByName('password')[0];


				_boxyEndCaps.removeClass('boxy-failure').removeClass('boxy-success');

					$(this).addClass('animate-refresh');

					_usernameInput.placeholder = 'email';
					_passwordInput.placeholder = 'password';
				alert("entro en limpiar inputs");
					_usernameInput.value = '';
					_passwordInput.value = '';
					_emailInput.value = '';

					$(_boxyFormInner).removeClass('rotated90');
					$(_boxyFormInner).removeClass('rotated180');
					$(_boxyFormInner).removeClass('rotatedBack90');
					$(_boxyFormInner).removeClass('rotatedBack180');
					$(_boxyFormInner).removeClass('rotate3d');

					if( $(_boxyWrap).hasClass('shake') ){
                  $(_boxyWrap).removeClass('shake');
                }

					$(_boxyMessage).fadeOut('slow');
					$(_boxyRefreshButton).fadeOut('slow');

				var _disableInputs = $(_boxyFormInner).find('input');
					_disableInputs.removeAttr('disabled');

					evt.preventDefault();
				});


});


$('.glyphicon-user, .glyphicon-asterisk, .glyphicon-question-sign').on('click',function(evt){
			evt.preventDefault();
			var _setFocusInput = $(this).parent().find('input');

			return _setFocusInput.focus();
			});