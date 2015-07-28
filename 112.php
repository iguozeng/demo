<?php

	//移动
	//move_uploaded_file($_FILES['goods_pic']['tmp_name'],'./'.$_FILES['goods_pic']['name']);

	function upload($file){
		if($file['error']!=0){
			//echo '上传失败';
			//
			switch($file['error']){
				case 1: echo '文件超出php.ini的限制';break;
				case 2: echo '文件超出表单MAX_FILE_SIZE的限制';break;
				case 3: echo '文件没有上传完';break;
				case 4: echo '没有上传文件';break;
				case 6:
				case 7: echo '临时文件错误';break;
			}
			return false;
		}

		//判断类型
		$allow_types = array('image/jpeg','image/png','image/gif');
		if(!in_array($file['type'],$allow_types)){
			echo '类型不对';
			return false;
		}

		//判断大小
		$max_size = 100000; //100k
		if($file['size'] > $max_size){
			echo '文件过大';
			return false;
			
		}

		
		//处于安全性的考虑，判断是否是一个真正的上传文件；
		if(!is_uploaded_file($file['tmp_name'])){
			echo '上传文件可疑';
			return false;
		}

		//移动
		$dst_file = uniqid('upload_').strrchr($file['name'],'.');
		if(move_uploaded_file($file['tmp_name'],$dst_file)){
			return $dst_file;
		}else{
			echo '移动失败';
			return false; 
		}

	}


	$result = upload($_FILES['goods_pic']);
	var_dump($result);

?>