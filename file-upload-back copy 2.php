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
		$dealer_name=$worksheet->getCellByColumnAndRow(1,$row)->getValue();

		$dealer_address=$worksheet->getCellByColumnAndRow(2,$row)->getValue();
		$dealer_city=$worksheet->getCellByColumnAndRow(3,$row)->getValue();
		$dealer_region=$worksheet->getCellByColumnAndRow(4,$row)->getValue(); 
		$dealer_postal=$worksheet->getCellByColumnAndRow(5,$row)->getValue();  
		$dealer_phone=$worksheet->getCellByColumnAndRow(6,$row)->getValue();  
        $v_id=$worksheet->getCellByColumnAndRow(7,$row)->getValue();
		$remote_date_modified=$worksheet->getCellByColumnAndRow(8,$row)->getValue();
		$remote_date_entered=$worksheet->getCellByColumnAndRow(9,$row)->getValue();
		$stock=$worksheet->getCellByColumnAndRow(10,$row)->getValue();
		$vin=$worksheet->getCellByColumnAndRow(11,$row)->getValue();
		$status=$worksheet->getCellByColumnAndRow(12,$row)->getValue();
		$year=$worksheet->getCellByColumnAndRow(13,$row)->getValue();
		$make=$worksheet->getCellByColumnAndRow(14,$row)->getValue();
		$model=$worksheet->getCellByColumnAndRow(15,$row)->getValue();
		$trim=$worksheet->getCellByColumnAndRow(16,$row)->getValue();
		$body=$worksheet->getCellByColumnAndRow(17,$row)->getValue();
		$doors=$worksheet->getCellByColumnAndRow(18,$row)->getValue();
		$drive=$worksheet->getCellByColumnAndRow(19,$row)->getValue();
		$transmission=$worksheet->getCellByColumnAndRow(20,$row)->getValue();
		$fuel=$worksheet->getCellByColumnAndRow(21,$row)->getValue();
		$eng_cyl=$worksheet->getCellByColumnAndRow(22,$row)->getValue();
		$eng_desc=$worksheet->getCellByColumnAndRow(23,$row)->getValue();
		$extcolour=$worksheet->getCellByColumnAndRow(24,$row)->getValue();
		$intcolour=$worksheet->getCellByColumnAndRow(25,$row)->getValue();
		$is_certified=$worksheet->getCellByColumnAndRow(26,$row)->getValue();
		$is_demo=$worksheet->getCellByColumnAndRow(27,$row)->getValue();
		$is_new=$worksheet->getCellByColumnAndRow(28,$row)->getValue();
		$category=$worksheet->getCellByColumnAndRow(29,$row)->getValue();
		$odometer=$worksheet->getCellByColumnAndRow(30,$row)->getValue();
		$warranty=$worksheet->getCellByColumnAndRow(31,$row)->getValue();
		$passenger=$worksheet->getCellByColumnAndRow(32,$row)->getValue();
	    $standard_price=$worksheet->getCellByColumnAndRow(33,$row)->getValue();
		$photo=$worksheet->getCellByColumnAndRow(34,$row)->getValue();
        $option=$worksheet->getCellByColumnAndRow(35,$row)->getValue();

		$special_mentions=$worksheet->getCellByColumnAndRow(36,$row)->getValue();
		$in_service_date=$worksheet->getCellByColumnAndRow(37,$row)->getValue();
		$external_url=$worksheet->getCellByColumnAndRow(38,$row)->getValue();
		$main_photo=$worksheet->getCellByColumnAndRow(39,$row)->getValue();
		$regular_price=$worksheet->getCellByColumnAndRow(40,$row)->getValue();
		$sale_price=$worksheet->getCellByColumnAndRow(41,$row)->getValue();
		$video_en=$worksheet->getCellByColumnAndRow(42,$row)->getValue();
		$video_fr=$worksheet->getCellByColumnAndRow(43,$row)->getValue();
		

 
		$data="SELECT id  FROM utilisateur WHERE nom='Boulevard Dodge Chrysler Jeep'";	
		$result=mysqli_query($con,$data);
		    $row = $result -> fetch_assoc() ;
	    	$id=$row['id'] ;
			$special = $con-> real_escape_string( $special_mentions );
			$op = $con-> real_escape_string( $option );

		if($d_id)
		{
		


			
			$insertqry="INSERT INTO `vehicule_back`
			(
				/* `d_id`
			 , `dealer_name`, `dealer_address`, `dealer_city`, `dealer_region`, `dealer_postal`,`dealer_phone`,*/

			`v_id`,`remote_date_modified`,`remote_date_entered`,`stock`,`vin`,`status`,`year`,`make`,`model` ,`trim`,`body`,
			`doors`,`drive`,`transmission`,`fuel`,`eng_cyl`,`eng_desc`,`extcolour`,`intcolour`,`is_certified`,`is_demo`,`is_new`,
			`category`,`odometer`,`warranty`,`passenger`,`standard_price`,`photo`,`option_xl`,`special_mentions`,`in_service_date` ,
			`external_url`,
			`main_photo`,`regular_price` ,`sale_price` ,`video_en`  ,`video_fr`, `utilisateur_id`
			 
			) VALUES 
			(
				/*'$d_id'
			 ,
			
			'$dealer_name','$dealer_address','$dealer_city','$dealer_region', '$dealer_postal','$dealer_phone',*/
			'$v_id','$remote_date_modified','$remote_date_entered','$stock','$vin','$status',
			'$year','$make','$model','$trim','$body','$doors','$drive','$transmission','$fuel','$eng_cyl',
			'$eng_desc','$extcolour','$intcolour','$is_certified','$is_demo','$is_new','$category','$odometer',
			/*'$warranty','$passenger','$standard_price','$photo','$option','$special_mentions','$in_service_date',*/
			'$warranty','$passenger','$standard_price','$photo','$op','$special','$in_service_date',
			'$external_url','$main_photo','$regular_price','$sale_price', '$video_en','$video_fr' ,'$id'
			)";
			$insertres=mysqli_query($con,$insertqry);
			
		
			
		}
		else 
		{$insertqry="INSERT INTO `vehicule_back`
			(
				/* `d_id`
			 , `dealer_name`, `dealer_address`, `dealer_city`, `dealer_region`, `dealer_postal`,`dealer_phone`,*/

			`v_id`,`remote_date_modified`,`remote_date_entered`,`stock`,`vin`,`status`,`year`,`make`,`model` ,`trim`,`body`,
			`doors`,`drive`,`transmission`,`fuel`,`eng_cyl`,`eng_desc`,`extcolour`,`intcolour`,`is_certified`,`is_demo`,`is_new`,
			`category`,`odometer`,`warranty`,`passenger`,`standard_price`,`photo`,`option_xl`,`special_mentions`,`in_service_date` ,
			`external_url`,
			`main_photo`,`regular_price` ,`sale_price` ,`video_en`  ,`video_fr`, `utilisateur_id`
			 
			) VALUES 
			(
				/*'$d_id'
			 ,
			
			'$dealer_name','$dealer_address','$dealer_city','$dealer_region', '$dealer_postal','$dealer_phone',*/
			'51578','$remote_date_modified','$remote_date_entered','$stock','$vin','$status',
			'$year','$make','$model','$trim','$body','$doors','$drive','$transmission','$fuel','$eng_cyl',
			'$eng_desc','$extcolour','$intcolour','$is_certified','$is_demo','$is_new','$category','$odometer',
			/*'$warranty','$passenger','$standard_price','$photo','$option','$special_mentions','$in_service_date',*/
			'$warranty','$passenger','$standard_price','$photo','$op','$special','$in_service_date',
			'$external_url','$main_photo','$regular_price','$sale_price', '$video_en','$video_fr' ,'1222'
			)";
			$insertres=mysqli_query($con,$insertqry);}
	}
	  
}
header('Location: index.php');
?>