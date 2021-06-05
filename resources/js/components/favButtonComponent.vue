<template>
  <span class="text-center" :class="{ fav: faved }" @click="click()"
    >&#9733;</span
  >
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
  color: black;
  font-size: x-large;
  line-height: 1.3;
  display: block;
  width: 30px;
  height: 30px;
  border-radius: 999px;
  background-color: #fff;
  cursor: pointer;
  user-select: none;
}
.fav {
  color: #fcba03;
}
</style>
