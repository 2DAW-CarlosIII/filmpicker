<template>
  <span class="d-flex align-items-center" @click="click()"
    ><i class="fas fa-check"></i
  ></span>
</template>
<script>
export default {
  name: "acceptButton",
  props: ["film"],
  methods: {
    click: function () {
      axios
        .post("/sala/next", {
          id: this.id,
          media_type: this.media_type,
          film: this.film,
          accepted: true,
        })
        .then((response) => {
          location.reload();
          console.log(response);
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
};
</script>

<style scoped>
span {
  padding: 5px;
  font-size: x-large;
  display: block;
  width: 35px;
  height: 35px;
  border-radius: 999px;
  background-color: #fff;
  cursor: pointer;
  user-select: none;
}
i {
  color: #38c172;
}
</style>
