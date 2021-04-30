let ws = new WebSocket('ws://localhost:2346/WS.php');

ws.onopen = function(e){
	debug.innerHTML+= '<br>connected<br>';
	console.log('connected')
	ws.send(JSON.stringify({'srvc': 1, 'sid': sid.value}));
}
ws.onclose = function(e){
	debug.innerHTML+= '<br>closed<br>';
	console.log('closed '+e.code+" "+e.wasClean);
}
ws.onerror = function(error){
	debug.innerHTML+= 'error '+error.message+"<br>";
	console.log('closed')
}
ws.onmessage = function(event){
	let data = JSON.parse(event.data);
	msgs.innerHTML+=data;
}
function sendMsg(){
	let chid = document.querySelector('.active').id;
	ws.send(JSON.stringify({'msg': msgInp.value, 'sid': sid.value, 'chid': chid}));
	msgInp.value='';
}
