function submit_data() {
 
 
        //$("#insert").click(function(){
            var username=$("#username").val();
            var password=$("#password").val();
			
					
            var dataString="username="+username+"&password="+password+"&mode=login";
			//alert("http://swsinc.in/FBO/phonegap/insert_content_review.php?"+dataString);
            if($.trim(username).length>0 & $.trim(password).length>0 )
            {
                $.ajax({
                    type: "POST",
                    url: BaseURL+"faculty_login.php?",
                    //url:"http://localhost/phonegap/database/insert.php",
                    data: dataString,
                    crossDomain: true,
                    cache: false,
                    beforeSend: function(){ $("#login").val('Connecting...');},
                    success: function(data){
                        if(data=="authorized")
                        {
                            
                            $("#login").val('submit');
							$("#username").val('') ;
							$("#password").val('') ;
							$.session.set('session_id', username);
							$(location).attr('href', 'dashboard.html');
                        }
                        else if(data=="auth_failed")
                        {
                            alert("Invalid Login...Please try again");
							$("#login").val('submit');
							$("#username").val('') ;
							$("#password").val('') ;
                        } 
						
                    }
                });
            } else {
			 alert("Please fill the form properly");
			} return false;
			
            //});
    
 }