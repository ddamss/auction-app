<template>
    <div style="display:inline-block;">
        <form class="form-inline">
            <div class="form-group mx-sm-3 mb-2">
                <label for="bid" class="sr-only">Enter bid amount $</label>
                <input
                    type="number"
                    class="form-control"
                    id="bidded_price"
                    placeholder="Enter bid amount $ here"
                />
            </div>
            <button
                type="submit"
                class="btn btn-primary mb-2"
                @click.prevent="bid"
            >
                Place bid
            </button>
        </form>
        <!-- <p>dynamic price bid here ==>{{this.current_price}}</p> -->
    </div>
</template>

<script>
export default {
    props: [
        "access_token",
        "buyer_id",
        "auction_id",
        "auction_current_price",
        "deposit_amount"
    ],
    data: function() {
        return {
            current_price: this.auction_current_price
        };
    },
    methods: {
        bid() {
            let bidded_price = document.getElementById("bidded_price").value;
            let bidded_price_nbr = parseInt(bidded_price, 10);
            let auction_current_price_nbr = parseInt(
                this.auction_current_price,
                10
            );

            if (bidded_price_nbr <= auction_current_price_nbr) {
                console.log(
                    'bidded price ["' +
                        bidded_price_nbr +
                        '"] should be higher than current price ["' +
                        auction_current_price_nbr +
                        '"]'
                );
                alert("bidded price should be higher than current price ! ");
            } else if (this.deposit_amount * 5 < bidded_price_nbr) {
                console.log(
                    'bidded_price ["' +
                        bidded_price_nbr +
                        '"] should at least equals to five times the deposit_amount that is now ["' +
                        this.deposit_amount +
                        '"], so mutiplied by 5 it is ["' +
                        this.deposit_amount * 5 +
                        '"]'
                );
                alert(
                    'bidded_price ["' +
                        bidded_price_nbr +
                        '"] should at least equals to five times the deposit_amount'
                );
            } else {
                let api_url=''
                if(window.location.hostname=='auctions-webapp.herokuapp.com'){
                    api_url='https://auctions-webapp.herokuapp.com/api'
                }else{
                    api_url='http://127.0.0.1/auction-app/public/api'
                }

                window.axios
                    .post(
                        api_url+'/bid',
                        {
                            bidded_price,
                            buyer_id: this.buyer_id,
                            auction_id: this.auction_id
                        },
                        {
                            headers: {
                                Authorization: "Bearer " + this.access_token
                            }
                        }
                    )
                    .then(response => {
                        this.current_price = bidded_price;
                        console.log(response);
                    });
            }
        }
    },
    created() {
        // this.$forceUpdate();
    },
    mounted() {
        Echo.channel(`bid.${this.auction_id}`).listen("BidRegistered", e => {
            console.log(e);
        });
    }
};
</script>
