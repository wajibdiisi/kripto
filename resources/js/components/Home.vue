<style scoped>
    body {
        background-color: #e4e6e9;
        color: #41464d;
    }

    .btn:not(:disabled):not(.disabled) {
        cursor: pointer;
    }

    .btn-a-brc-tp:not(.disabled):not(:disabled).active,
    .btn-brc-tp,
    .btn-brc-tp:focus:not(:hover):not(:active):not(.active):not(.dropdown-toggle),
    .btn-h-brc-tp:hover,
    .btn.btn-f-brc-tp:focus,
    .btn.btn-h-brc-tp:hover {
        border-color: transparent;
    }

    .btn-outline-blue {
        color: #0d6ce1;
        border-color: #5a9beb;
        background-color: transparent;
    }

    .btn {
        cursor: pointer;
        position: relative;
        z-index: auto;
        border-radius: .175rem;
        transition: color .15s, background-color .15s, border-color .15s, box-shadow .15s, opacity .15s;
    }

    .border-2 {
        border-width: 2px !important;
        border-style: solid !important;
        border-color: transparent;
    }

    .bgc-white {
        background-color: #fff !important;
    }


    .text-green-d1 {
        color: #277b5d !important;
    }

    .letter-spacing {
        letter-spacing: .5px !important;
    }

    .font-bolder,
    .text-600 {
        font-weight: 600 !important;
    }

    .text-170 {
        font-size: 1.7em !important;
    }

    .text-purple-d1 {
        color: #6d62b5 !important;
    }

    .text-primary-d1 {
        color: #276ab4 !important;
    }

    .text-secondary-d1 {
        color: #5f718b !important;
    }

    .text-180 {
        font-size: 1.8em !important;
    }

    .text-150 {
        font-size: 1.5em !important;
    }

    .text-danger-m3 {
        color: #e05858 !important;
    }

    .rotate-45 {
        -webkit-transform: rotate(45deg);
        transform: rotate(45deg);
    }

    .position-l {
        left: 0;
    }

    .position-b,
    .position-bc,
    .position-bl,
    .position-br,
    .position-center,
    .position-l,
    .position-lc,
    .position-r,
    .position-rc,
    .position-t,
    .position-tc,
    .position-tl,
    .position-tr {
        position: absolute !important;
        display: block;
    }

    .mt-n475,
    .my-n475 {
        margin-top: -2.5rem !important;
    }

    .ml-35,
    .mx-35 {
        margin-left: 1.25rem !important;
    }

    .text-dark-l1 {
        color: #56585e !important;
    }

    .text-90 {
        font-size: .9em !important;
    }

    .text-left {
        text-align: left !important;
    }

    .mt-25,
    .my-25 {
        margin-top: .75rem !important;
    }

    .text-110 {
        font-size: 1.1em !important;
    }

    .deleted-text {
        text-decoration: line-through;
        ;
    }
    a{
        text-decoration : none;
    }

</style>

<template>
    <div class="container">
        <router-link class="btn btn-outline-primary float-right" :to="{ name: 'sendMoney' }">+ Send Money
                        </router-link>
        <div class="mt-5">
            
            <div
                class="d-style btn btn-brc-tp border-2 bgc-white btn-outline-blue btn-h-outline-blue btn-a-outline-blue w-100 my-2 py-3 shadow-sm" v-for="transaction in transactions" :key ="transaction.transaction_id"> 
                <!-- Basic Plan -->
                <div class="row align-items-center" >
                    <div class="col-12 col-md-4">
                        <h4 class="pt-3 text-170 text-600 text-primary-d1 letter-spacing">
                            <router-link :to="{ name : 'transactionDetail' , params: {transaction_id : transaction.transaction_id } }">{{transaction.transaction_id}}</router-link>
                        </h4>

                        <div class="text-secondary-d1 text-120">
                            <span class="ml-n15 align-text-bottom">$</span><span class="text-180">{{transaction.amount}}</span>
                        </div>
                    </div>

                    <ul class="list-unstyled mb-0 col-12 col-md-4 text-dark-l1 text-90 text-left my-4 my-md-0">
                        <li>
                            <i class="fa fa-check text-success-m2 text-110 mr-2 mt-1"></i>
                            <span>
                                <span class="text-110">Sender Name :</span>
                                {{transaction.sender}}
                            </span>
                        </li>

                        <li>
                            <i class="fa fa-check text-success-m2 text-110 mr-2 mt-1"></i>
                            <span class="text-110">
                                Receiver Name : {{transaction.receiver}}
                            </span>
                        </li>
                        <li>
                            <i class="fa fa-check text-success-m2 text-110 mr-2 mt-1"></i>
                            <span class="text-110">
                                Transaction Date : {{transaction.created_at | formatDate }}
                            </span>
                        </li>


                    </ul>

                    <div class="col-12 col-md-4 text-center">
                        <router-link :to="{ name : 'transactionDetail' , params: {transaction_id : transaction.transaction_id } }">
                        <a href="#" class="f-n-hover btn btn-info btn-raised px-4 py-25 w-75 text-600">Money
                       Sent</a></router-link>
                    </div>
                </div>

            </div>

          




        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            transactions: []
        };
    },
    created(){
        this.loadData();
    },
    methods : {
    loadData(){
        let uri =`api/get_alltransaction/`;
        this.$http.get(uri).then((response) => {
            this.transactions = response.data;
        })
    }

}}
</script>
