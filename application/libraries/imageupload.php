<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class imageupload
{
    function uploadImageAjax($filename,$temp,$directoryFileUpload,$directoryFileUpload_thumb,$first_image,$second_image) {
		
		// You may change any of the below information if you wish
		$vpb_upload_image_directory = $directoryFileUpload;
		$vpb_upload_image_directory_thumb = $directoryFileUpload_thumb;
		$vpb_with_of_first_image_file = $first_image;      // You may adjust the width here as you wish
		$vpb_with_of_second_image_file = $second_image;     // You may adjust the height here as you wish
		$random_digit=rand(0000,9999);
		/* Variables Declaration and Assignments */
		$extension = end(explode('.', $filename));
		$vpb_image_filename = $random_digit.'.'.$extension;
		$vpb_image_tmp_name = $temp;
		$vpb_file_size = filesize($temp);
		//$vpb_file_extensions = pathinfo($vpb_image_filename, PATHINFO_EXTENSION);
		$vpb_file_extensions = strtolower(end(explode(".", $vpb_image_filename)));
		
	
	
	
		$vpb_maximum_allowed_file_size = 102400*102400; // You may change the maximum allowed upload file size here if you wish
		$vpb_additional_file_size = $vpb_file_size - $vpb_maximum_allowed_file_size;
	
	
	//Validate file upload field to be sure that the user attached a file and did not upload an empty field to proceed
		if($vpb_image_filename == "") 
		{
			echo '<div class="info">Please browse for the file that you wish to upload and resize to proceed. Thanks.</div>';
		}	else	{
			//Validate attached file for allowed file extension types
			if ($vpb_file_extensions != "gif" && $vpb_file_extensions != "jpg" && $vpb_file_extensions != "jpeg" && $vpb_file_extensions != "png" && $vpb_file_extensions != "GIF" && $vpb_file_extensions != "JPG" && $vpb_file_extensions != "JPEG" && $vpb_file_extensions != "PNG") 
			{
				echo '<div class="info">Sorry, the file type you attempted to upload is invalid. <br>This system only accepts gif, jpg, jpeg or png image files whereas you attached <b>'.$vpb_file_extensions.'</b> file format. Thanks.</div>';
			}
			elseif ($vpb_file_size > $vpb_maximum_allowed_file_size) //Validate attached file to avoid large files
			{
				echo "<div class='info'>Sorry, you have exceeded this system's maximum upload file size limit of <b>".$vpb_maximum_allowed_file_size."</b> by <b>".$vpb_additional_file_size."</b><br>Please reduce your file size to proceed. Thanks.</div>";
			}
			else
			{
				/* Create images based on their file types */
				if($vpb_file_extensions == "gif") //If the attached file extension is a gif, carry out the below action
				{
					$vpb_image_src = imagecreatefromgif($vpb_image_tmp_name); //This will create a gif image file
				}
				elseif($vpb_file_extensions == "jpg" || $vpb_file_extensions == "jpeg") //If the attached file is a jpg or jpeg, carry out the below action
				{
					$vpb_image_src = imagecreatefromjpeg($vpb_image_tmp_name); //This will create a jpg or jpeg image file
				}
				else if($vpb_file_extensions=="png") //If the attached file extension is a png, carry out the below action
				{
					$vpb_image_src = imagecreatefrompng($vpb_image_tmp_name); //This will create a png image file
				}
				else
				{
					$vpb_image_src = "invalid_file_type_realized";
				}
				
				//The file attached is unknow
				if($vpb_image_src == "invalid_file_type_realized")
				{
					echo '<div class="info">Sorry, the file type you attempted to upload is invalid. <br>This system only accepts gif, jpg, jpeg or png image files whereas you attached <b>'.$vpb_file_extensions.'</b> file format. Thanks.</div>';
				}
				else
				{
					//Get the size of the attached image file from where the resize process will take place from the width and height of the image
					list($vpb_image_width,$vpb_image_height) = getimagesize($vpb_image_tmp_name);
					
					/* The uploaded image file is supposed to be just one image file but 
					   we are going to split the uploaded image file into two images with different sizes for demonstration purpose and that process 
					   starts from below */
					   
					   
					//This is the width of the first image file from where its height will be determined
					$vpb_first_image_new_width = $vpb_with_of_first_image_file; 
					$vpb_first_image_new_height = ($vpb_image_height/$vpb_image_width)*$vpb_first_image_new_width;
					$vpb_first_image_tmp = imagecreatetruecolor($vpb_first_image_new_width,$vpb_first_image_new_height);
					
					
					//This is the width of the second image file from where its height will be determined
					$vpb_second_image_new_width = $vpb_with_of_second_image_file; 
					$vpb_second_image_new_height = ($vpb_image_height/$vpb_image_width)*$vpb_second_image_new_width;
					$vpb_second_image_tmp = imagecreatetruecolor($vpb_second_image_new_width,$vpb_second_image_new_height);
					
					//Resize the first image file
					imagecopyresampled($vpb_first_image_tmp,$vpb_image_src,0,0,0,0,$vpb_first_image_new_width,$vpb_first_image_new_height,$vpb_image_width,$vpb_image_height); 
					
					//Resize the second image file
					imagecopyresampled($vpb_second_image_tmp,$vpb_image_src,0,0,0,0,$vpb_second_image_new_width,$vpb_second_image_new_height, $vpb_image_width,$vpb_image_height);
					
					//Pass the attached file to the uploads directory for the first image file
					$vpb_uploaded_file_movement_one = $vpb_upload_image_directory."b_image_".$vpb_image_filename;
					
					//Pass the attached file to the uploads directory for the second image file
					$vpb_uploaded_file_movement_two = $vpb_upload_image_directory_thumb."s_image_".$vpb_image_filename;
					
					//Upload the first and second images
					imagejpeg($vpb_first_image_tmp,$vpb_uploaded_file_movement_one,100);
					imagejpeg($vpb_second_image_tmp,$vpb_uploaded_file_movement_two,100);
		
					imagedestroy($vpb_image_src);
					imagedestroy($vpb_first_image_tmp);
					imagedestroy($vpb_second_image_tmp);
					//echo $vpb_image_filename;
					
					//echo '<img src="'.base_url().''.$vpb_uploaded_file_movement_two.'">';
					return array($vpb_uploaded_file_movement_two,$vpb_uploaded_file_movement_one);
				}
				
			}
			
		}
				
	}
	
	function multiple_upload($filename,$tmp,$output_dir,$thumbnail_dir,$final_width_of_image)
	{
		$temp = explode(".",$filename);
		$newfilename = rand(1,99999) . '.' .end($temp);
		move_uploaded_file($tmp, $output_dir . $newfilename);
		
		if(preg_match('/[.](jpg)$/', $newfilename)) {
        $im = imagecreatefromjpeg($output_dir . $newfilename);
    } else if (preg_match('/[.](gif)$/', $newfilename)) {
        $im = imagecreatefromgif($output_dir . $newfilename);
    } else if (preg_match('/[.](png)$/', $newfilename)) {
        $im = imagecreatefrompng($output_dir . $newfilename);
    }
     
    $ox = imagesx($im);
    $oy = imagesy($im);
     
    $nx = $final_width_of_image;
    $ny = floor($oy * ($final_width_of_image / $ox));
     
    $nm = imagecreatetruecolor($nx, $ny);
     
    imagecopyresized($nm, $im, 0,0,0,0,$nx,$ny,$ox,$oy);
     
    if(!file_exists($thumbnail_dir)) {
      if(!mkdir($thumbnail_dir)) {
           die("There was a problem. Please try again!");
      } 
       }
 
    imagejpeg($nm, $thumbnail_dir . $newfilename);
    return $newfilename;
		
	}
	
	function generate_image_thumbnail($source_image_path, $thumbnail_image_path,$THUMBNAIL_IMAGE_MAX_WIDTH,$THUMBNAIL_IMAGE_MAX_HEIGHT)
{
    list($source_image_width, $source_image_height, $source_image_type) = getimagesize($source_image_path);
    switch ($source_image_type) {
        case IMAGETYPE_GIF:
            $source_gd_image = imagecreatefromgif($source_image_path);
            break;
        case IMAGETYPE_JPEG:
            $source_gd_image = imagecreatefromjpeg($source_image_path);
            break;
        case IMAGETYPE_PNG:
            $source_gd_image = imagecreatefrompng($source_image_path);
            break;
    }
    if ($source_gd_image === false) {
        return false;
    }
    $source_aspect_ratio = $source_image_width / $source_image_height;
    $thumbnail_aspect_ratio = $THUMBNAIL_IMAGE_MAX_WIDTH / $THUMBNAIL_IMAGE_MAX_HEIGHT;
    if ($source_image_width <= $THUMBNAIL_IMAGE_MAX_WIDTH && $source_image_height <= $THUMBNAIL_IMAGE_MAX_HEIGHT) {
        $thumbnail_image_width = $source_image_width;
        $thumbnail_image_height = $source_image_height;
    } elseif ($thumbnail_aspect_ratio > $source_aspect_ratio) {
        $thumbnail_image_width = (int) ($THUMBNAIL_IMAGE_MAX_HEIGHT * $source_aspect_ratio);
        $thumbnail_image_height = $THUMBNAIL_IMAGE_MAX_HEIGHT;
    } else {
        $thumbnail_image_width = $THUMBNAIL_IMAGE_MAX_WIDTH;
        $thumbnail_image_height = (int) ($THUMBNAIL_IMAGE_MAX_WIDTH / $source_aspect_ratio);
    }
    $thumbnail_gd_image = imagecreatetruecolor($thumbnail_image_width, $thumbnail_image_height);
    imagecopyresampled($thumbnail_gd_image, $source_gd_image, 0, 0, 0, 0, $thumbnail_image_width, $thumbnail_image_height, $source_image_width, $source_image_height);

    $img_disp = imagecreatetruecolor($THUMBNAIL_IMAGE_MAX_WIDTH,$THUMBNAIL_IMAGE_MAX_WIDTH);
    $backcolor = imagecolorallocate($img_disp,255, 255, 255);
    imagefill($img_disp,0,0,$backcolor);

        imagecopy($img_disp, $thumbnail_gd_image, (imagesx($img_disp)/2)-(imagesx($thumbnail_gd_image)/2), (imagesy($img_disp)/2)-(imagesy($thumbnail_gd_image)/2), 0, 0, imagesx($thumbnail_gd_image), imagesy($thumbnail_gd_image));
	
    imagejpeg($img_disp, $thumbnail_image_path, 90);
    imagedestroy($source_gd_image);
    imagedestroy($thumbnail_gd_image);
    imagedestroy($img_disp);
	//$WaterMark = 'http://localhost/greatgadgets/assets/img/watermark.png';
	//$this->watermarkImage($source_image_path,$WaterMark,$source_image_path,50);
    return true;
}

function generate_image_fixed_size($source_image_path, $thumbnail_image_path,$THUMBNAIL_IMAGE_MAX_WIDTH,$THUMBNAIL_IMAGE_MAX_HEIGHT)
{
    list($source_image_width, $source_image_height, $source_image_type) = getimagesize($source_image_path);
    switch ($source_image_type) {
        case IMAGETYPE_GIF:
            $source_gd_image = imagecreatefromgif($source_image_path);
            break;
        case IMAGETYPE_JPEG:
            $source_gd_image = imagecreatefromjpeg($source_image_path);
            break;
        case IMAGETYPE_PNG:
            $source_gd_image = imagecreatefrompng($source_image_path);
            break;
    }
    if ($source_gd_image === false) {
        return false;
    }
    $source_aspect_ratio = $source_image_width / $source_image_height;
    $thumbnail_aspect_ratio = $THUMBNAIL_IMAGE_MAX_WIDTH / $THUMBNAIL_IMAGE_MAX_HEIGHT;
    if ($source_image_width <= $THUMBNAIL_IMAGE_MAX_WIDTH && $source_image_height <= $THUMBNAIL_IMAGE_MAX_HEIGHT) {
        $thumbnail_image_width = $source_image_width;
        $thumbnail_image_height = $source_image_height;
    } elseif ($thumbnail_aspect_ratio > $source_aspect_ratio) {
        $thumbnail_image_width = (int) ($THUMBNAIL_IMAGE_MAX_HEIGHT * $source_aspect_ratio);
        $thumbnail_image_height = $THUMBNAIL_IMAGE_MAX_HEIGHT;
    } else {
        $thumbnail_image_width = $THUMBNAIL_IMAGE_MAX_WIDTH;
        $thumbnail_image_height = (int) ($THUMBNAIL_IMAGE_MAX_WIDTH / $source_aspect_ratio);
    }
    $thumbnail_gd_image = imagecreatetruecolor($thumbnail_image_width, $thumbnail_image_height);
    imagecopyresampled($thumbnail_gd_image, $source_gd_image, 0, 0, 0, 0, $thumbnail_image_width, $thumbnail_image_height, $source_image_width, $source_image_height);

    $img_disp = imagecreatetruecolor($THUMBNAIL_IMAGE_MAX_WIDTH,$THUMBNAIL_IMAGE_MAX_WIDTH);
    $backcolor = imagecolorallocate($img_disp,255, 255, 255);
    imagefill($img_disp,0,0,$backcolor);

        imagecopy($img_disp, $thumbnail_gd_image, (imagesx($img_disp)/2)-(imagesx($thumbnail_gd_image)/2), (imagesy($img_disp)/2)-(imagesy($thumbnail_gd_image)/2), 0, 0, imagesx($thumbnail_gd_image), imagesy($thumbnail_gd_image));
	
    imagejpeg($img_disp, $thumbnail_image_path, 90);
    imagedestroy($source_gd_image);
    imagedestroy($thumbnail_gd_image);
    imagedestroy($img_disp);
	$WaterMark = base_url().'assets/img/watermark.png';
	//$this->watermarkImage($source_image_path,$WaterMark,$source_image_path,50);
    return true;
}

function watermarkImage($SourceFile, $WaterMark, $DestinationFile=NULL, $opacity) { 
 
 $main_img = $SourceFile; 
 $watermark_img = $WaterMark; 
 $padding = 1; 
 $opacity = $opacity; 
 
 $watermark = imagecreatefrompng($watermark_img); // create watermark
 $image = imagecreatefromjpeg($main_img); // create main graphic
 
 if(!$image || !$watermark) die("Error: main image or watermark could not be loaded!");
 
 	$marge_right = 0;
	$marge_bottom = 0;
	$sx = imagesx($watermark);
	$sy = imagesy($watermark);

 
 
 // copy watermark on main image
 imagecopy($image, $watermark, imagesx($image) - $sx - $marge_right, imagesy($image) - $sy - $marge_bottom, 0, 0, imagesx($watermark), imagesy($watermark));
 imagejpeg($image,$DestinationFile);
 imagedestroy($image); 
 imagedestroy($watermark); 
}
}