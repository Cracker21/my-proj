"use strict"

window.addEventListener('DOMContentLoaded',(e)=>{
    document.forms[0].onsubmit = async (e)=>{
        e.preventDefault();
        let data = new FormData(e.target);
		let rslt = await req(e.target.action, data)
        eval(e.target.action.split('/')[3] + '(rslt)');		//в ф-цию отправляется результат отправки формы
    }            
})
async function sendCode(){
	let data = new FormData();
	data.append('action', 'sendCode');
	data.append('email', email.value);
	let rslt = await req('reg', data);
	b.innerHTML = rslt.res;
}

async function reg(rslt){
	b.innerHTML = rslt.res;
}

async function login(rslt){
	b.innerHTML = rslt.res;
}

async function req(act, data){
    let response = await fetch(act, {
      	method: 'POST',
      	body: data
   	});

    let result = response.json();

	return result;   
}