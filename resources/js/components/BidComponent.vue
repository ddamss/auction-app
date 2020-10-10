<template>
    <div style="display:inline-block;">

        <form class="form-inline">
            <div class="form-group mx-sm-3 mb-2">
                <label for="bid" class="sr-only">Enter bid amount $ {{product}}</label>
                <input type="text" class="form-control" id="bid-amount" placeholder="Enter bid amount $ here ">
            </div>
            <button type="submit" class="btn btn-primary mb-2">Place bid</button>
        </form>
    </div>
</template>

<script>
export default {
    data: function() {
        return {
            product: "bid text"
        };
    },
    mounted() {
        console.log("Component mounted.");
    },
    created() {
        console.log("Component created.");
    }
};
</script>
