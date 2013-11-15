 
 $(function() {
        $("#controlSaveLink").fancybox({
            'padding': 3,
            'titleShow'     : false, 
            'openEffect'  : 'elastic',
            'openSpeed' : 100,
            'closeSpeed' : 100,
            'closeEffect' : 'elastic',
            'centerOnScroll' : true,
            'modal' : true,
            'helpers' : { title: null,
                          overlay: { opacity: 0.35,
                                     css: { 'background-color' : '#ffffff' }
                                   }
                        }
        });
}); 
 
 
function saveOrder() {
    $('#controlSaveLink').trigger('click');    
}

function saveConfirm() {
  var n = gID('ousr_name').value;
  var e = gID('ousr_email').value;
  gID('save_status').style.display = 'none';
  gID('save_status_b').style.display = 'block';
  
    
  $.post("process.php", $("#frmDesignUpload").serialize(),
  function(data) {
    $.post("designsaveprocess.php", { usr_name: n, usr_email: e },
       function(data) {
         gID('save_status_b').innerHTML = data;
         $("#saveBtn").val('Saved');
         $("#saveBtn").attr("disabled", true);
       });
  });
}

function saveCancel() {
    $.fancybox.close();    
    saveReset();
}

function saveReset() {
    gID('save_status_b').style.display = 'none';
    gID('save_status').style.display = 'block';
    $("#saveBtn").val('Save Design');    
    $("#saveBtn").attr("disabled", false);
}
