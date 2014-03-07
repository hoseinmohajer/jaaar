<?php
class JaaarsController extends AppController{
	var $name = 'jaaar';
	public $helpers = array('Html', 'Form', 'Session');
	public function index(){
		
		App::import('Vendor', 'jdf');
		$this->loadModel('Jaaar');
		$query = $this->Jaaar->query("show table status from jaaar");
		if($query[0]['TABLES']['Rows'] == '0'){
			$this->downloader();
		}
		//$query = $this->Jaaar->find('all', array('limit' => 1,'order'=>array('id DESC')));
		$newspaper_names = array('ابتکار' => 'ابتکار','اقتصاد پویا' => 'اقتصاد پویا','جوان' => 'جوان','صنعت' => 'صنعت','حمایت' => 'حمایت'
									,'روزان' => 'روزان','فرهیختگان' => 'فرهیختگان','قانون' =>'قانون','کسب و کار' =>'کسب و کار','ابرار' =>'ابرار');
		$this->set('newspaper_names', $newspaper_names);					
	}
	public function downloader(){
		App::import('Vendor', 'jdf');
		$newspaper_codes = array(
									 '82cec960.jpg' 
									,'48aedb88.jpg' 
									,'9b861925.jpg' 
									,'bd686fd6.jpg' 
									,'f7e6c855.jpg' 
									,'d1f255a3.jpg' 
									,'82161242.jpg' 
									,'d2ed45a5.jpg' 
									,'c2aee861.jpg' 
									,'fb7b9ffa.jpg' 
								);
		$newspaper_names = array(
									'ابتکار'			
									,'اقتصاد پویا'
									,'جوان'
									,'صنعت'
									,'حمایت'
									,'روزان'
									,'فرهیختگان' 		
									,'قانون' 			
									,'کسب و کار' 			
									,'ابرار'	
								);
		//generate timestamp of 1-1-1392
		//echo jmktime( 0 , 0 , 0 , 1 , 1 , 1392 ); //1363820400
		/**************START raveshe aval******************/
		/*
		for($count = 0; $count<10; $count++){
			for($day = 0; $day<365; $day++){
				$time = (1363820400 + (86400 * $day));
				if(jdate("D", $time, '', '' ,'en') != 'ج'){
					@$file = file('http://www.jaaar.com/assets/images/pishkhan/' . jdate('Y/n/j', $time, '', '' ,'en') . '/' . $newspaper_codes[$count]);
					if(!empty($file)){	
						@$jaaar_image = chunk_split(base64_encode(file_get_contents('http://www.jaaar.com/assets/images/pishkhan/' . jdate('Y/n/j', $time, '', '' ,'en') . '/' . $newspaper_codes[$count])));
						if(isset($jaaar_image) && !empty($jaaar_image)){	
							$image_info = explode('/', 'http://www.jaaar.com/assets/images/pishkhan/' . jdate("Y/n/j", $time, '', '' ,'en') . '/' . $newspaper_codes[$count]);
							$image_date = $image_info['6'] . '/' . $image_info['7'] . '/' . $image_info['8'];
							$image_name = $image_info['9'];
							$image_data = array();
							$image_data['Jaaar']['date'] = $image_date;
							$image_data['Jaaar']['image_name'] = $image_name;
							$image_data['Jaaar']['image_data'] = $jaaar_image;
							$image_data['Jaaar']['newspaper_names'] = $newspaper_names[$count];
							$image_data['Jaaar']['url'] = 'http://www.jaaar.com/assets/images/pishkhan/' . jdate("Y/n/j", $time, '', '' ,'en') . '/' . $newspaper_codes[$count];
							$this->loadModel('Jaaar');
							$this->Jaaar->create();
						    $this->Jaaar->save($image_data);
						}
					}
				}
			}
		}*/
		/**************END raveshe aval********************/
		
		/**************START raveshe dovoom******************/
		
		$i = 0;
		for($count = 0; $count <= 10; $count++){
			for($day = 0; $day < 365; $day++){
				$time = (1363820400 + (86400 * $day));
				if(jdate("D", $time, '', '' ,'en') != 'ج'){
					@$file = file('http://www.jaaar.com/assets/images/pishkhan/' . jdate('Y/n/j', $time, '', '' ,'en') . '/' . $newspaper_codes[$count]);
					if(!empty($file)){	
						@$jaaar_image = chunk_split(base64_encode(file_get_contents('http://www.jaaar.com/assets/images/pishkhan/' . jdate('Y/n/j', $time, '', '' ,'en') . '/' . $newspaper_codes[$count])));
						if(isset($jaaar_image) && !empty($jaaar_image)){	
							$image_info = explode('/', 'http://www.jaaar.com/assets/images/pishkhan/' . jdate("Y/n/j", $time, '', '' ,'en') . '/' . $newspaper_codes[$count]);
							$image_date = $image_info['6'] . '/' . $image_info['7'] . '/' . $image_info['8'];
							$image_name = $image_info['9'];
							$image_data = array();
							$image_data['Jaaar']['date'] = $image_date;
							$image_name = explode('.', $image_name);
							$image_name = $image_name[0] . "_" . $image_date . "_" . $day . "." . $image_name[1];
							$image_data['Jaaar']['image_name'] = $image_name;
							//$image_data['Jaaar']['image_data'] = $jaaar_image;
							$image_data['Jaaar']['newspaper_names'] = $newspaper_names[$count];
							$image_data['Jaaar']['url'] = 'http://www.jaaar.com/assets/images/pishkhan/' . jdate("Y/n/j", $time, '', '' ,'en') . '/' . $newspaper_codes[$count];
							$srcfile= 'http://www.jaaar.com/assets/images/pishkhan/' . jdate("Y/n/j", $time, '', '' ,'en') . '/' . $newspaper_codes[$count];
							$dstfile='./files/' . $image_name;
							@mkdir(dirname($dstfile), 0777, true);
							copy($srcfile, $dstfile);
							$this->loadModel('Jaaar');
							$this->Jaaar->create();
						    $this->Jaaar->save($image_data);
						}
					}
				}
			}
		}
		/**************END raveshe dovvom********************/


	}
	public function view(){
		if($this->request->is('POST')){
			$date = $this->request->data['jaaar_year'] . '/' . $this->request->data['jaaar_month'] . '/' . $this->request->data['jaaar_day'];
			$newspaper_names = $this->request->data['index']['newspaper_names'];
			$this->loadModel('Jaaar');
			$query = $this->Jaaar->find('all', array('fields' => 'image_name, date, url, image_data', 'conditions' => array('date' => $date, 'newspaper_names' => $newspaper_names)));	
			if(!empty($query)){
				
				/**************START raveshe aval******************/
				//header('Content-type: image/jpg');
				//echo base64_decode($query[0]['Jaaar']['image_data']);
				/**************END raveshe aval********************/
				
				/**************START raveshe dovoom******************/
				$this->set('img_data', $query);
				$this->set('newspaper_names', $newspaper_names);
				/**************END raveshe dovvom********************/
			} else{
				$this->Session->setFlash("روزنامه مورد نظر، در تاریخ انتخاب شده به چاپ نرسیده است.", 'default', array('class' => 'messagebox'));
				$this->redirect(array('action' => 'index'));	
			}
				
		}	
	}	
}
?>