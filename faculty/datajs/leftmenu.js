function show_tab(tone,ttwo,bone,btwo) {
	//alert(tone);
	$(ttwo).hide();	
	$(tone).show();	
	
	//alert();
	$(btwo).removeClass('active');
	//$(tone).removeClass('active');
	$(bone).addClass('active');
}


$(document).ready(function()
		{
		// Using GetJSON
		//var url="http://localhost/phonegap/database/json.php";
		var menu = '<li><a href="index.html" class="close-panel"><img src="images/icons/red/home.png" alt="" title="" /><span>Home</span></a></li><li><a href="#" class="close-panel"><img src="images/icons/red/electronics.png" alt="" title="" /><span>Dashboard</span></a></li><li><a href="assignment.html" class="close-panel"><img src="images/icons/red/features.png" alt="" title="" /><span>Assignment</span></a></li><li><a href="attendance.html" class="close-panel"><img src="images/icons/red/categories.png" alt="" title="" /><span>Attendance</span></a></li><li><a href="notice.html" class="close-panel"><img src="images/icons/red/blog.png" alt="" title="" /><span>Notice</span></a></li><li><a href="subject.html" class="close-panel"><img src="images/icons/red/menu.png" alt="" title="" /><span>Subject</span></a></li><li><a href="classplan.html" class="close-panel"><img src="images/icons/red/tabs.png" alt="" title="" /><span>Class Plan</span></a></li><li><a href="marksheet.html" class="close-panel"><img src="images/icons/red/tables.png" alt="" title="" /><span>Marksheet</span></a></li><li><a href="complain.html" class="close-panel"><img src="images/icons/red/shop.png" alt="" title="" /><span>Complain</span></a></li><li><a href="holyday.html" class="close-panel"><img src="images/icons/red/building.png" alt="" title="" /><span>Holiday</span></a></li>';
		
		$("#sidemenu").append(menu);
		
		var RIGHTmenu = '<li><a href="features.html" class="close-panel"><img src="images/icons/red/settings.png" alt="" title="" /><span>Account Settings</span></a></li><li><a href="features.html" class="close-panel"><img src="images/icons/red/briefcase.png" alt="" title="" /><span>My Account</span></a></li><li><a href="features.html" class="close-panel"><img src="images/icons/red/message.png" alt="" title="" /><span>Messages</span><strong>12</strong></a></li><li><a href="features.html" class="close-panel"><img src="images/icons/red/love.png" alt="" title="" /><span>Favorites</span><strong>5</strong></a></li><li><a href="logout.html" class="close-panel"><img src="images/icons/red/lock.png" alt="" title="" /><span>Logout</span></a></li>';
		
		$("#rightmenu").append(RIGHTmenu);
		
	});