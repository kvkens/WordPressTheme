<?php 
		$option = get_option('blogname');
		if( $option == '' ){   
		$option ='主标题';   
		update_option('blogname', $option);
			}   
		if(isset($_POST['submit'])){   
		$option = stripslashes($_POST['blogname']);   
		update_option('blogname', $option);
		}

		$option = get_option('blogdescription');
		if( $option == '' ){   
		$option ='副标题';   
		update_option('blogdescription', $option);
			}   
		if(isset($_POST['submit'])){   
		$option = stripslashes($_POST['blogdescription']);   
		update_option('blogdescription', $option);
		}
	//logo
		$option = get_option('muLogo');
		if( $option == '' ){   
		$option =get_stylesheet_directory_uri().'/images/logo.png';   
		update_option('muLogo', $option);
			}   
		if(isset($_POST['submit'])){   
		$option = stripslashes($_POST['muLogo']);   
		update_option('muLogo', $option);
		}
	//footer
		$option = get_option('footerText');
		if( $option == '' ){   
		$option ='底部一行';   
		update_option('footerText', $option);
			}   
		if(isset($_POST['submit'])){   
		$option = stripslashes($_POST['footerText']);   
		update_option('footerText', $option);
		}
		//key
		$option = get_option('muKey');
		if( $option == '' ){   
		$option ='关键字';   
		update_option('muKey', $option);
			}   
		if(isset($_POST['submit'])){   
		$option = stripslashes($_POST['muKey']);   
		update_option('muKey', $option);
		}
	//描述
		$option = get_option('muDescript');
		if( $option == '' ){   
		$option ='网站描述';   
		update_option('muDescript', $option);
			}   
		if(isset($_POST['submit'])){   
		$option = stripslashes($_POST['muDescript']);   
		update_option('muDescript', $option);
		}
	//幻灯片
		$option = get_option('banCh');
		if( $option == '' ){   
		$option ='';   
		update_option('banCh', $option);
			}   
		if(isset($_POST['submit'])){   
		$option = stripslashes($_POST['banCh']);   
		update_option('banCh', $option);
		}
	//相关文章
		$option = get_option('xgCh');
		if( $option == '' ){   
		$option ='';   
		update_option('xgCh', $option);
			}   
		if(isset($_POST['submit'])){   
		$option = stripslashes($_POST['xgCh']);   
		update_option('xgCh', $option);
		}
		//lgo后副标题
		$option = get_option('fbCh');
		if( $option == '' ){   
		$option ='';   
		update_option('fbCh', $option);
			}   
		if(isset($_POST['submit'])){   
		$option = stripslashes($_POST['fbCh']);   
		update_option('fbCh', $option);
		}
		//ImgCh
		$option = get_option('ImgCh');
		if( $option == '' ){   
		$option ='2';   
		update_option('ImgCh', $option);
			}   
		if(isset($_POST['submit'])){   
		$option = stripslashes($_POST['ImgCh']);   
		update_option('ImgCh', $option);
		}
		
 ?>