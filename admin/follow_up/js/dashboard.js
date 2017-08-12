var option1 = "Cured";
var option2 = "Improving";
var option3 = "Worsening";
var option4 = "Other";
var newDisease = false;
var curedDname;

var col={
	"Skin" : "skin-table",
	"Eye" : "eye-table",
	"ENT" : "ent-table",
	"Oral" : "oral-table",
	"General" : "general-table"
};

var tab={
	"skin-table" : "Skin",
	"eye-table" : "Eye",
	"ent-table" : "ENT",
	"oral-table" : "Oral",
	"general-table" : "General"
};

function begin(){
	setDetails();
	checkFollowUp();
	getSkinTable();
	getEyeTable();
	getEntTable();
	getOralTable();
	getGeneralTable();
	buttons.innerHTML += "<button class='btn btn-success btn-md' id='diag-add' style='float:right; margin-left:10px; width:100px;'  onclick='addDiagRow()'>Add</button> <button class='btn btn-danger btn-md' id='diag-delete' style='float:right; margin-left:0px; width:100px;'  onclick='deleteDiagRow()'>Delete</button>";

	getTreat();
}

//function to get Age of the Student
function getAge(dateString) {
	var today = new Date();
	var birthDate = new Date(dateString);
	var age = today.getFullYear() - birthDate.getFullYear();
	var m = today.getMonth() - birthDate.getMonth();
	if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
		age--;
		}
		return age+" years";
}

//function to get Gender of the Student
function getGender(gen){
	var gender="";
	switch(gen){
		case '1': gender="Male";
			break;
		case '2': gender="Female";
			break;
		case '3': gender="Other";
			break;
	}
	return gender;		
}

//function to get the Current Date
function currentDate(){
	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth()+1; //January is 0!
	var yyyy = today.getFullYear();

	if(dd<10) {
			dd='0'+dd
	} 

	if(mm<10) {
			mm='0'+mm
	} 

	today = yyyy+"-"+mm+"-"+dd;
	return today;
}

//function to display basic details of the Student
function setDetails(){
	document.getElementById("student_id").innerHTML = sid;
	document.getElementById("student_id_pre").innerHTML = sid;
	var child_name = document.getElementById("cname");
	var parent_name = document.getElementById("pname");
	var school_name = document.getElementById("sname");
	var child_gender = document.getElementById("cgender");
	var child_age = document.getElementById("cage");
	var parent_mobile = document.getElementById("pmobile");
	var school_mobile = document.getElementById("smobile");
	//var date = document.getElementById("date");
	var date = document.getElementById("treat_date");
	var height = document.getElementById("height");
	var weight = document.getElementById("weight");
	var dateIE = document.getElementById("dateIE");
	var count = document.getElementById("count");

	getData("queryDetails.php", sid);
	var tempdata = dataReceived.split('$');
	console.log(tempdata);
	school_name.innerHTML = tempdata[0];
	school_mobile.innerHTML = tempdata[1];

	child_name.innerHTML = tempdata[2];
	child_age.innerHTML = getAge(tempdata[7]);
	child_gender.innerHTML = getGender(tempdata[6]);
	parent_mobile.value = tempdata[8];
	height.innerHTML = tempdata[9]+" cm";
	weight.innerHTML = tempdata[10]+" Kg";
	dateIE.innerHTML = tempdata[11];
	count.innerHTML = tempdata[12];
	//consloe.log(document.getElementById("count").innerHTML);
	date.value = currentDate();
	console.log(document.getElementById("treat_date").value);

	if(tempdata[5].length > 0){
		parent_name.innerHTML = tempdata[5];
	}else if(tempdata[3].length > 0){
		parent_name.innerHTML = tempdata[3];
	}else if(tempdata[4].length > 0){
		parent_name.innerHTML = tempdata[4];
	}
}

//function to create a Table
function creatTable(tableName){
						
	var followUp = "<div class='form-group' style=\"float: right;\"><lable style='float: left;'>Next Follow Up Date : &emsp; </lable> <input type='date' class='datePicker' id=\"date-"+tableName.toLowerCase()+"\"> </div>";
	var table = "<table name='diagTables' class='table dia-table table-bordered' id='"+col[tableName]+"'><thead><tr><th class='firstCol'><center>Disease Name</center></th><th><center>Complaint</center></th><th><center>Comment</center></th><th><center>Select</center></th></tr></thead></table>";
	var panel= "<div class=\"panel panel-default\" id='"+col[tableName]+"FollowUp' style=\"margins:0px\"><div class=\"panel-heading\"><div id='"+col[tableName]+"Content'><div class='tableHead' id='"+col[tableName]+"Head'>"+tableName+": "+followUp+"</div></div></div><div class=\"panel-body\">"+table+"</div></div>";
	
	diagnosis.innerHTML +=panel;
}

//function to insert a row into a table
function insertRowRef(tableName,diseaseName){
	if(document.getElementById(tableName)==null){
		//console.log(tab[tableName]);
		creatTable(tab[tableName]);
	}
	dName = tab[tableName].toLowerCase()+"_"+diseaseName;
	
	var comp = "<div class='form-group'><input class='form-control' id=\"complaint-"+dName+"\" placeholder='Enter Complaint'></div>";

	obs = "<div class='form-group obsRadioGroup' id='radioBoxes"+dName+"'><div class='radio'><label><input type='radio' name='optionsRadios-"+dName+"' id='optionsRadios-"+dName+"0' checked>"+option1+"</label></div><div class='radio'><label><input type='radio' name='optionsRadios-"+dName+"' id='optionsRadios-"+dName+"1' value='"+option2+"'>"+option2+"</label></div><div class='radio'><label><input type='radio' name='optionsRadios-"+dName+"' id='optionsRadios-"+dName+"2' value='"+option4+"'>"+option3+"</label></div><div class='radio'><label><input type='radio' name='optionsRadios-"+dName+"' id='optionsRadios-"+dName+"3' value='"+option4+"'>"+option4+"</label></div></div>";
	//console.log("exits"+obs);

	if(newDisease){
		var obs = "<span name='newEntry' id='new-"+dName+"' style=\"font-size: 16px;\"><center><b>New Diagnosis<br></b></center></span>";
	    obs += "<div class='form-group obsRadioGroup' id='radioBoxes"+dName+"'><div class='radio'><label><input type='radio' name='optionsRadios-"+dName+"' id='optionsRadios-"+dName+"0'>"+option1+"</label></div><div class='radio'><label><input type='radio' name='optionsRadios-"+dName+"' id='optionsRadios-"+dName+"1' value='"+option2+"'>"+option2+"</label></div><div class='radio'><label><input type='radio' name='optionsRadios-"+dName+"' id='optionsRadios-"+dName+"2' value='"+option4+"'>"+option3+"</label></div><div class='radio'><label><input type='radio' name='optionsRadios-"+dName+"' id='optionsRadios-"+dName+"3' value='"+option4+"'>"+option4+"</label></div></div>";
		//console.log("new"+obs);
		//new_entry+"-"=1;
	}
	
	obs += "<div class='form-group'><input class='form-control' id=\"obsCom-"+dName+"\" placeholder='Enter Comments'></div>"
	
	var checkBox = "<center><input type='checkbox' class='treatBox' name=\"diagCheckBoxes\" id='check-"+dName+"' style='width:20px;' > </center>";
	
	var  diaTableRef = document.getElementById(tableName);
	//console.log("Table name : "+tableName);
	//console.log(diaTableRef);
	var row = diaTableRef.insertRow(-1);
	row.id=dName;

	var cell1 = row.insertCell(0);
	var cell2 = row.insertCell(1);
	var cell3 = row.insertCell(2);
	var cell4 = row.insertCell(3);
	
	// Add some text to the new cells:
	cell1.innerHTML = diseaseName;
	cell2.innerHTML = comp;	
	cell3.innerHTML = obs;	
	cell4.innerHTML = checkBox;	
	
	newDisease = false;
}

function checkFollowUp()
{
	getData("follow_check.php",sid);
	curedDname=JSON.parse(dataReceived);
	console.log(curedDname  );
}

//function to generate the Skin Table
function getSkinTable(){
	dataReceived = "";
	checkFollowUp();
	getData("skin.php", sid);
	var skinData = JSON.parse(dataReceived);
		console.log(skinData);
	if(curedDname[1][0].length!=0){
		creatTable("Skin");
			for(var i = 0; i < curedDname[1][0].length; i++){
					//if(diseaseName!=curedDname[1][0][j])
					insertRowRef('skin-table',curedDname[1][0][i]);
			}	
	}
	if(skinData['ref'] != null && skinData['check']!=0 && curedDname[2]==null ){
		creatTable("Skin");
		for(var i = 0; i < skinData['colNames'].length; i++){
			var diseaseName = skinData['colNames'][i];
			insertRowRef('skin-table',diseaseName);
		}
	}	

	/*else if((skinData['ref'] != null && skinData['check']!=0 && curedDname[0].length!=0 ) && curedDname[2]==0){
		if(curedDname[0][0].length!=skinData['colNames'].length){
			creatTable("Skin");
			for(var i = 0; i < skinData['colNames'].length; i++){
				var diseaseName = skinData['colNames'][i];
				for(j=0;j<curedDname[0][0].length;j++){	
					if(curedDname[2]==0){
					if(diseaseName!=curedDname[0][0][j])	
					insertRowRef('skin-table',diseaseName);
					}
				}
			}
		}
	}*/


}

//function to generate the Eye table
function getEyeTable(){
	dataReceived = "";
	getData("eye.php", sid);
	var eyeData = JSON.parse(dataReceived);
	//console.log(eyeData);
	if(curedDname[1][2].length!=0){
		creatTable("Eye");
			for(var i = 0; i < curedDname[1][2].length; i++){
					//if(diseaseName!=curedDname[1][0][j])
					insertRowRef('eye-table',curedDname[1][2][i]);
			}	
	}

	if(eyeData['ref'] != null && eyeData['check']!=0 && curedDname[2]==null){
		creatTable("Eye");
		for(var i = 0; i < eyeData['colNames'].length; i++){
			var diseaseName = eyeData['colNames'][i];
			insertRowRef('eye-table',diseaseName);
		}

	}
	/*else if(eyeData['ref'] != null && eyeData['check']!=0 && curedDname[0].length!=0){
		if(curedDname[0][2].length!=eyeData['colNames'].length){
			creatTable("Eye");
				for(var i = 0; i < eyeData['colNames'].length; i++){
				var diseaseName = eyeData['colNames'][i];
				//console.log(eyeData['colNames'].length);
				for(j=0;j<curedDname[0][2].length;j++){
					if(diseaseName!=curedDname[0][2][j])					
					insertRowRef('eye-table',diseaseName);
				}
			}
		}
	}*/
}

//function to generate the ENT table
function getEntTable(){
	dataReceived = "";
	getData("ent.php", sid);
	var entData = JSON.parse(dataReceived);
	console.log(entData);

	if(curedDname[1][3].length!=0){
		creatTable("ENT");
			for(var i = 0; i < curedDname[1][3].length; i++){
					//if(diseaseName!=curedDname[1][0][j])
					insertRowRef('ent-table',curedDname[1][3][i]);
			}	
	}

	if(entData['ref'] != null && entData['check']!=0 && curedDname[2]==null){
		creatTable("ENT");
		for(var i = 0; i < entData['colNames'].length; i++){
			var diseaseName = entData['colNames'][i];
			insertRowRef('ent-table',diseaseName);
		}

	}
	/*else if(entData['ref'] != null && entData['check']!=0 && curedDname[0].length!=0){
		if(curedDname[0][3].length!=entData['colNames'].length){
			creatTable("ENT");
			for(var i = 0; i < entData['colNames'].length; i++){
				var diseaseName = entData['colNames'][i];
				for(j=0;j<curedDname[0][3].length;j++){	
					if(diseaseName!=curedDname[0][3][j])				
					insertRowRef('ent-table',diseaseName);
				}
			}
		}
	}*/
}

//function to generate the General table
function getGeneralTable(){
	dataReceived = "";
	getData("general.php", sid);
	var genData = JSON.parse(dataReceived);
	console.log(genData);

	if(curedDname[1][4].length!=0){
		creatTable("General");
			for(var i = 0; i < curedDname[1][4].length; i++){
					//if(diseaseName!=curedDname[1][0][j])
					insertRowRef('general-table',curedDname[1][4][i]);
			}	
	}

	if(genData['ref'] != null && genData['check']!=0 && curedDname[2]==null){
		creatTable("General");
		for(var i = 0; i < genData['colNames'].length; i++){
			var diseaseName = genData['colNames'][i];
			insertRowRef('general-table',diseaseName);
		}

	}
	/*else if(genData['check']!=0 && genData['ref'] != null && curedDname[0].length!=0){
		if(curedDname[0][4].length!=genData['colNames'].length){
			creatTable("General");
			for(var i = 0; i < genData['colNames'].length; i++){
				var diseaseName = genData['colNames'][i];
				for(j=0;j<curedDname[0][4].length;j++){	
					if(diseaseName!=curedDname[0][4][j])		
					insertRowRef('general-table',diseaseName);
				}	
			}
		}
	}*/
}

//function to generate the Oral table
function getOralTable(){
	dataReceived = "";
	getData("oral.php", sid);
	var oralData = JSON.parse(dataReceived);
	//console.log(oralData);
	if(curedDname[1][1].length!=0){
		creatTable("Oral");
			for(var i = 0; i < curedDname[1][1].length; i++){
					//if(diseaseName!=curedDname[1][0][j])
					insertRowRef('oral-table',curedDname[1][1][i]);
			}	
	}

	if(oralData['ref'] != null && oralData['check']!=0 && curedDname[2]==null){
		creatTable("Oral");
		for(var i = 0; i < oralData['colNames'].length; i++){
			var diseaseName = oralData['colNames'][i];
			insertRowRef('oral-table',diseaseName);
		}

	}
	/*else if(oralData['ref'] != null && oralData['check']!=0 && curedDname[0][1].length!=0){
		if(curedDname[0][1].length!=oralData['colNames'].length){
			creatTable("Oral");
			for(var i = 0; i < oralData['colNames'].length; i++){
				var diseaseName = oralData['colNames'][i];
				for(j=0;j<curedDname[0][1].length;j++){	
					if(diseaseName!=curedDname[0][1][j])	
					insertRowRef('oral-table',diseaseName);
				}
			}
		}
	}*/
}

//function to Add another Row in a table
function addDiagRow(){
	vex.dialog.open({
	  message: 'Select Group Name and Disease Name:',
	  input: "<div class=\"form-group\"><label for=\"selectTable\">Select Group:</label><select name=\"table\" class=\"form-control\" id=\"selectTable\" onInput=\"showHint(this.value)\" ><option>Select Table</option><option>Skin</option><option>Eye</option><option>ENT</option><option>Oral</option><option>General</option></select></div><br><div class=\"form-group\"><label for=\"diseaseName\">Disease Name:</label><select class=\"form-control\" id=\"diseaseName\" name=\"disease\"></div>",
		/*div id=\"auto\"><input type=\"text\" class=\"form-control\" id=\"diseaseName\" placeholder=\"Enter Disease Name\" name=\"disease\" onkeyup=\"showHint(this.value)\"><input id=\"autocomplete\" type=\"text\" disabled=\"disabled\"/></div></div>*/
		buttons: [
			$.extend({}, vex.dialog.buttons.YES, {
			  text: 'Add'
			}), $.extend({}, vex.dialog.buttons.NO, {
			  text: 'Cancel'
			})
	  ],
	  callback: function(data) {
				if (data === false) {
				  return console.log('Cancelled');
				}
				else if(data.table.localeCompare("Select Table")==0){
					addDiagRow();
					vex.dialog.alert("Please Select A Table");
				}
				else{
					//console.log(data.table+" "+col[data.table]+" "+data.disease);
					newDisease = true;
					insertRowRef(col[data.table],data.disease);
					return;	
				}
			  }
		});
}

function deleteDiagRow(){
	var checkboxes = document.getElementsByName("diagCheckBoxes");
	// loop over them all
	for (var i=0; i<checkboxes.length; i++) {
		// And stick the checked ones onto an array...
		if (checkboxes[i].checked) {
			
			var checkBoxID = checkboxes[i].id.split("check-").pop();
			
			var row = document.getElementById(checkBoxID);
			
			var tableID = row.parentNode.parentElement.id;
			
			//console.log(tableID);
    		row.parentNode.removeChild(row);
			removeTableIfNoRow(tableID);
			deleteDiagRow();
		}
	}
}

function removeTableIfNoRow(tableID){
	var content = document.getElementById(tableID+"FollowUp");
	var length = document.getElementById(tableID).rows.length;
	if(length <= 1)
		{
			diagnosis.removeChild(content);
		}
	return;
}

//function to move to the next student
function newStudent(){
	var saved = validate();
	console.log("Saved:",saved);
	if(saved == 1)
	{
		vex.dialog.prompt({
			message: 'Enter Student ID',
			value: parseFloat(sid) + 1,
			callback: function(studentID) {
				dataReceived = '';

				console.log("Student ID", studentID);
				getData("checkStudent.php",studentID);
				console.log("checkStudent", dataReceived);
				if (studentID != null && dataReceived.localeCompare('sucessfull') == 0) {
					sid = studentID;
					diagnosis.innerHTML="";
					buttons.innerHTML="";
					begin();
					return;
				}
				else if(studentID == false){
						return;
					}
				else{
					newStudent();
					vex.dialog.alert("Invalid Student ID..Please try again");
				}
			}
		});
		vex.dialog.alert("Saved Successfully!");
	}
	else if(saved == 2)
		return;
	else
	{
		vex.dialog.alert("A Problem Occured While Saving! Please Try Again Later!");
		return;
	}
}

//function to save data to the database
function saveStudent(){
	var tables = document.getElementsByName("diagTables");
	//var newEntries = document.getElementsByName("newEntries");
	//console.log(tables[0]);
	var allData = {"child_id" : sid,
				  "phone" : document.getElementById("pmobile").value,
				  "treat_date" : document.getElementById("treat_date").value,
				  "count" : document.getElementById("count").innerHTML};
	var tableData={};
	for(var i = 0; i < tables.length ; i++){
		var table = tables[i];
		//console.log("ghiuw"+table.id);
		var tableName = tab[table.id].toLowerCase();
		//console.log(tableName);
	
		var date = document.getElementById("date-"+tableName).value;
		
		var dataArray = [];
		for (var a = 0, row; row = table.rows[a]; a++) {
			var rowID = row.id;

			if(rowID != ""){
				var data = retrieveDataFromRowID(rowID);
				dataArray.push(data);
			}
		}
		//console.log(dataArray);
		tableData[tableName] = {
			"data" : dataArray,
			"followUpDate" : date
			};
	}
	cleanTreat();
	tableData["treatment"] = retrieveTreatData();
	console.log(tableData);
	allData["data"]=JSON.stringify(tableData);
	console.log(allData);
	dataReceived = "";
	console.log("all Data : ", allData);
	getData("saveData.php",JSON.stringify(allData));
	var output = dataReceived;
	console.log("SaveStudent : ",dataReceived);
	dataReceived = "";
	return output;
}

//function to retrieve data from row
function retrieveDataFromRowID(rowID){
	var disease = rowID.split("_")[1];

	var complaint = document.getElementById("complaint-"+rowID).value;

	var observation = "";

	var radios = document.getElementsByName("optionsRadios-"+rowID);
	for(var b = 0; b < radios.length; b++){
		var radio = radios[b];
		if(radio.checked){
			observation = radio.id.slice(-1);
			break;
		}
	}

	var comment = document.getElementById("obsCom-"+rowID).value;
	
	var json_data={
		"disease" : disease,
		"complaint" : complaint,
		"observation" : observation,
		"comment" : comment};
	//console.log(json_data);
	
	return json_data;
}

//function to retrieve data from treatment table
function retrieveTreatData()
{
	var treat_table = document.getElementById("treat-table");
	var treatdataArray = [];
	for (var a = 0, row; row = treat_table.rows[a]; a++) {
		var rowID = row.id.split("-")[2];
		//console.log(rowID);
		if(rowID != 0){
			var treat_name = document.getElementById("treat-med-"+rowID).value;

			var frequency =  document.getElementById("treat-freq-"+rowID).value;

			var duration =  document.getElementById("treat-dur-"+rowID).value;

			treatdataArray.push({
				"treat_name" : treat_name,
				"frequency" :  frequency,
				"duration" : duration});		
		}
	}
	return treatdataArray;
}

//function to validate
function validate(){
	var output = 0;
	var everythingOkay = true;
	var organs = Object.keys(checkValidate());
	//console.log(organs.length);
	for(var i=0; i < organs.length; i++)
	{
		//console.log(organs[i]);
		var followD = document.getElementById("date-"+organs[i]).value;
		//console.log(followD);
		if(followD.length == 0)
		{	
			everythingOkay = false;
			output = 2;
			vex.dialog.alert("Please Select Next Follow Up Date for "+ organs[i].toUpperCase());	
			break;
		}
	}
	if(everythingOkay)
		output = saveStudent();
	return output;
}

//function to check which organ needs follow up
function checkValidate(){
	var radioGroups = document.getElementsByClassName("obsRadioGroup");
	var fValidate = {};
	for(var i = 0;i < radioGroups.length; i++)
	{
		var radioGroup = radioGroups[i];
		//console.log(radioGroup);
		var groupID = radioGroup.id;
		var dName = groupID.split("radioBoxes")[1];
		var oName = dName.split("_")[0];
		//console.log(dName);
		var radios = document.getElementsByName("optionsRadios-"+dName);
		//console.log(radios);
		for(var j = 0;j < radios.length; j++)
		{
			if(radios[j].checked && radios[j].id.slice(-1).localeCompare('0')!=0)
			{
				fValidate[oName] = true;
				break;
			}
		}
	}
	//console.log(fValidate);
	return(fValidate);
}

var sl = 1;
function getTreat(){
	dataReceived = "";
	getData("treat.php", sid);
	var treatData = dataReceived.split('$');
	//console.log(treatData);
	for(var i = 0; i < 4; i++){
		if(treatData[i] != 0){
			var medData = treatData[i].split('@');
			var checkBox = "<center><input type='checkbox' class='treatBox' id='treat"+sl+"' style='width:50px;'></center> ";
			insertRowTreat(medData[1],medData[2],medData[3],checkBox);
		}
	}
}

function addTreat(){
	var checkBox = "<center><input type='checkbox' class='treatBox' id='treat"+sl+"' style='width:50px;' ></center> ";
	insertRowTreat("","","",checkBox);
}

function insertRowTreat( c1, c2, c3, c4){

	var  treatTableRef = document.getElementById('treat-table');
	var row = treatTableRef.insertRow(-1);
	row.id = "treat-row-"+sl;

	var cell1 = row.insertCell(0);
	var cell2 = row.insertCell(1);
	var cell3 = row.insertCell(2);
	var cell4 = row.insertCell(3);

	// Add some text to the new cells:
	cell1.innerHTML = "<input type='text' id='treat-med-"+sl+"' value='"+c1+"'>";	
	cell2.innerHTML = "<center><input type='number' id='treat-freq-"+sl+"' value='"+c2+"' style='width:100px'></center>";
	cell3.innerHTML = "<center><input type='text' id='treat-dur-"+sl+"' value='"+c3+"' style='width:100px'></center>";
	cell4.innerHTML = c4;
	sl++;
}

function deleteTreat(){
	var  treatTableRef = document.getElementById('treat-table');
	var x = document.getElementsByClassName("treatBox");
	//console.log("checked box: "+x);
	for(var i = 0; i < x.length; i++){
		var temp = x[i].id;
		//console.log("checked box ID: "+temp);
		if(document.getElementById(temp).checked){
			for (var j = 1; j < treatTableRef.rows.length ; j++) {								
				//console.log("Row cells:"+treatTableRef.rows[j].cells[4].children[0].id);
				if(temp.localeCompare(treatTableRef.rows[j].cells[3].children[0].id) == 0){
					//console.log("Row cells selected:"+treatTableRef.rows[j].cells[4].children[0].id);
					treatTableRef.deleteRow(j);
				}  
			}	
		}
	}

}

function deleteRows(){
	var tab1 = document.getElementById('med-table');
	var tab2 = document.getElementById('treat-table');
	for(var i = tab1.rows.length - 1; i > 0; i-- ){
		tab1.deleteRow(i);
	}
	for(var i = tab2.rows.length - 1; i > 0; i-- ){
		tab2.deleteRow(i);
	}
}

function cleanTreat(){
	var table = document.getElementById("treat-table");
	var row;
	for (var i = table.rows.length - 1; i > 0; i--) {
		row = table.rows[i];
		for (var j = 0, col; col = row.cells[j]; j++) {
			//console.log(col.children[0] + " "+j);
			if(col.children[0].value !=""){
				//break;
			}
			else{
				//console.log("del: "+col.children[0].value.length);
				table.deleteRow(i);
				break;
			}
		}  
	}
}

//function to get diseases for an organ system
function showHint(table) {
	if(table.localeCompare("Select Table") !=0){

		// Create a new XMLHttpRequest.
		var request = new XMLHttpRequest();

		// Handle state changes for the request.
		request.onreadystatechange = function(response) {

		if (request.readyState === 4 && request.status === 200) {
			//creating new datalist for every new query to ensure no repeatition
			//document.getElementById('data').innerHTML="<datalist id=\"columns\"></datalist>";
			var dataList = document.getElementById('diseaseName');
			//dataList.innerHTML="";
			console.log(request.responseText);
			// Parse the JSON
			var jsonOptions = JSON.parse(request.responseText);

			//clearing select
			for (i = dataList.options.length-1; i >=0; i--) {
				dataList.remove(dataList.i);
			}

			// Loop over the JSON array.
			jsonOptions.forEach(function(item) {
				// Create a new <option> element.
				var option = document.createElement('option');
				// Set the value using the item in the JSON array.
				option.text = item;
				// Add the <option> element to the <datalist>.
				dataList.add(option);
			});

		} 
		};

		// Set up and make the request.
		request.open('POST', "http://"+ip_address+"/follow_up/php/gethint.php", true);
		request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		request.send("t="+table);	
	}
}

// Function to get Data from DB
function getData(phpName, stud_id) {
	var xhttp,data;
	if (window.XMLHttpRequest){
		xhttp = new XMLHttpRequest();
	}
	else{
		xhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xhttp.onreadystatechange = function ()
	{
		if(xhttp.readyState==4 && xhttp.status==200)
		{
			data = xhttp.responseText;
			if(!data.includes("Unsuccessful")){
				dataReceived = data;
				//console.log(data);
			}
			else{
				console.error("Unsuccessful retrieval");
			}
		}
	};
	xhttp.open("POST","http://"+ip_address+"/follow_up/php/"+phpName,false);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("s="+stud_id);
}
