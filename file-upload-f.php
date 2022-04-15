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
		
		$special = $con-> real_escape_string( $special_mentions );
		$op = $con-> real_escape_string( $option );


		    $data="SELECT id,nom  FROM utilisateur WHERE nom='$dealer_name'";	
			$result=mysqli_query($con,$data);

			$row1 = $result -> fetch_assoc() ;
		

	
		
		if($row1['nom']==$dealer_name)
		{  
			$id=$row1['id'] ;
			 
		}
		else {
			$insertuser="INSERT INTO `utilisateur`
			( 
				   `nom`, `telephone`, `nomutilisateur`
			 ) VALUES 
			(
				  '$dealer_name','$dealer_phone' , '$row'
			  )";

			$insert_ures=mysqli_query($con,$insertuser);

			}

	}
	  
}
header('Location: index.php');
?>