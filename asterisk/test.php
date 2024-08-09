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
<body>
    

    <script>

        $(document).ready(function(){

		init();

		var endpoints = [];
		var contacts = [];
		var results = [];
		
		function init(){
			endpoints = [];
			contacts = [];
			results = [];
			getEndPoint();
		}

		function mergeData(){
			endpoints.map((item)=>{
				results.push({
					name: item.name,
					type: item.type,
					status: item.status,
					contacts: contacts.find((element)=>element.name === item.name) ?? []
				});
			});
			console.log(results);
		}

		function getEndPoint(){
			$.ajax({ url: './getendpoint.php'})
                 	.done(function(res){
				let data = [];
				let arrs = res.replace('\n\r','\n').split("\n");
				arrs.map((item)=>{
					if(item.match(/Endpoint/) == 'Endpoint' && !item.includes('<Endpoint')){
						let name = item.replace(' Endpoint:  ','').split(' ')[0];
						endpoints.push({name:name.split('/')[0].trim(),
							type:getType(name),
							status:getStatus(item),
						});
					}
				});
                    		getContacts();
                 	});
		}
		
		function getContacts(){
			$.ajax({ url: './getcontacts.php'})
                 	.done(function(res){
				var data = [];
                    		let arrs = res.replace('\n\r','\n').split("\n");
				arrs.map((item)=>{
					if(item.match(/Contact/) == 'Contact' && !item.includes('ContactUri')){
						let allStr = item.replace(' Contact:  ','');
						let spAllStr = allStr.split('/');
						let uri1 = spAllStr[1].replace('sip:','');
						let uri2 = uri1.split(' ')[0];
						let ip = uri2.split(':')[0];
						//Find ip
						if(ip.includes('@')){
							ipRmAdd = ip.split('@')[1];
						}
						else{
							ipRmAdd = ip;
						}
						contacts.push({name:spAllStr[0].trim(),
							ip:ipRmAdd.trim(),
							port:uri2.split(':')[1].trim(),
							type:getType(spAllStr[0]),
							status:getStatus(allStr),
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
            
        });

    </script>

</body>
</html>