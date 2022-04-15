<?php


include 'database.php';

$uploadfile=$_FILES['uploadfile']['tmp_name'];

require 'PHPExcel/Classes/PHPExcel.php';
require_once 'PHPExcel/Classes/PHPExcel/IOFactory.php';

$objExcel=PHPExcel_IOFactory::load($uploadfile);

foreach($objExcel->getWorksheetIterator() as $worksheet)
{
	$highestrow=$worksheet->getHighestRow();


	for($row=2;$row<=$highestrow;$row++)
	{
		$d_id=$worksheet->getCellByColumnAndRow(0,$row)->getValue();
		
        $v_id=$worksheet->getCellByColumnAndRow(1,$row)->getValue();
		$remote_date_modified=$worksheet->getCellByColumnAndRow(2,$row)->getValue();
		$remote_date_entered=$worksheet->getCellByColumnAndRow(3,$row)->getValue();
		$stock=$worksheet->getCellByColumnAndRow(4,$row)->getValue();
		$vin=$worksheet->getCellByColumnAndRow(5,$row)->getValue();
		$status=$worksheet->getCellByColumnAndRow(6,$row)->getValue();
		$year=$worksheet->getCellByColumnAndRow(7,$row)->getValue();
		$make=$worksheet->getCellByColumnAndRow(8,$row)->getValue();
		$model=$worksheet->getCellByColumnAndRow(9,$row)->getValue();

		//$datainsert="INSERT INTO `modele` (`company_id`, `v_id`)VALUES ('$d_id','$v_id')"	
		//var_dump($selectdata);
		/*$rows = $result -> fetch_assoc();
		//echo gettype($rows);
		
		foreach($rows as $ro) 
		{
			if ($ro['nom']=='X5'){
				echo $ro['id'];
			}
			  echo $ro['id'];
              echo $ro['nom'];
			
			
		} */
		
		
		
		$trim=$worksheet->getCellByColumnAndRow(10,$row)->getValue();
		$body=$worksheet->getCellByColumnAndRow(11,$row)->getValue();
		$doors=$worksheet->getCellByColumnAndRow(12,$row)->getValue();
		$drive=$worksheet->getCellByColumnAndRow(13,$row)->getValue();
		$transmission=$worksheet->getCellByColumnAndRow(14,$row)->getValue();
		$fuel=$worksheet->getCellByColumnAndRow(15,$row)->getValue();
		$eng_cyl=$worksheet->getCellByColumnAndRow(16,$row)->getValue();
		$eng_desc=$worksheet->getCellByColumnAndRow(17,$row)->getValue();
		$extcolour=$worksheet->getCellByColumnAndRow(18,$row)->getValue();
		$intcolour=$worksheet->getCellByColumnAndRow(19,$row)->getValue();
		$is_certified=$worksheet->getCellByColumnAndRow(20,$row)->getValue();
		$is_demo=$worksheet->getCellByColumnAndRow(21,$row)->getValue();
		$is_new=$worksheet->getCellByColumnAndRow(22,$row)->getValue();
		$category=$worksheet->getCellByColumnAndRow(23,$row)->getValue();
		$odometer=$worksheet->getCellByColumnAndRow(24,$row)->getValue();
		$warranty=$worksheet->getCellByColumnAndRow(25,$row)->getValue();
		$passenger=$worksheet->getCellByColumnAndRow(26,$row)->getValue();
	    $standard_price=$worksheet->getCellByColumnAndRow(27,$row)->getValue();
		$photo=$worksheet->getCellByColumnAndRow(28,$row)->getValue();
        $options=$worksheet->getCellByColumnAndRow(29,$row)->getValue();

		$special_mentions=$worksheet->getCellByColumnAndRow(30,$row)->getValue();
		
		$in_service_date=$worksheet->getCellByColumnAndRow(31,$row)->getValue();
		$external_url=$worksheet->getCellByColumnAndRow(32,$row)->getValue();
		$main_photo=$worksheet->getCellByColumnAndRow(33,$row)->getValue();
		$regular_price=$worksheet->getCellByColumnAndRow(34,$row)->getValue();
		$sale_price=$worksheet->getCellByColumnAndRow(35,$row)->getValue();
		$video_en=$worksheet->getCellByColumnAndRow(36,$row)->getValue();
		$video_fr=$worksheet->getCellByColumnAndRow(37,$row)->getValue();
		
		
				
		
		
		$data1="SELECT `id`,`nom` FROM `modele`";	
        $data2="SELECT `id`,`nom`FROM `fabriquant`;";		
			
		$result=mysqli_query($con,$data);
		while($row = $result -> fetch_assoc()){

		        if ($row['nom']==$model){
				
				$id_model=$row['id'];
				$datavehicule='a' ;
				
				
				
			}
           
		}
		
		

		if($d_id!='')
		{
			
			$insertqry="INSERT INTO `vehicule_back`
			( `company_id`, `v_id`,`remote_date_modified`,`remote_date_entered`,`stock`,`vin`,`label`,`year`,`make`,`model`,`trim`,`body`,`doors`,
			`drive`,`transmission`,`fuel`,`eng_cyl`,`eng_desc`,`extcolour`,`intcolour`,`is_certified`,`is_demo`,`is_new`,`category`,`odometer`,`warranty`,`passenger`,`standard_price`,`photo`,`options`,`special_mentions`,`in_service_date`,`main_photo`,`regular_price`,`sale_price`,`video_en`,`video_fr`) VALUES 
			('$d_id','$v_id','$remote_date_modified','$remote_date_entered','$stock','$vin','$status','$year','$make','$model','$trim','$body','$doors',
			'$drive','$transmission','$fuel','$eng_cyl','$eng_desc','$extcolour','$intcolour','$is_certified','$is_demo','$is_new','$category','$odometer','$warranty','$passenger','$standard_price','$photo','$options','$special_mentions','$in_service_date','$main_photo','$regular_price','$sale_price','$video_en','$video_fr')";
			$insertres=mysqli_query($con,$insertqry);
			
			
			
		}
	}
	  
}
header('Location: index.php');
?>