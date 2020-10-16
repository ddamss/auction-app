<template>
    <div style="display:inline-block;">

        <form class="form-inline">
            <div class="form-group mx-sm-3 mb-2">
                <label for="bid" class="sr-only">Enter bid amount $ {{product}}</label>
                <input type="number" class="form-control" id="bid-amount" placeholder="Enter bid amount $ here ">
            </div>
            <button type="submit" class="btn btn-primary mb-2" @click.prevent="bid">Place bid</button>
        </form>
    </div>
</template>

<script>
export default {
    props:['access_token','buyer_id'],
    data: function() {
        return {
            product: "bid text 22"
        };
    },
    methods:{
        
        bid(){          
            let bid_amount=document.getElementById("bid-amount").value;      
                window.axios.post('http://127.0.0.1/auction-app/public/api/bid',
                {
                    bid_amount,
                    "buyer_id":this.buyer_id
                    },
        {
            headers:{
                'Authorization': 'Bearer ' +this.access_token
            }
        })
                    .then((response) => {
                    console.log('response');
                });        
        }
    },
    created() {
        console.log(this.access_token);
    },
    mounted() {
        console.log(this.access_token);
    }
};
</script>
