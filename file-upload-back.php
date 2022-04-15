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


		    $data="SELECT id,nom,nomutilisateur  FROM utilisateur WHERE nom='$dealer_name'";	
			$result=mysqli_query($con,$data);
			$row1 = $result -> fetch_assoc() ;


		    $make_req="SELECT id,nom  FROM  fabriquant WHERE nom='$make'";	
			$make_res=mysqli_query($con,$make_req);
			$make_row = $make_res -> fetch_assoc() ;

		    $model_req="SELECT id,nom  FROM modele WHERE nom='$model'";	
			$model_res=mysqli_query($con,$model_req);
			$model_row = $model_res -> fetch_assoc() ;


		    $cat_req="SELECT id,nom  FROM category WHERE nom='$category'";	
	        $cat_res=mysqli_query($con,$cat_req);
			$cat_row = $cat_res -> fetch_assoc() ;

			$body_req="SELECT id,nom  FROM carrosserie WHERE nom='$body'";	
	        $body_res=mysqli_query($con,$body_req);
			$body_row = $body_res -> fetch_assoc() ;

			//transmission
			$trans_req="SELECT id,nom  FROM transmission WHERE nom='$transmission'";	
	        $trans_res=mysqli_query($con,$trans_req);
			$trans_row = $trans_res -> fetch_assoc() ;

				//carburant
			$carb_req="SELECT id,nom  FROM carburant WHERE nom='$fuel'";	
			$carb_res=mysqli_query($con,$carb_req);
			$carb_row = $carb_res -> fetch_assoc() ;

				//cylindres
			$cyl_req="SELECT *  FROM cylindres WHERE nom='$eng_cyl'";	
	        $cyl_res=mysqli_query($con,$cyl_req);
			$cyl_row = $cyl_res -> fetch_assoc() ;
			 
				//traction
			$traction_req="SELECT id,nom  FROM traction WHERE nom='$drive'";	
			$traction_res=mysqli_query($con,$traction_req);
			$traction_row = $traction_res -> fetch_assoc() ;
 
	       //status
          	$status_req="SELECT *  FROM status";	
	        $status_res=mysqli_query($con,$status_req);
	        $status_row = $status_res -> fetch_assoc() ;

	        //traction
        	if( $is_new == TRUE  )
        	{  
	    	 
	    	  $status_req="SELECT id  FROM status WHERE nom='Neuf'";	
	    	  $status_res=mysqli_query($con,$status_req);
	    	  $status_row = $status_res -> fetch_assoc() ;

	    	  $id_status=$status_row['id'] ;
	 
	        }
	        else {
				$status_req="SELECT id  FROM status WHERE nom='Usagé'";	
	    	    $status_res=mysqli_query($con,$status_req);
	    	    $status_row = $status_res -> fetch_assoc() ;

	    	    $id_status=$status_row['id'] ;
	         }

				//traction
			if($traction_row == null  )
	    	{  
				$insert="INSERT INTO `traction`( `nom`  ) VALUES ( '$drive' )";
				$insert_q=mysqli_query($con,$insert);
	
				$traction_req="SELECT id,nom  FROM traction WHERE nom='$drive'";	
				$traction_res=mysqli_query($con,$traction_req);
				$traction_row = $traction_res -> fetch_assoc() ;

				$id_traction=$traction_row['id'] ;
			 
	    	}
		    else {
						if($traction_row['nom'] == $drive)
			
						$id_traction=$traction_row['id'] ;
			}


				//cylindres
			if($cyl_row == null  )
	    	{  
				$insert="INSERT INTO `cylindres`( `nom` , `description`  ) VALUES ( '$eng_cyl' , '$eng_desc'  )";
				$insert_q=mysqli_query($con,$insert);
	
				$cyl_req="SELECT *  FROM cylindres WHERE nom='$eng_cyl'";	
	            $cyl_res=mysqli_query($con,$cyl_req);
			    $cyl_row = $cyl_res -> fetch_assoc() ;

				$id_cyl=$cyl_row['id'] ;
			 
	    	}
		    else {
						if($cyl_row['nom'] == $eng_cyl)
			
						$id_cyl=$cyl_row['id'] ;
			}


        	//carburant
			if($carb_row == null  )
	    	{  
				$insert="INSERT INTO `carburant`( `nom` ) VALUES ( '$fuel'  )";
				$insert_q=mysqli_query($con,$insert);
	
				$carb_req="SELECT id,nom  FROM carburant WHERE nom='$fuel'";	
			    $carb_res=mysqli_query($con,$carb_req);
			    $carb_row = $carb_res -> fetch_assoc() ;

				$id_carb=$carb_row['id'] ;
			 
	    	}
		    else {
						if($carb_row['nom'] == $fuel)
			
						$id_carb=$carb_row['id'] ;
			}



			if($trans_row == null  )
	    	{  
				$inserttrans="INSERT INTO `transmission`( `nom` ) VALUES ( '$transmission'  )";
				$insert_trans=mysqli_query($con,$inserttrans);
	
				$trans_req="SELECT id,nom  FROM transmission WHERE nom='$transmission'";	
	            $trans_res=mysqli_query($con,$trans_req);
			    $trans_row = $trans_res -> fetch_assoc() ;

				$id_trans=$trans_row['id'] ;
			 
	    	}
		    else {
						if($trans_row['nom'] == $transmission)
			
						$id_trans=$trans_row['id'] ;
			}


			if($body_row == null  )
	    	{  
				$insertbody="INSERT INTO `carrosserie`( `nom` ) VALUES ( '$body'  )";

				$insert_body=mysqli_query($con,$insertbody);
	
				$body_req="SELECT id,nom  FROM carrosserie WHERE nom='$body'";	
	            $body_res=mysqli_query($con,$body_req);
			    $body_row = $body_res -> fetch_assoc() ;

				$id_body=$body_row['id'] ;
			 
	    	}
		    else {
						if($body_row['nom'] == $body)
			
						$id_body=$body_row['id'] ;
			}


			if($cat_row == null  )
	    	{  
				$insertcat="INSERT INTO `category`( `nom` ) VALUES ( '$category'  )";

				$insert_cat=mysqli_query($con,$insertcat);
	
				$cat_req="SELECT id,nom  FROM category WHERE nom='$category'";	

				$result_cat=mysqli_query($con,$cat_req);
	
				$cat_row = $result_cat -> fetch_assoc() ;
				$id_cat=$cat_row['id'] ;
			 
	    	}
		    else {
						if($cat_row['nom'] == $category)
			
						$id_cat=$cat_row['id'] ;
			}

	
		
		   if($make_row == null  )
	    	{  
				$insertmake="INSERT INTO `fabriquant`( `nom` ) VALUES ( '$make'  )";

				$insert_make=mysqli_query($con,$insertmake);
	
				$data_make="SELECT id,nom  FROM fabriquant WHERE nom='$make'";	
				$result_make=mysqli_query($con,$data_make);
	
				$row11 = $result_make -> fetch_assoc() ;
				$id_make=$row11['id'] ;
			 
	    	}
		    else {
						if($make_row['nom'] == $make)
			
						$id_make=$make_row['id'] ;
			}


			if($model_row == null  )
	    	{  
				$insertmodele="INSERT INTO `modele`( `nom` ) VALUES ( '$model'  )";

				$insert_make=mysqli_query($con,$insertmodele);
	
				$data_model="SELECT id,nom  FROM modele WHERE nom='$model'";	
				$result_model=mysqli_query($con,$data_model);
	
				$row12 = $result_model -> fetch_assoc() ;
				$id_model=$row12['id'] ;
			 
	    	}
		    else {
						if($model_row['nom'] == $model)
			
						$id_model=$model_row['id'] ;
			}



			if($row1 == null )
			{  
				$insertuser="INSERT INTO `utilisateur`(   `nom`, `telephone`, `nomutilisateur` ) VALUES ( '$dealer_name','$dealer_phone' , '$dealer_name' )";
	
				$insert_ures=mysqli_query($con,$insertuser);
	
				$data="SELECT id,nom  FROM utilisateur WHERE nom='$dealer_name'";	
				$result=mysqli_query($con,$data);
	
				$row1 = $result -> fetch_assoc() ;
				$id=$row1['id'] ;
			
				 
			}
			else {
				$id=$row1['id'] ;
	
				}

			$insertqry="INSERT INTO `vehicule`
			(
				/* `d_id`
			 , `dealer_name`, `dealer_address`, `dealer_city`, `dealer_region`, `dealer_postal`,`dealer_phone`,*/

			`marque_id`, `stock`,`vin` , `modele_id` , `category_id` ,  `status_id`,`carrosserie_id`,`transmission_id` ,`carburant_id` ,
			`traction_id` ,
			`cylindres_id` , 
			`km` , 
			`couleurexterieur` ,`couleurinterieur` ,`portes` ,`passagers` ,
			`prixdetail`,`prixwholesale`,`annee`,`garentie`,
			`utilisateur_id` , `trim`, 
			`options_xl`,`special_mentions`,`in_service_date` ,
			`external_url`,`photo`,
			`main_photo`,`video_en`  ,`video_fr`
			
			) VALUES 
			(
			'$id_make', '$stock','$vin', '$id_model' , '$id_cat', '$id_status','$id_body' , '$id_trans' 
			, '$id_carb', '$id_traction' , '$id_cyl' , '$odometer' 
			,'$extcolour','$intcolour','$doors' ,'$passenger'
			,'$regular_price','$sale_price','$year','$warranty',
				'$id' ,
			
			'$trim' ,'$op','$special','$in_service_date',
			'$external_url' , '$photo' ,'$main_photo', '$video_en','$video_fr'
			  
			)";
			$insertres=mysqli_query($con,$insertqry);
			



	}
	  
}
header('Location: index.php');
?>