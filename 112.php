<?php

	//�ƶ�
	//move_uploaded_file($_FILES['goods_pic']['tmp_name'],'./'.$_FILES['goods_pic']['name']);

	function upload($file){
		if($file['error']!=0){
			//echo '�ϴ�ʧ��';
			//
			switch($file['error']){
				case 1: echo '�ļ�����php.ini������';break;
				case 2: echo '�ļ�������MAX_FILE_SIZE������';break;
				case 3: echo '�ļ�û���ϴ���';break;
				case 4: echo 'û���ϴ��ļ�';break;
				case 6:
				case 7: echo '��ʱ�ļ�����';break;
			}
			return false;
		}

		//�ж�����
		$allow_types = array('image/jpeg','image/png','image/gif');
		if(!in_array($file['type'],$allow_types)){
			echo '���Ͳ���';
			return false;
		}

		//�жϴ�С
		$max_size = 100000; //100k
		if($file['size'] > $max_size){
			echo '�ļ�����';
			return false;
			
		}

		
		//���ڰ�ȫ�ԵĿ��ǣ��ж��Ƿ���һ���������ϴ��ļ���
		if(!is_uploaded_file($file['tmp_name'])){
			echo '�ϴ��ļ�����';
			return false;
		}

		//�ƶ�
		$dst_file = uniqid('upload_').strrchr($file['name'],'.');
		if(move_uploaded_file($file['tmp_name'],$dst_file)){
			return $dst_file;
		}else{
			echo '�ƶ�ʧ��';
			return false; 
		}

	}


	$result = upload($_FILES['goods_pic']);
	var_dump($result);

?>