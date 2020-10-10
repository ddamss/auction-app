<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Example Component test</div>
          <div class="card-body">I'm an example component=>. {{ product }}</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      product: "hello vue product val",
    };
  },
  mounted() {
    console.log("Component mounted.");
  },
  created() {
    console.log("Component created.");
  },
};
</script>
