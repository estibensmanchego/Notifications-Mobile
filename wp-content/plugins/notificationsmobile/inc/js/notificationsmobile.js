jQuery(document).ready(function($) {
	
	//Jquery UI Dialog
	var DIALOG = {
		anyWhere: function () {
			$( "#datepicker" ).datepicker({
		      showOn: "button",
		      buttonImage: "/wp-content/plugins/notificationsmobile/inc/img/date.png",
		      buttonImageOnly: true,
		      buttonText: "Select date"
		    });
		}, 
		loadDialog: function() {	
			var dialog, form,

			categoria = $( "#categoria" ),
			allFields = $( [] ).add( categoria ),
			tips = $( ".validateTips" );

			function updateTips( t ) {
				tips
				.text( t )
				.addClass( "ui-state-highlight" );
				setTimeout(function() {
				tips.removeClass( "ui-state-highlight", 1500 );
				}, 500 );
			}

			function checkRegexp( o, regexp, n ) {
				if ( !( regexp.test( o.val() ) ) ) {
					o.addClass( "ui-state-error" );
					updateTips( n );
					return false;
				} else {
					return true;
				}
			}

			function addUser() {
			var valid = true;
			allFields.removeClass( "ui-state-error" );

			valid = valid && checkRegexp( categoria, /^[aA-zZ]([0-9a-z_\s])+$/i, "Categoria puede consistir en a-z, 0-9, subraya, espacios y debe comenzar con una letra." );

			if ( valid ) {
				//Ajax WP
				var data = {
					'action': 'my_action',
					'whatever': 1234
				};

				// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
				$.post(ajaxurl, data, function(response) {
					$( "#academico" ).append( "<option>" + response + "</option>" );					
				});

				dialog.dialog( "close" );
			}
				return valid;
			}

			dialog = $( "#dialog-form" ).dialog({
				autoOpen: false,
				height: 300,
				width: 350,
				modal: true,
				buttons: {
					"Crear": addUser,
					Cancelar: function() {
				  		dialog.dialog( "close" );
					}
				},
				Cerrar: function() {
					form[ 0 ].reset();
					allFields.removeClass( "ui-state-error" );
				}
			});

			form = dialog.find( "form" ).on( "submit", function( event ) {
				event.preventDefault();
				addUser();
			});

			$( ".add-cat" ).button().on( "click", function() {
				dialog.dialog( "open" );
				return false;
			}); 

		},
		hoverDelete: function () {
			var tspan = $('#listmatriculas li span');
			var tli = $('#listmatriculas li');
			tspan.hide();
			tli.hover(function() {
				$(this).append('<span>x</span>');
				$(this).find('span').show()
			}, function() {
				$(this).find('span').hide().remove();
			});
		}

	}

    // lOAD DIALOG
    DIALOG.anyWhere();
	DIALOG.loadDialog();	
	
});