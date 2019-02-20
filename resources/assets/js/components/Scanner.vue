<template>
  <!-- https://coolsymbol.com/emojis/emoji-for-copy-and-paste.html -->
<div class="qr_app">
  <div id="modal-template"  v-if="showModal" @close="showModal = false" >
    <transition name="modal">
      <div class="modal-mask">
        <div class="modal-wrapper">
          <div class="modal-container-scanner">

            <div class="modal-header-qr-app">
              <h3>QR Code Scanner </h3>
            </div>

            <div class="modal-body-qr-app">
              <div class='camera'>
                <h3>Camera</h3>
                <p v-if="cameras.length === 0" class="empty">No cameras found</p>
                <p v-for="camera in cameras">
                  <span v-if="camera.id == activeCameraId" :title="formatName(camera.name)" class="active">{{ formatName(camera.name) }}</span>
                  <span v-if="camera.id != activeCameraId" :title="formatName(camera.name)">
                    <a @click.stop="selectCamera(camera)">{{ formatName(camera.name) }}</a>
                  </span>
                </p>
              </div>
              <!-- /.camera -->
              <div class='scans'>
                <!-- <h4>Scans</h4> -->
                <!-- <p v-if="scans.length === 0"> No scans yet</p> -->
                <!-- <p style="color: #333" v-for="scan in scans" :key="scan.date" :title="scan.content">{{ scan.content }}</p> -->
                  <div class="preview-container">
                    <video id="preview"></video>
                  </div>
              </div>
              <!-- /.scans -->
            </div>

            <div class="modal-footer">
              <button class="btn close_btn" @click="closingModal()">
               Close
              </button>
            </div>
          </div>
        </div>
      </div>
    </transition>
  </div>
  <button id="show-modal" class="btn show_modal_btn_scanner" @click="openingModal()">Scan QR Code</button>
</div>
</template>
<script>
  export default {
    data: function () {
      return {
        showModal: false,
        scanner: null,
        activeCameraId: null,
        cameras: [],
        scans: []
      }
    },
    mounted: function () {

    },
    methods: {
      openingModal: function () {
        this.showModal = true;
        this.scanningQrCode();
      },
      closingModal: function () {
        this.showModal = false;
        this.scanner.stop();
      },
      scanningQrCode: function () {
        setTimeout(() => {
          this.scanner = new Instascan.Scanner({ video: document.getElementById('preview'), scanPeriod: 5 });
          this.scanner.addListener('scan',  (content, image)=> {
            window.location.href = content;
            this.scans.unshift({ date: +(Date.now()), content: content });
          });
          Instascan.Camera.getCameras().then( (cameras) => {
            this.cameras = cameras;
            if (cameras.length > 0) {
              this.activeCameraId = cameras[0].id;
              this.scanner.start(cameras[0]);
            } else {
              console.error('No cameras found.');
            }
          }).catch( (e) => {
            console.error(e);
          });
        }, 100)

      },
      formatName: function (name) {
        return name || '(unknown)';
      },
      selectCamera: function (camera) {
        this.activeCameraId = camera.id;
        this.scanner.start(camera);
      }

    },
  }

</script>
<style>
.qr_app {
  color: white;
  text-align: center;
  font-family: 'Playball', cursive;
  margin: 10px 0;
}
.qr_app video#preview {
  position: relative;
}
.preview-container {
  flex-direction: column;
  align-items: center;
  justify-content: center;
  display: flex;
  width: 100%;
  overflow: hidden;
}
.emoji_wrapper {
  display: flex;
  justify-content: center;
}
.single_emoji {
  marign: 0 5px;
}
.single_emoji span {
  display: block;
  font-family: 'Playball', cursive;
  color: #C59D5F;
}


.single_emoji span.emoji {
  font-size: 50px;
  /*line-height: 40px;*/
}
.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, .5);
  display: table;
  transition: opacity .3s ease;
}

.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}
.btn.close_btn {
  color: #fff;
  background-color: #dc3545;
  border-color: #dc3545;
}
.btn.show_modal_btn_scanner {
  color: #fff;
  background-color: #e74c3c;
  /*border-color: #C59D26;*/
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

.rating_title {
  color: #C59D5F;
  font-size: 30px;
  font-family: 'Playball', cursive;
}


.modal-container-scanner {
  width: 90%;
  margin: 0px auto;
  padding: 10px;
  background-color: #fff;
  border: 3px solid #C59D5F;
  color: #111;
  border-radius: 6px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
  transition: all .3s ease;
  font-family: Helvetica, Arial, sans-serif;
}

.modal-header-qr-app h3 {
  margin-top: 0;
  color: #42b983;
}

.modal-body-qr-app {
  margin: 5px 0;
}

.modal-default-button {
  float: right;
}

/*
 * The following styles are auto-applied to elements with
 * transition="modal" when their visibility is toggled
 * by Vue.js.
 *
 * You can easily play with the modal transition by editing
 * these styles.
 */

.modal-enter {
  opacity: 0;
}

.modal-leave-active {
  opacity: 0;
}

.modal-enter .modal-container-scanner,
.modal-leave-active .modal-container-scanner {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}

</style>
