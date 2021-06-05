<template>
  <span
    class="d-flex align-items-center justify-content-center"
    :class="{ active: active }"
    @click="click()"
    ><i class="far fa-clock"></i
  ></span>
</template>
<script>
export default {
  name: "laterButton",
  props: ["id", "media_type"],
  data: function () {
    return {
      active: false,
    };
  },
  methods: {
    click: function () {
      axios
        .post("toggleFav", {
          id: this.id,
          media_type: this.media_type,
        })
        .then((response) => {
          this.active = response.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
  //   ,
  //   created() {
  //     axios
  //       .post("isFav", {
  //         id: this.id,
  //         media_type: this.media_type,
  //       })
  //       .then((response) => {
  //         this.faved = response.data;
  //       })
  //       .catch(function (error) {
  //         console.log(error);
  //       });
  //   },
};
</script>

<style scoped>
span {
  padding: 5px;
  color: black;
  font-size: x-large;
  display: block;
  width: 35px;
  height: 35px;
  border-radius: 999px;
  background-color: #fff;
  cursor: pointer;
  user-select: none;
}
.active {
  color: #3490dc;
}
</style>
