<template>
  <span
    class="d-flex align-items-center justify-content-center"
    @click="click()"
    ><i class="fas fa-times"></i
  ></span>
</template>
<script>
export default {
  name: "rejectButton",
  props: ["film"],
  data: function () {
    return {
      faved: false,
    };
  },
  methods: {
    click: function () {
      axios
        .post("/sala/next", {
          film: this.film,
          accepted: false,
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
  color: #e3342f;
}
</style>
