<?php 
		$numm = get_option('ggNum');
		for($n=1;$n<=$numm;$n++){
			$option = get_option('ggCh'.$n.'');
			if( $option == '' ){   
			$option ='';   
			update_option('ggCh'.$n.'', $option);
				}   
			if(isset($_POST['submit'])){   
			$option = stripslashes($_POST['ggCh'.$n.'']);   
			update_option('ggCh'.$n.'', $option);
			}
			
			//ggCon1
			$option = get_option('ggCon'.$n.'');
			if( $option == '' ){   
			$option ='公告';   
			update_option('ggCon'.$n.'', $option);
				}   
			if(isset($_POST['submit'])){   
			$option = stripslashes($_POST['ggCon'.$n.'']);   
			update_option('ggCon'.$n.'', $option);
			}
			
			
		}
		//ggNUM
		$option = get_option('ggNum');
		if( $option == '' ){   
		$option ='1';   
		update_option('ggNum', $option);
			}   
		if(isset($_POST['submit'])){   
		$option = stripslashes($_POST['ggNum']);   
		update_option('ggNum', $option);
		}
		
		
 ?>