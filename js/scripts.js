/**
		* Sets the color of the priority selector according to the select value
		* sets it green for low, yellow for medium and red for high.
		*/
		function setColor()
		{
			var prio = document.getElementById("priority");
			if(prio.value == "Low")
			{
				prio.style.backgroundColor = "#C2F0C2"
			}
			else if(prio.value == "Medium")
			{
				prio.style.backgroundColor = "#FFFFC2"
			}
			else //prio.val = high
			{
				prio.style.backgroundColor = "#FFAD99"
			}
		}
		
		/**
		* the "on Submit" function for the ticket form, this function
		* will validate the fields (check if they are empty or not) and 
		* submit the form for data to the php server for the next handling
		*/
		function submitFunction()
		{
			var allGood = true; //if this is true at the end, then there was no issues
			//grab the form DOM element values
			var name = document.getElementById("fullName").value;
			var device = document.getElementById("deviceType").value;
			var request = document.getElementById("requestType").value;
			var contactInfo = document.getElementById("contactInfo").value;
			var description = document.getElementById("description").value;
			var priority = document.getElementById("priority").value;
			
			//check to see if all the values are valid/ have something in them, 
			allGood = isEmptySetError(name, "nameError", allGood);
			allGood = isEmptySetError(device, "deviceError", allGood);
			allGood = isEmptySetError(request, "requestError", allGood);
			allGood = isEmptySetError(contactInfo, "contactError", allGood);
			allGood = isEmptySetError(description, "descriptionError", allGood);
		
			if(allGood == true)
			{
				createTicket(name, device, request, contactInfo, description, priority)
			}
			else
			{
				//do nothing, errors will be shown
			}
		}
		
		/**
		* value: text value that is checked to see if its empty
		* ErrorId: the id of a DOM element that will display the error text (a span)
		* allGood: a boolean value, used to pass on the old value when the else case happens
		* if the value of value is "" then set the error text to "* Required", if the 
		* value is not empty, set the Error message to ""
		*/
		function isEmptySetError(value, ErrorId, allGood)
		{
			if(value == "")
			{
				document.getElementById(ErrorId).innerHTML = "* Required";
				return false;
			}
			else
			{
				document.getElementById(ErrorId).innerHTML = "";
				return allGood;
			}
		}
		
		/**
		*creates an ajax request and sends the ticket info to the server to be placed in the database
		*/
		function createTicket(name, device, request, contactInfo, description, priority)
		{    
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					alert("Ticket Submitted Successfully")
					document.location.href = "index.html";
				}
			}
			var postParams = "name="+name+"&device="+device+"&request="+request+"&contactInfo="+contactInfo+"&description="+description+"&priority="+priority;
			xmlhttp.open("POST", "createTicket.php", true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send(postParams);
		}
		
		/**
		*helper function that grabs the password value for the checkPassword function
		*/
		function submitPass()
		{
			var pass = document.getElementById("password").value;
			checkPassword(pass);
		}
		
		
		/**
		*/
		function checkPassword(password)
		{    
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					if(xmlhttp.responseText == "true")
					{
						document.location.href = "adminLogin.php";
					}
					else
					{
						alert("Wrong Password!");
					}
				}
			}
			var postParams = "password="+password;
			xmlhttp.open("POST", "checkPass.php", true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send(postParams);
		}
        
		function changeStatus(ticketID)
		{    
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					if(xmlhttp.responseText == "true")
					{
						document.location.href = "changeStatus.php";
					}
					else
					{
						alert("Wrong Password!");
					}
				}
			}
			var postParams = "id="+ticketID;
			xmlhttp.open("POST", "checkPass.php", true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send(postParams);
		}