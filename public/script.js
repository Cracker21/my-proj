"use strict"

window.addEventListener('DOMContentLoaded', async (e)=>{
    if(document.forms[0]){
        document.forms[0].onsubmit = async (e)=>{
            e.preventDefault();
            let data = new FormData(e.target);
    		let rslt = await req(e.target.action, data)
          if(rslt){
            eval(e.target.action.split('/')[3] + '(rslt)');		//в ф-цию отправляется результат отправки формы
          }
        }
    }
    let tab = container.querySelector('a[href="'+container.className+'"]');         //выделяет выбранную вкладку
    tab.classList.add('selected');
    /*if ('serviceWorker' in navigator) {
        try {
            const reg = await navigator.serviceWorker.register('sw.js')
            console.log('Service worker register success', reg)
        } catch (e) {
            console.log('Service worker register fail')
        }
    }*/
})

function delActive(){
    let arr = document.getElementsByClassName('active');
    if(arr[0])arr[0].classList.remove('active');
}


async function load(el){
    delActive();
    el.classList.add('active');
    let data = new FormData();
    data.append('act', 'loadMsgs');
    data.append('chid', el.id);
    let rslt = await req('chats', data);
    msgs.innerHTML = rslt.msg[1];
}


async function sendCode(){
    let data = new FormData();
    data.append('act', 'sendCode');
    data.append('email', email.value);
    let rslt = await req('reg', data);
    if(rslt.msg[0]){
        mTimer(30);
        code.innerHTML = rslt.msg[1];
    }else{
        rsp.innerHTML = rslt.msg[1];
    }
}



async function confEmail(){
  let data = new FormData();
  data.append('act', 'confirmEmail');
  data.append('mailCode', mailCode.value);
  let rslt = await req('reg', data);
  if(rslt.msg[0]){
    code.innerHTML = rslt.msg[1];
    rsp.innerHTML = "";
  }else
    rsp.innerHTML = rslt.msg[1];
}

async function reg(rslt){
    if(rslt.msg[0])
        location.href = 'login';
    else
        rsp.innerHTML = rslt.msg[1];
}

async function login(rslt){
  if(rslt.msg=='1')
    location.href = 'profile';
  else
	  rsp.innerHTML = rslt.msg;
}

async function req(act, data){
    let response = await fetch(act, {
      	method: 'POST',
      	body: data
   	});

    let result = response.json();

    if(result.msg == 0)return false;

	return result;   
}
function qs($s){
    return document.querySelector($s);
}

function shP(e){
    if(e.attributes[1].value == 'cls.png'){
        qs("input[name='pass']").type = "text";
        qs("input[name='pass2']").type = "text";
        e.src = 'open.png';
    }else{
        qs("input[name='pass']").type = "password";
        qs("input[name='pass2']").type = "password";
        e.src = 'cls.png';
    }
}

function mTimer(time){
    let timer = setInterval(function(){
        if(time <= 0){
            clearInterval(timer);
            t.innerHTML = "<input id='sC' type='button' value='Отправить код подтверждения' onclick='sendCode()'>";
            return;
        }
    t.innerHTML = 'Повторная отправка возможна через '+time--;
    },1000)
}