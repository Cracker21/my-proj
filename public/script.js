"use strict"

window.addEventListener('DOMContentLoaded',(e)=>{
    document.forms[0].onsubmit = async (e)=>{
        e.preventDefault();
        let data = new FormData(e.target);
		let rslt = await req(e.target.action, data)
      if(rslt){
        eval(e.target.action.split('/')[3] + '(rslt)');		//в ф-цию отправляется результат отправки формы
      }
    }            
})
async function sendCode(){
	let data = new FormData();
	data.append('act', 'sendCode');
	data.append('email', email.value);
	let rslt = await req('reg', data);
	code.innerHTML = rslt.msg;
}
async function confEmail(){
  let data = new FormData();
  data.append('act', 'confirmEmail');
  data.append('mailCode', mailCode.value);
  let rslt = await req('reg', data);
  if(rslt.msg[0]){
    code.innerHTML = rslt.msg[1];
    b.innerHTML = "";
  }else
    b.innerHTML = rslt.msg[1];
}

async function logout(){
    let data = new FormData();
    data.append('act', 'logout');
    let rslt = await req('login', data);
    if(rslt.msg == '1')
        location.href = 'login';
}

async function reg(rslt){
    if(rslt.msg[0])
        location.href = 'login';
    else
        b.innerHTML = rslt.msg[1];
}

async function login(rslt){
  if(rslt.msg=='1')
    location.href = 'profile';
  else
	  b.innerHTML = rslt.msg;
}

async function req(act, data){
    let response = await fetch(act, {
      	method: 'POST',
      	body: data
   	});

    let result = response.json();

	return result;   
}