<style scoped>

* {
	 -webkit-box-sizing: border-box;
	 box-sizing: border-box;
	 -webkit-font-smoothing: antialiased;
	 outline-color: #4bc16b;
}
 body {
	 font-family: "Nunito Sans", sans-serif;
	 color: #697675;
	 background: url(https://verifypayments.com/img/how/how-bg.svg);
	 background-size: cover;
	 background-position: center 50vh;
}
 p {
	 font-size: 20px;
	 line-height: 1.8;
	 letter-spacing: 0;
}
 p.subtitle {
	 margin-top: 0;
	 margin-bottom: 3.8vh;
	 font-size: 23px;
}
 @media (max-width: 768px) {
	 p.subtitle {
		 font-size: 20px;
	}
}
 button, input, optgroup, select, textarea {
	 font-family: "Nunito Sans", sans-serif;
	 color: #131628;
}
 h1 {
	 font-weight: bold;
	 margin: 0 auto 1vh;
	 font-size: 44px;
	 line-height: 1.3;
	 letter-spacing: 0;
	 color: #131628;
}
 @media (max-width: 768px) {
	 h1 {
		 font-size: 26px;
	}
}
 masthead {
	 position: relative;
	 display: flex;
	 width: 100%;
	 padding: 15px 5vw 0;
}
 @media (max-width: 768px) {
	 masthead {
		 justify-content: center;
	}
}
 masthead .logo {
	 display: flex;
	 align-items: center;
}
 masthead .logo img {
	 margin-right: 20px;
}
 masthead .logo .left {
	 font-size: 13px;
	 font-weight: 700;
	 letter-spacing: 1.5px;
	 color: #868898;
	 opacity: 0.6;
}
 .form-wrapper {
	 width: 100%;
	 display: flex;
	 align-items: center;
	 justify-content: center;
	 flex-direction: column;
	 padding: 4rem 0 8rem;
}
 @media (max-width: 880px) {
	 .card {
		 width: 95%;
	}
}
 .card .form {
	 background: #fff;
	 border-radius: 15px;
	 padding: 3.5rem 2rem 2rem;
	 position: relative;
	 display: grid;
	 grid-template-columns: repeat(2, 320px);
	 grid-row-gap: 1.4rem;
	 grid-column-gap: 1rem;
	 color: #a8aac5;
	 box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
}
 @media screen and (max-width: 55em) {
	 .card .form {
		 width: 80%;
		 margin: 0 auto;
		 grid-template-columns: 100%;
	}
}
 .form__item {
	 position: relative;
	 display: flex;
	 flex-direction: column;
}
 .form__item.cta {
	 flex-direction: row;
	 justify-content: flex-end;
}
 .form__item label {
	 display: block;
	 font-size: 0.85rem;
	 padding: 0 0 0.5rem;
	 text-transform: uppercase;
	 color: #44c897;
}
 .form__item input {
	 border: 0;
	 padding: 1em;
	 width: 100%;
	 border-radius: 4px;
	 background-color: #ebf9f1;
	 box-sizing: border-box;
	 outline: none;
}
 .form__item ::-webkit-input-placeholder {
	 color: rgba(0, 0, 0, 0.32);
}
 button {
	 position: relative;
	 border: 0;
	 border-radius: 4px;
	 box-sizing: border-box;
	 box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
	 width: auto;
	 height: 46px;
	 padding: 16px 40px 16px;
	 text-transform: uppercase;
	 font-size: 14px;
	 font-weight: 700;
	 line-height: 1.2;
	 letter-spacing: 0.93px;
	 cursor: pointer;
	 transition: all 0.15s ease;
}
 button:hover {
	 transform: translateY(-1px);
}
 button.primary {
	 background: linear-gradient(45deg, #44c897, #79ce6d);
	 border: solid 1px linear-gradient(45deg, #44c897, #79ce6d);
	 color: #fff;
	 display: block;
}
 button.primary.transfer {
	 padding-left: 51px;
}
 button.primary.transfer:before {
	 content: "";
	 background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/513196/tick-tick.svg);
	 width: 25px;
	 height: 25px;
	 background-repeat: no-repeat;
	 position: absolute;
	 top: 10px;
	 left: 15px;
}
 button.primary:hover {
	 background: linear-gradient(-45deg, #5edbad 0%, #85da79 100%);
}
 button.secondary {
	 color: #697675;
	 background-color: #fff;
	 margin-right: 15px;
	 border: solid 1px #79ce6d;
	 max-width: 130px;
	 font-size: 0.8em;
	 padding: 1em 0;
	 height: 36px;
	 line-height: 1em;
}
 select {
	 display: none;
}
 dl {
	 margin: 0;
}
 dt {
	 cursor: pointer;
}
 .account-select inner {
	 font-family: "Roboto Mono";
	 background-color: #3a4237;
	 color: #79ce6d;
	 border-radius: 3px;
	 border: solid 1px #3a4237 8c;
	 box-shadow: 0 2px 5px #3a4237 8c;
	 padding: 0px 15px 2px;
}
 dl dt {
	 position: relative;
	 box-sizing: border-box;
	 color: #000;
	 font-size: 16px;
	 border: 0;
	 padding: 1em;
	 width: 100%;
	 border-radius: 4px;
	 background-color: #ebf9f1;
	 box-sizing: border-box;
	 outline: none;
}
 dl dt:before, dl dt:after {
	 content: "";
	 position: absolute;
	 width: 0;
	 height: 0;
	 border-left: 5px solid transparent;
	 border-right: 5px solid transparent;
}
 dl dt:before {
	 border-bottom: 5px solid #697675;
	 right: 1em;
	 top: calc(50% - 6px);
}
 dl dt::after {
	 border-top: 5px solid #697675;
	 right: 1em;
	 top: calc(50% + 2px);
}
 dl dd {
	 position: absolute;
	 width: 100%;
	 font-size: 15px;
	 z-index: 10;
	 top: 0;
	 left: 0;
	 margin: 0;
	 visibility: hidden;
	 opacity: 0;
	 transform: translateY(25px);
	 box-sizing: border-box;
}
 dl dd ul {
	 list-style: none;
	 margin: 0;
}
 dl dd.open {
	 visibility: visible;
	 opacity: 1;
	 margin-bottom: 0px;
	 transform: translateY(0px);
	 transition: 300ms all;
	 z-index: 3;
	 color: #000;
	 font-size: 15px;
	 background-color: #fff;
	 border: #bddcca solid 1px;
	 border-radius: 3px;
	 box-shadow: 0px 10px 30px #ebf9f1;
	 max-height: 200px;
	 overflow-y: scroll;
}
 dl dd.open ul {
	 list-style: none;
	 margin: 0;
	 padding: 1em;
	 text-align: left;
}
 dl dd.open ul li {
	 width: 100%;
	 box-sizing: border-box;
	 color: inherit;
	 padding: 8px 1em;
	 line-height: 1.4em;
	 border-radius: 4px;
	 cursor: pointer;
}
 dl dd.open ul li:hover {
	 background-color: #eef6f7;
}
 .type {
	 flex-direction: row;
	 align-items: flex-end;
}
 @media (max-width: 768px) {
	 .type {
		 display: none;
	}
}
 .type .tag {
	 font-size: 12px;
	 font-weight: 700;
	 letter-spacing: 1.5px;
	 color: #868898;
	 opacity: 0.6;
}
 

</style>


<template>
    <div class="form-wrapper">
    <h1>Send money fast! </h1>
    <p class="subtitle">Time is money, so let's save some.</p>
    <div class="card">
        <form class="form" id="form">
            <div class="form__item"><label>From</label><input  placeholder="Sender Email" class="amount" id="sender" v-model.trim="$v.sender.$model" value="" type="text" maxlength="15"/></div>
            <div class="form__item"><label>To</label><input id="receiver" v-model.trim="$v.receiver.$model" placeholder="Receiver" /></div>
            <div class="form__item"><label>Amount ($)</label><input class="amount" id="amount" v-model.trim="$v.amount.$model" value="" type="number"  min="0"/></div>
            <div class="form__item"><label>Password</label><input class="amount" id="password" v-model.trim="$v.password.$model" value="" type="password" maxlength="25" /></div>
            <div class="form__item"><label>Message Title</label><input class="amount" id="message_title" v-model.trim="$v.message_title.$model" value="" type="text" maxlength="25" /></div>
            <div class="form__item"><label>Message</label><input class="amount" id="messsage" v-model.trim="$v.message.$model" value="" type="text"/></div>
            <div class="form__item type">
                <div class="tag">TRANSFER</div>
            </div>
            <div class="form__item cta"><button type="submit" class="primary transfer" @click.prevent="send_money()">Send Funds    </button></div>
        </form>
    </div>
</div>
</template>

<script>
    import { required, minLength, maxLength, between } from 'vuelidate/lib/validators'
export default {
    data(){
        return{
            sender : '',
            receiver : '',
            amount : '',
            password : '',
            message_title : '',
            message : ''
        }
    },
    validations: {
            sender: {
                required,
                minLength :minLength(4)
            },
            receiver: {
                required,
                maxLength :maxLength(300),
            },
            amount : {
                required,
            },
            password : {
                required
            },
            message_title : {
                required
            },
            message : {
                required
            }
        },
    methods : {
        send_money(){
            this.$swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, send it!',
            closeOnCancel: true
            }).then((result) => {
                
                //send request to server 
                if (result.value) {
                      let uri = `/api/transaction/create/` ;
                     this.$http.post(uri,{
                         sender : this.sender,
                         receiver : this.receiver,
                         amount : this.amount,
                         password : this.password,
                         message : this.message,
                         message_title : this.message_title
                     }).then((response) =>{
                    });
                    this.$swal({
                   
                    title : 'Confirmed!',
                    text : 'Your money has been sent!',
                    icon : 'success',
                    },
                    ); 
                    this.$router.push("/home");
                }
            })
        }
    }
}
</script>