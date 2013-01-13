<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}

	$ID         	= isset($data) ? recoverPOST("ID", 0) 			   					 			 : 0;
	$title      	= isset($data) ? recoverPOST("title", $data["Title"])   		   				 : recoverPOST("title");		
	$email       	= isset($data) ? recoverPOST("email", $data["Email"])   		   				 : recoverPOST("email");
	$address1      	= isset($data) ? recoverPOST("address1", $data["Address1"])   		   			 : recoverPOST("address1");
	$address2      	= isset($data) ? recoverPOST("address2", $data["Address2"])   		   			 : recoverPOST("address2");
	$phone       	= isset($data) ? recoverPOST("phone", $data["Phone"])   		   				 : recoverPOST("phone");
	$company       	= isset($data) ? recoverPOST("company", $data["Company"])   		   			 : recoverPOST("company");
	$cinformation	= isset($data) ? recoverPOST("cinformation", $data["Company_Information"]) 		 : recoverPOST("cinformation");
	$country	  	= isset($data) ? recoverPOST("country", $data["Country"])        				 : recoverPOST("country");
	$city  		 	= isset($data) ? recoverPOST("city", $data["City"])        				 		 : recoverPOST("city");	
	$salary    	  	= isset($data) ? recoverPOST("salary", $data["Salary"])            				 : recoverPOST("salary");	
	$currency       = isset($data) ? recoverPOST("salary_currency", $data["Salary_Currency"])        : recoverPOST("salary_currency");	
	$allocation  	= isset($data) ? recoverPOST("allocation_time", $data["Allocation_Time"]) 		 : recoverPOST("allocation_time");
	$requirements	= isset($data) ? recoverPOST("requirements", $data["Requirements"])				 : recoverPOST("requirements");
	$technologies	= isset($data) ? recoverPOST("technologies", $data["Technologies"])				 : recoverPOST("technologies");
	$language  		= isset($data) ? recoverPOST("language", $data["Language"])  	 				 : recoverPOST("language");
	$edit      		= isset($data) ? TRUE											 				 : FALSE;
	$action	   		= isset($data) ? "edit"											 				 : "save";
	$href	        = path("jobs/add/");
	
	echo div("add-form", "class");
		echo formOpen($href, "form-add", "form-add");
			echo p(__("Add new job"), "resalt");
			
			echo isset($alert) ? $alert : NULL;
			
			echo formInput(array(	
				"name" 	=> "title", 
				"class" => "span5 required", 
				"field" => __("Title"), 
				"p" 	=> TRUE, 
				"placeholder" => __("Type the title of the job offer"),
				"value" => $title 
			));
			
			echo formInput(array( 
				"name"     => "email",
				"pattern"  => "^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$",
				"type"     => "email",
				"class"    => "span5 required",
				"field"    => __("Company Email"), 
				"p"    	   => TRUE, 
				"placeholder" => __("Enter your company email"),
				"value"    => $email,
				"required" => TRUE
			));

			echo formInput(array( 
				"name"     => "address1",
				"class"    => "span5 required",
				"field"    => __("Company Address"), 
				"p"    	   => TRUE, 
				"placeholder" => __("Company Address"),
				"value"    => $address1,
			));

			echo formInput(array( 
				"name"     => "address2",
				"class"    => "span5",
				"placeholder" => __("Company Address (Optional)"),
				"value"    => $address2,
			));

			echo formInput(array( 
				"name"     => "phone",
				"class"    => "span5 required",
				"field"    => __("Company Phone"), 
				"p"    	   => TRUE,
				"placeholder" => __("Enter your company phone"), 
				"value"    => $phone,
			));

			echo formInput(array(
				"name"	 => "company",
				"class"  => "span5 required", 
				"field"  => __("Company"), 
				"p" 	 => TRUE, 
				"placeholder" => __("Enter your company name"),
				"value"  => $company
			));
			
			echo formTextarea(array(  
				"id"     => "redactor",
				"name"   => "cinformation", 
				"class"  => "markItUp", 
				"style"  => "height: 240px;", 
				"field"  => __("Company Information"), 
				"p"   	 => TRUE, 
				"placeholder" => __("Enter the details of your company"),
				"value"  => stripslashes($cinformation)
			));
			
			$options = array();
			$i = 0;

			foreach($countries as $value) { 
				$options[$i]["value"]    = $value["Country"];
				$options[$i]["option"]   = __($value["Country"]);
				$options[$i]["selected"] = ($value["Country"] === $country) ? TRUE : FALSE;

				$i++;
			}

			echo formSelect(array(
				"name"	 => "country",
				"class"  => "span5 required",
				"p" 	 => TRUE,  
				"field"  => __("Country")), 
				$options
			);

			echo formInput(array(
				"name"	 => "city",
				"class"  => "span5 required", 
				"field"  => __("City"), 
				"p" 	 => TRUE, 
				"placeholder" => __("Enter the city where your company"),
				"value"  => $city
			));
			
			echo formInput(array(	
				"name" 	=> "salary", 
				"class" => "span2 required", 
				"field" => __("Salary"),
				"placeholder" => "0.00", 
				"value" => $salary
			));

			$options = array(
				0 => array("value" => "USD",   "option" => __("USD"),   "selected" => ($currency === "USD")   ? TRUE : FALSE),
				1 => array("value" => "MXN",   "option" => __("MXN"),   "selected" => ($currency === "MXN")   ? TRUE : FALSE),
				2 => array("value" => "EUR",   "option" => __("EUR"),   "selected" => ($currency === "EUR")   ? TRUE : FALSE)
			);
			
			echo formSelect(array(
				"id"    => "salary_currency",
				"name"  => "salary_currency", 
				"class" => "span1 required", 
				"field" => __("Currency")), 
				$options
			);			
			
			$options = array(
				0 => array("value" => "Full Time",   "option" => __("Full Time"),   "selected" => ($allocation === "Full Time")   ? TRUE : FALSE),
				1 => array("value" => "Half Time",   "option" => __("Half Time"),   "selected" => ($allocation === "Half Time")   ? TRUE : FALSE)
			);

			echo formSelect(array(
				"id"    => "allocation",
				"name"  => "allocation", 
				"p"  	=> TRUE, 
				"class" => "required", 
				"field" => __("Allocation Time")), 
				$options
			);

			echo formTextarea(array(	
				"name" 	 => "requirements", 
				"class"  => "markItUp",
				"style"  => "height: 240px;",
				"field"  => __("Requirements"), 
				"p" 	 => TRUE, 
				"placeholder" => __("Enter the necessary requirements to apply for the job"),
				"value"  => $requirements
			));

			echo formInput(array(	
				"name" 	=> "technologies", 
				"class" => "span5 required", 
				"field" => __("Technologies"), 
				"p" 	=> TRUE, 
				"placeholder" => __("Enter the technologies separated by commas"),
				"value" => $technologies
			));
			
			echo formField(NULL, __("Language") ."<br />". getLanguagesInput($language, "language", "select"));

			echo formInput(array(	
				"name" 	=> "save", 
				"class" => "btn btn-success", 
				"value" => __("Save"), 
				"type"  => "submit"
			));

			echo formInput(array(	
				"name" 	=> "preview", 
				"class" => "btn", 
				"value" => __("Preview"), 
				"type"  => "submit"
			));
					
			echo formInput(array("name" => "ID", "type" => "hidden", "value" => $ID, "id" => "ID_Job"));
		echo formClose();
	echo div(FALSE);
			