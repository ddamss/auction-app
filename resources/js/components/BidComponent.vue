    <template>
    <div style="display:inline-block;">
        <form class="form-inline">
            <div class="form-group mx-sm-3 mb-2">
                <label for="bid" class="sr-only"
                    >Enter bid amount $</label
                >
                <input
                    type="number"
                    class="form-control"
                    id="bidded_price"
                    placeholder="Enter bid amount $ here "
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
    </div>
</template>

<script>

export default {
    props: ["access_token", "buyer_id", "auction_id","auction_current_price"],
    data: function() {
        return {
            product: "bid text 22"
        };
    },
    methods: {
        bid() {

            let bidded_price = document.getElementById("bidded_price").value;
            let bidded_price_nbr=parseInt(bidded_price, 10)
            let auction_current_price_nbr=parseInt(this.auction_current_price, 10)

            if (bidded_price_nbr<=auction_current_price_nbr){

                console.log('bidded price ["'+bidded_price_nbr+'"] should be higher than current price ["'+auction_current_price_nbr+'"]')
                // console.log('type bidded_price ["'+typeof bidded_price_nbr+'"] & type auction_current_price ["'+typeof auction_current_price_nbr+'"]')
                alert('bidded price should be higher than current price ! ')
                
                }else{

                    window.axios
                        .post(
                            "http://127.0.0.1/auction-app/public/api/bid",
                            {
                                bidded_price,
                                buyer_id: this.buyer_id,
                                auction_id:this.auction_id
                            },
                            {
                                headers: {
                                    Authorization: "Bearer " + this.access_token
                                }
                            }
                        )
                        .then(response => {
                            console.log(response);
                        });

                }

        }
    },
    created() {
        // console.log(this.access_token);
    },
    mounted() {
                Echo.channel(`bid.${this.auction_id}`)
            .listen('BidRegistered', (e) => {
                console.log(e);
            });
    }
};
</script>
