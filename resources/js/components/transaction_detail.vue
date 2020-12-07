<style scoped>
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
</style>


<template>
    <div> <table class="wrapper" bgcolor="#ECEEF1" style="background-color:#ECEEF1;width:100%;">
    <tr>
      <td>
        <!-- HEADER -->
     
        <!-- /HEADER -->
        <!-- BODY -->
        <table class="body-wrap" style="margin:0 auto;margin-bottom: 80px;">
          <tr>
            <td></td>
            <td class="container transaction-mailer mt-5" bgcolor="#FFFFFF" style="font-family:Source Sans Pro, Helvetica, sans-serif;color:#6f6f6f;display:block;max-width:600px;margin:0 auto;padding:40px;border:1px solid #CED3D8;">
              <div class="content" style="display:block;margin:0 auto;max-width:650px;padding:20px;-webkit-font-smoothing:antialiased">
                <div class="receipt">
                  <div class="head">

                    <h1 class="light title" style="margin:0;padding:0;margin-bottom:20px;font-weight:700;line-height:130%;-webkit-font-smoothing:antialiased;margin-top:10px;color:#ccc;font-size:26px;text-align:left">Transaction ID :{{single_transaction.transaction_id}}</h1>

                    <div class="account-item" style="margin:10px 0;font-size:18px">
                      <span class="light" style="padding-right:5px;color:#ccc">Receiver:</span>

                      <span class="item-detail" style="padding-right:5px;color:#434343">{{single_transaction.receiver}}</span>
                    </div>
                    <div class="account-item" style="margin:10px 0;font-size:18px">
                      <span class="light" style="padding-right:5px;color:#ccc">Billing date:</span>

                      <span class="item-detail" style="padding-right:5px;color:#434343">{{single_transaction.created_at | formatDate}}</span>
                    </div>
                  </div>
                  <div class="divider" style="margin-top:30px;padding-top:10px;border-top:1px solid #CCC">
                    <div class="message">

                      <h1 class="emphasis" style="margin:0;padding:0;margin-bottom:20px;font-weight:700;margin-top:10px;-webkit-font-smoothing:antialiased;font-size:28px;line-height:130%;text-align:left;color:#54bbff">{{single_transaction.message_title}}</h1>

                      <p style="color:#434343;text-align:left;line-height:150%;padding:0;font-weight:400;font-size:18px">{{single_transaction.message}}
                        </p>
                        <br>
                     
                    </div>
                  </div>
                  <div class="billing">
                    <div class="divider" style="margin-top:30px;padding-top:10px;border-top:1px solid #CCC"> <strong style="color:black;display:inline-block;font-size:18px;margin-bottom:5px;margin-top:5px">Sender</strong>

                      <strong class="total" style="color:black;display:inline-block;margin-bottom:5px;font-size:18px;float:right">{{single_transaction.sender}}</strong>
                    </div>
                    <div class="divider" style="padding-top:10px;border-top:1px solid #CCC">
                      <div class="grand-total">
                        <strong style="color:black;display:inline-block;font-size:18px;margin-bottom:5px;margin-top:5px">Total</strong>

                        <strong class="total" style="color:black;display:inline-block;margin-bottom:5px;font-size:18px;float:right">${{single_transaction.amount}}</strong>
                      </div>
                    </div>
                  </div>
                  <div class="foot">
                    <p style="color:#434343;text-align:left;line-height:150%;padding:0;font-weight:400;font-size:18px">
                      <strong>This transaction has been encrypted.</strong> Please enter the key provided by the sender if you want to see the detail of this transaction</p>
                      <div class="form__item"><label>Password</label><input class="amount" id="password" v-model.trim="$v.password.$model" value="" type="password"/></div>
                      <button class="btn btn-success mt-2" @click.prevent="decryptData(password)">Submit</button>
                  </div>
                </div>
              </div>
              <!-- /content -->
            </td>
            <td></td>
          </tr>
          <tr>
            <td></td>
            <td></td>
          </tr>
        </table>
        <!-- /BODY -->
      </td>
    </tr>
  </table></div>
</template>

<script>
import { required, minLength, maxLength, between } from 'vuelidate/lib/validators'
export default {
    data(){
        return {
            single_transaction: [],
            password : ''
        };
    },
    created(){
        this.loadData();
    },
    validations: {
        password : {
            required
        }
    },
    methods : {
    loadData(){
        let uri =`/api/get_singletransaction/${this.$route.params.transaction_id}`;
        this.$http.get(uri).then((response) => {
            this.single_transaction = response.data;
        })
    },
    decryptData($id){
        let uri = "/api/decrypt_singletransaction/" + this.$route.params.transaction_id + "/" + $id;
        this.$http.get(uri).then((response) => {
            if(response.data != 'error'){
            this.single_transaction = response.data;
            this.$swal({
                    title : 'Success!',
                    text : 'This transaction has been decrypted!',
                    icon : 'success',
                    }
                    );
            this.password = '';
            }
            else{
                this.$swal({
                    title : 'Error!',
                    text : 'Wrong Password!',
                    icon : 'error',
                    }
                    )
            }
            }
        )
    }

}}
</script>