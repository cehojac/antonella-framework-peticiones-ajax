<?php
    namespace PJAX;
          
    class AjaxController
    {
    
        public function __construct()
        {
    
        }

        public function MostrarBoton()
        {
            $html = <<<EOT

<form method="POST">
<h1>Probamos nuestro AJAX</h1>
<div class="form-group">
<label for="valor1">Valor para enviar por AJAX</label>
<input type="text" class="form-control" id="valor1" name="valor1" value="">
<small id="emailHelp" class="form-text text-muted">Puedes poner aqui tu valor para enviar por ajax</small>
</div>
<button type="submit" name="enviar_ajax" class="btn btn-primary">Enviar</button>
</form>
<script type="text/javascript">
   jQuery("form").submit(function(e) {
   e.preventDefault(); // evita que se ejecute el formulario

    var form = jQuery(this);
    var url = form.attr('action');

    jQuery.ajax({
           type: "POST",
           url: "{$ajax_url}/?action=mi_peticion_ajax",
           data: form.serialize(), 
           success: function(data)
           {
		   		console.log( data);
             
           }
         });
	});
 
</script>

EOT;

return $html;
        }

        public function procesar_ajax()
        {
            $post	= isset($_POST)?$_POST:"";
            $response	= array();
            $response['message']	= "Successfull Request";
            $response['values']     = $post;
            wp_send_json($response);
            exit;
        }
    }