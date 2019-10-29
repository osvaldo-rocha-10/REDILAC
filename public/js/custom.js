
function llamar_hora(){
	var fecha = new Date();
	hora = fecha.getHours();
	minuto = fecha.getMinutes();
	segundo = fecha.getSeconds();
	
	var a = document.getElementById("actualizable");
	
	a.innerHTML ="["+ fecha.getDate() + "/" + (fecha.getMonth()+1) + "/" + fecha.getFullYear()+"]     ["+hora+":"+minuto+":"+segundo+"]";
	
	setTimeout("llamar_hora()",1000);
}
 $("#FileIcono").change(function(e){
                 var ext = $("#FileIcono").val().split('.').pop();
                  if(ext == "jpg" || ext=="png" || ext=="jpeg" || ext=="gif" || ext=="raw"){
                     if($("#FileIcono")[0].files[0].size < 104857600){
                       var TmpPath = URL.createObjectURL(e.target.files[0]);
                      $('#ActualizarImagen').attr('src', TmpPath);
                      $("#Imagen2").attr('disabled','disabled');
                      $('#Imagen2').css('background', '#9C9A99');
                      $('#Imagen2').css('color', 'white');
                     }else{
                          alert("La imagen excede el tamaño maximo. Por favor verifica");
                     }
                  }else{
                    alert("Seleccione una imagen o extension valida");
                  }    
    });
	

        

         $("#FileArchivo").change(function(){
              var ext = $("#FileArchivo").val().split('.').pop();
              if(ext == "pdf" || ext=="docx" || ext=="doc" || ext=="xlsx" || ext=="avi" || ext=="mp3" || ext=="mp4" || ext=="txt" || ext=="mov" || ext=="wmv" || ext=="xlsm" || ext=="html" || ext=="onetoc2"
			    || ext == "pptx" || ext==".pptm"){
                  if($("#FileArchivo")[0].files[0].size < 104857600){
                     var filename = $('#FileArchivo').val()
                    $('#ActualizarArchivo').html('Archivo Seleccionado: '+ filename);
                  }else{
                       alert("El tamaño  excede el tamaño maximo. Por favor verifica");
                  }  
              }else{
                alert("Seleccione un archivo o extension valida");
              }
           
        });
		 
		 
		$("#image").change(function(){
	        $('#subir').css({'opacity':'1.0',});
	        $('#subir').prop('disabled', false);
	    });
		
		 $("#ImportExcel").change(function(){
              var ext = $("#ImportExcel").val().split('.').pop();
			  
              if(ext=="xls" || ext=="xlsx" || ext=="xslm" || ext=="xltx" || ext=="xml"){
                  if($("#ImportExcel")[0].files[0].size < 104857600){
                     var filename = $('#ImportExcel').val()
                    $('#ActualizarExcel').html('Archivo Seleccionado: '+ filename);
	                $('#subir').css({
						                    'opacity':'1.0',
					    });
				   $('#subir').prop('disabled', false);
                  }else{
                       alert("El tamaño  excede el tamaño maximo. Por favor verifica");
                  }  
              }else{
                alert("Seleccione un archivo o extension valida");
              } 
        });
		
		
	  $("#TipoEquipo").change(function(){
            var tipo = $(this).find(':selected').data('id');
			if(tipo==1){
                             $('.oculto').show();
                       }else{
                             $('.oculto').hide();
                       }
      });
	  
	    $("#FileFormato").change(function(){
              var ext = $("#FileFormato").val().split('.').pop();
              if(ext == "pdf" || ext=="docx" || ext=="doc"){
                  if($("#FileFormato")[0].files[0].size < 104857600){
                     var filename = $('#FileFormato').val()
                    $('#ActualizarFormato').html('Formato Seleccionado: '+ filename);
					 $('#subir').css({
						                    'opacity':'1.0',
					    });
				   $('#subir').prop('disabled', false);
                  }else{
                       alert("El tamaño  excede el tamaño maximo. Por favor verifica");
                  }  
              }else{
                alert("Seleccione un formato o extension valida");
              }
           
        });
		
  function marcar(source) 
	{
		checkboxes=document.getElementsByTagName('input'); //obtenemos todos los controles del tipo Input
		for(i=0;i<checkboxes.length;i++) //recoremos todos los controles
		{
			if(checkboxes[i].type == "checkbox") //solo si es un checkbox entramos
			{
				checkboxes[i].checked=source.checked; //si es un checkbox le damos el valor del checkbox que lo llamó (Marcar/Desmarcar Todos)
			}
		}
	}
		
	 
