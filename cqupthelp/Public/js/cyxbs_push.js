 $(document).ready(function(){
               
            });       
			 function sendPushall(){
                var data = $('form#all').serialize();
                $('form#all').unbind('submit');  
				             
                $.ajax({
                    url: "send.php?action=send",
                    type: 'GET',
                    data: data,
                    beforeSend: function() {
						
						   html = "<b>��ȴ������ڷ����С���</b>";
						    $('.info').html(html);
                        
                    },
                    success: function(data, textStatus, xhr) {
                         // $('.txt_message').val("");						  
						  $('.info').html(data);
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        
                    }
                });
                return false;
            } 