<template>
  <div id="scanner-app">
    <video id="camera-preview"></video>
    <button @click="readQr()" class="btn scanner_btn">
     Scan QR
    </button>
  </div>
</template>
<style lang="scss">
#scanner-app {
  color: white;
  text-align: center;
  margin: 10px 0;
  font-family: 'Playball', cursive;
}
.btn.scanner_btn {
  color: #fff;
  background-color: #dc3545;
  border-color: #dc3545;
}
.btn {
  font-family: 'Playball', cursive;
  display: inline-block;
  font-weight: 400;
  text-align: center;
  white-space: nowrap;
  vertical-align: middle;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  border: 1px solid transparent;
  padding: .375rem .75rem;
  font-size: 1rem;
  line-height: 1.5;
  border-radius: .25rem;
  transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}
</style>
<script>
console.log(Instascan)

export default {
  mounted: function () {

  },
  data: function () {
    return {

    }
  },
  methods: {
    readQr: function() {
      let scanner = new Instascan.Scanner({ video: document.getElementById('camera-preview') });
      scanner.addListener('scan', function (content) {
        console.log(content);
      });
      Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
          scanner.start(cameras[0]);
        } else {
          console.error('No cameras found.');
        }
      }).catch(function (e) {
        console.error(e);
      });
    },
  }

}

</script>
