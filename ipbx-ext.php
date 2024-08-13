<?php
    require_once "config.php";
    require_once "common/session-ctl.php";
    
    if(isset($_SESSION["Alive"])){
        if($_SESSION["Alive"] != "Alive"){
            header("Location: index.php");
        }
    }
    else{
        header("Location: index.php");
    }

?>

<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</head>
<body class="bg-base-200">
    <div>
        
        <?php include 'header.php';?>

        <div class="drawer xl:drawer-open">
            <!-- content -->
            <input id="drawer-leftmenu" type="checkbox" class="drawer-toggle" />
            <div class="drawer-content min-h-[calc(100vh-68px)]">
                <div class="bg-white m-5 p-5 rounded-md">
                    <h1 class="text-2xl font-semibold">Extension Status</h1>
                    <div class="flex flex-row gap-4 pt-2">
                        <span id="summary">-</span>
                        <div class="divider divider-horizontal"></div>
                        <span id="currentDate">-</span>
                    </div>
                </div>
                <div class="bg-white mx-5 my-0 p-5 rounded-md">
                    <div>
                        <table id="tblTruck" class="table">
                            <!-- head -->
                            <thead>
                                <tr class="text-xl">
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>IP Address</th>
                                    <th>Port</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- left menu -->
            <div class="drawer-side">
                <label for="drawer-leftmenu" aria-label="close sidebar" class="drawer-overlay"></label>
                <ul class="menu h-full p-4 bg-white text-xl">
                    <!-- Sidebar content here -->
                    <li class="">
                        <details>
                        <summary class="hover:bg-base-200 hover:text-black">Administrator</summary>
                        <ul>
                            <li><a href="./users.php" alt="" class="hover:bg-base-200 hover:text-black">Users</a></li>
                        </ul>
                    </li>
					<li><a href="./billing.php" alt="" class="hover:bg-base-200 hover:text-black">Billing</a></li>
                    <li><a href="./ipbx-trunk.php" alt="" class="hover:bg-base-200 hover:text-black">Trunk Status</a></li>
                    <li><a href="./ipbx-ext.php" alt="" class="text-orange-700">Extension Status</a></li>
                </ul>
            </div>
        </div>

    </div>

    <script>

        $(document).ready(function(){
		
		var endpoints = [];
		var contacts = [];

		//Refresh process
            	init();
	    	setInterval(function(){init();}, 3000);

	    	//Start process over here
            	function init(){

			endpoints = [];
			contacts = [];

			getEndPoint();
                	showLocalDate();
            	}

		// Retive data and filter
		function mergeData(){
			//console.log(endpoints);
			//console.log(contacts);
			const results = [];
			endpoints.map((item)=>{
				results.push({
					name: item.name,
					type: item.type,
					status: item.status,
					statusStyle: item.statusStyle,
					isOnline: item.isOnline,
					contacts: contacts.filter((element)=>element.name === item.name) ?? []
				});
			});
			//bindingTable(results ?? []);
			bindingTable(results.filter((element)=>element.type==='Extension') ?? []);
		}
		
		function bindingTable(obj){
			let str = '';
			let cnt = 0;
			let cntOnline = 0;

			obj.sort((a, b) => a.name.localeCompare(b.name));
			obj.map((header)=>{

				if(header.contacts.length == 0){

					cnt++;
					cntOnline += header.isOnline;
					str += `
						<tr class="hover:bg-base-200 hover:text-black text-xl">
                                    		<th>${cnt}</th>
                                    		<td>${header.name}</td>
                                    		<td></td>
                                    		<td></td>
                                    		<td><div class="${header.statusStyle}">${header.status}</div></td>
                                		</tr>
					`

				}

				header.contacts.map((item)=>{
					cnt++;
					cntOnline += item.isOnline;
					str += `
						<tr class="hover:bg-base-200 hover:text-black text-xl">
                                    		<th>${cnt}</th>
                                    		<td>${item.name}</td>
                                    		<td><a target="_blank" href="http://${item.ip}" class="underline underline-offset-1 text-orange-700">${item.ip}</a></td>
                                    		<td>${item.port}</td>
                                    		<td><div class="${header.statusStyle}">${header.status}</div></td>
                                		</tr>
					`
				});
			});
			showSummary(cntOnline,cnt);
			$('#tblTruck').find('tbody').find('tr').remove();
			$('#tblTruck').find('tbody').append(str);
		}

		function getEndPoint(){
			$.ajax({ url: './asterisk/getendpoint.php'})
                 	.done(function(res){
				let data = [];
				let arrs = res.replace('\n\r','\n').split("\n");
				arrs.map((item)=>{
					if(item.match(/Endpoint/) == 'Endpoint' && !item.includes('<Endpoint')){
						let name = item.replace(' Endpoint:  ','').split(' ')[0];
						endpoints.push({name:name.trim(),
							type:getType(name),
							status:getStatus(item),
							statusStyle: getStatusStyle(item),
							isOnline: checkOnline(item),
						});
					}
				});
                    		getContacts();
                 	});
		}
		
		function getContacts(){
			$.ajax({ url: './asterisk/getcontacts.php'})
                 	.done(function(res){
				var data = [];
                    		let arrs = res.replace('\n\r','\n').split("\n");
				arrs.map((item)=>{
					if(item.match(/Contact/) == 'Contact' && !item.includes('ContactUri')){
						let arrItem = item.trim().split(/\s+/);
						let spiltNameAndIp = '';

						if(arrItem[1].includes('@')){
							spiltNameAndIp = '@';
						}
						else{
							spiltNameAndIp = '/sip:';
						}

						let name = arrItem[1].split(spiltNameAndIp)[0].replace('sip:','');
						let ipport = arrItem[1].split(spiltNameAndIp)[1];
						contacts.push({name:name,
							ip:ipport.split(':')[0],
							port:ipport.split(':')[1],
							type:getType(name),
							status:getStatus(arrItem[3]),
							statusStyle: getStatusStyle(arrItem[3]),
							isOnline: checkOnline(arrItem[3]),
						});
					}
				});
				mergeData();
                 	});
		}

		function getStatus(txt){
			if(txt.match(/In use/gi) == 'In use'){
				return 'In use'; 			
			}
			else if(txt.match(/Not in use/gi) == 'Not in use'){
				return 'Not in use'; 			
			}
			else if(txt.match(/Unavailable/gi) == 'Unavailable'){
				return 'Unavailable';
			}
			else if(txt.match(/Avail/gi) == 'Avail'){
				return 'Avail';
			}
			else if(txt.match(/Ringing/gi) == 'Ringing'){
				return 'Ringing';
			}

		}

		function getStatusStyle(txt){
			if(txt.match(/In use/gi) == 'In use'){
				return 'badge badge-error text-white'; 			
			}
			else if(txt.match(/Not in use/gi) == 'Not in use' || txt.match(/Avail/gi) == 'Avail' ){
				return 'badge badge-success text-white'; 			
			}
			else if(txt.match(/Ringing/gi) == 'Ringing'){
				return 'badge badge-warning';
			}
			else if(txt.match(/Unavailable/gi) == 'Unavailable'){
				return 'badge badge-neutral';
			}
		}

		function checkOnline(txt){
			if(txt.match(/In use/gi) == 'In use'){
				return 1; 			
			}
			else if(txt.match(/Not in use/gi) == 'Not in use' || txt.match(/Avail/gi) == 'Avail' ){
				return 1; 			
			}
			else if(txt.match(/Avail/gi) == 'Ringing'){
				return 1;
			}
			else if(txt.match(/Unavailable/gi) == 'Unavailable'){
				return 0;
			}
		}

		function getType(txt){
			let regExp = /[a-zA-Z]/g;
			if (regExp.test(txt)) {
  				return 'Trunck';
			}
			else{
				return 'Extension';
			}
		}


            	function showSummary(online, total){
			let str = '<span class="badge badge-success text-white">'+online+'</span> online of '+total;
                	$('#summary').html(str);
            	}

            	function showLocalDate() {
                	var dNow = new Date();
                	//console.log(dNow);
               	 	var localdate= dNow.getDate()+ '/' + (dNow.getMonth()+1) + '/' + dNow.getFullYear() + ' ' + dNow.getHours() + ':' + dNow.getMinutes() + ':' + dNow.getSeconds();
                	$('#currentDate').text(localdate);
            	}

        });

    </script>

</body>
</html>
