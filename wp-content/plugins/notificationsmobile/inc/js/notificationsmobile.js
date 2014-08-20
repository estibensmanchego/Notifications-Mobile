jQuery(document).ready(function($) {

	jQuery( "#tabs" ).tabs({
      beforeLoad: function( event, ui ) {
        ui.jqXHR.error(function() {
          ui.panel.html(
            "Couldn't load this tab. We'll try to fix this as soon as possible. " +
            "If this wouldn't be a demo." );
        });
      },
      load: function ( event, ui ) {
      	DIALOG.loadDialog();
      }
    });

	//Jquery UI Dialog
	var DIALOG = {
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
			$( "#users tbody" ).append( "<tr>" +
			  "<td>" + categoria.val() + "</td>" +
			"</tr>" );
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

	}}

    // lOAD DIALOG

	DIALOG.loadDialog();
	
});