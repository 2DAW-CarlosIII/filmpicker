<template>
  <span
    class="d-flex align-items-center justify-content-center"
    :class="{ fav: faved }"
    @click="click()"
    ><i class="fas fa-star"></i
  ></span>
</template>
<script>
export default {
  name: "favButtonComponent",
  props: ["id", "media_type"],
  data: function () {
    return {
      faved: false,
    };
  },
  methods: {
    click: function () {
      axios
        .post("http://filmpicker.test/toggleFav", {
          id: this.id,
          media_type: this.media_type,
        })
        .then((response) => {
          this.faved = response.data;
          if (location.pathname == "/home") {
            location.reload();
          }
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
  created() {
    axios
      .post("http://filmpicker.test/isFav", {
        id: this.id,
        media_type: this.media_type,
      })
      .then((response) => {
        this.faved = response.data;
      })
      .catch(function (error) {
        console.log(error);
      });
  },
};
</script>

<style scoped>
span {
  padding: 5px;
  color: black;
  font-size: 20px;
  display: block;
  width: 35px;
  height: 35px;
  border-radius: 999px;
  background-color: #fff;
  cursor: pointer;
  user-select: none;
}
.fav {
  color: #fcba03;
}
</style>
