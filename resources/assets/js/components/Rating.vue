<template>
  <!-- https://coolsymbol.com/emojis/emoji-for-copy-and-paste.html -->
<div class="rating_div">
  <div id="modal-template"  v-if="showModal" @close="showModal = false" >
    <transition name="modal">
      <div class="modal-mask">
        <div class="modal-wrapper">
          <div class="modal-container">

            <div class="modal-header">
              <h3 v-if="!hasRating" class="rating_title">Rating Our Restaurant</h3>
              <h3 v-if="hasRating" class="rating_title">
                <span v-if='alreadyRating'>You have already rated. <br/></span>
                <span>Thanks for your rating</span>
              </h3>
            </div>

            <div class="modal-body">
              <div v-if="hasRating" class='old_user'>
                <p style="color: #333">
                  <span style="display: block; line-height: 28px;">Your rating:</span>
                  <span style="font-size: 45px; line-height: 45px; display: block;">{{generateEmoji(yourRating)}}</span>
                  <span style="display: none;">{{Number(avgRating).toFixed(2)}}</span>
                  <span style="display: block;">{{yourRating}}</span>
                </p>
              </div>

              <div v-if="!hasRating" class='new_user'>
                <div class='emoji_wrapper'>
                  <div class='single_emoji'>
                    <span class="emoji" @click="sendRating(1)">😖</span>
                    <span>1</span>
                  </div>
                  <div class='single_emoji'>
                    <span class="emoji" @click="sendRating(2)">😐</span>
                    <span>2</span>
                  </div>
                  <div class='single_emoji'>
                    <span class="emoji" @click="sendRating(3)">😬</span>
                    <span>3</span>
                  </div>
                  <div class='single_emoji'>
                    <span class="emoji" @click="sendRating(4)">😄</span>
                    <span>4</span>
                  </div>
                  <div class='single_emoji'>
                    <span class="emoji" @click="sendRating(5)">😍</span>
                    <span>5</span>
                  </div>
                </div>
              </div>



            </div>

            <div class="modal-footer">
              <button class="btn close_btn" @click="showModal=false">
               Close
              </button>
            </div>
          </div>
        </div>
      </div>
    </transition>
  </div>
  <button id="show-modal" class="btn show_modal_btn" @click="showModal = true">Rate Us</button>
</div>
</template>
<script>
  export default {
    data: function () {
      return {
        message: 'hello world from vue componenet',
        showModal: false,
        rating: 0,
        hasRating: false,
        alreadyRating: false,
        avgRating: 0,
        yourRating: 0,
      }
    },
    mounted: function () {
      this.hasRatingCall();
      this.alreadyRatingCall();
      this.avgRatingCall();
    },
    props: ['ip_address', 'user_id', 'app_url'],
    methods: {
      hasRatingCall: function () {
        axios.get(`${this.app_url}/has-rating/${this.user_id}`)
        .then(data => {
          this.hasRating = data.data.has_rating,
          this.yourRating = data.data.your_rating
        })
        .catch(error => console.log('error', error));
      },
      alreadyRatingCall: function () {
        axios.get(`${this.app_url}/has-rating/${this.user_id}`)
        .then(data => {
          this.alreadyRating = data.data.has_rating
        })
        .catch(error => console.log('error', error));
      },
      generateEmoji(rating){
        let rRating = Math.round(rating);
         switch(rRating) {
          case 1:
            return "😖";
          case 2:
            return "😐";
          case 3:
            return "😬";
          case 4:
            return "😄";
          case 5:
            return "😍";
         }
      },
      avgRatingCall: function () {
        axios.get(`${this.app_url}/avg-rating/${this.user_id}`)
        .then(data => {
          console.log('avg', data);
          this.avgRating = data.data;
        })
        .catch(error => console.log('error', error));
      },
      sendRating: function(rating) {
        let payload = {
          rating,
          user_id: this.user_id,
        }
        this.hasRating = true;
        axios.post(`${this.app_url}/save-rating`, payload)
        .then((response) => {
          this.hasRatingCall();
          this.avgRatingCall();
          console.log('sendRating', response);
        })
        .catch((error) => console.log('error', error));
      },

    },

  }

</script>
<style>
.rating_div {
  color: white;
  text-align: center;
  font-family: 'Playball', cursive;
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
.btn.show_modal_btn {
  color: #fff;
  background-color: #C59D5F;
  border-color: #C59D26;
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


.modal-container {
  width: 300px;
  margin: 0px auto;
  padding: 20px 30px;
  background-color: #fff;
  border: 3px solid #C59D5F;
  color: #111;
  border-radius: 6px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
  transition: all .3s ease;
  font-family: Helvetica, Arial, sans-serif;
}

.modal-header h3 {
  margin-top: 0;
  color: #42b983;
}

.modal-body {
  margin: 20px 0;
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

.modal-enter .modal-container,
.modal-leave-active .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}

</style>
