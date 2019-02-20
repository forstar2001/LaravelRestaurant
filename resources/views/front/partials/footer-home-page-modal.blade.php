<style type="text/css">
.blocker  {
  z-index: 100;
}
.modal    {
  z-index: 101;
  max-width: 100%;
}
#modal-content {
  width: 80vw;
  height: 80vh;
  overflow-y: scroll;
}
.footer-content-modal {
  background: #262526;
  overflow: hidden;
  display: none;
}
@media screen and (max-width: 480px) {
  .footer-content-modal {
    display: block;
  }
}

.footer-content-modal .to-top-holder {
    float: none;
    width: 100%;
    background: #262526;
    position: relative;
    padding: 10px 0 10px;
}
.footer-content-modal .bold-separator {
  display: none;
}
.footer-content-modal .to-top-holder .container {
  text-align: center;
}
.footer-content-modal .to-top-holder .container p {
  display: block;
  float: none;
  text-align: center;
  padding-bottom: 25px;
}
.footer-content-modal .to-top-holder .container .to-top {
  display: none;
}
@media screen and (max-width: 600px) {
  .blocker {
    padding: 25px 5px 5px 5px;
  }
  .modal {
    width: 95%;
    padding: 10px ;
  }
}
.panel-container {
  font-size: 16px;
}
.panel-container h2 {
  font-size: 22px;
}
.footer-modal-trigger {
    color: #C59D5F;
    font-family: 'Playball', cursive;
    font-size: 34px;
    position: absolute;
    top: -30px;
    left: calc(50% - 23px);
    margin-left: -5px;
    width: 50px;
    height: 50px;
    border-radius: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}
@media screen and (max-width: 480px) {
  .footer-modal-trigger {
    left: calc(50% - 20px);
    width: 40px;
    height: 40px;
  }
  #modal-content {
    width: 88vw;
    height: 85vh;
  }
}
.review-block {
  height: 100%;
  overflow: scroll;
}
.review-single {
  padding: 1em;
  background: #fff;
  border: 1px solid #eee;
  border-radius: 4px;
  box-shadow: 0 1px 6px rgba(0,0,0,0.03);
  margin: 1em 0;
}
.review-single div {
  margin-bottom: 10px;
}
.review-single .review-date-rating{ font-size: 14px; color: #ccc; }
.review-single span.rating{ color: #C59D5F; margin-left: 8px; }
.review-single .blockquote{ border-left: 8px solid #ddd; padding-left: 1em; min-height: 40px; font-size: 18px;    }
.review-single .reviewer { color: teal;  }

/*survey*/
#survey form {
  font-size: 18px;
}
#survey strong {
  font-weight: bold;
}
#survey form > *{ display: block; }
#survey form input, #survey form textarea, #survey form select{
/*  padding: 1em;
  color: #333;
  width: 80%;
  border: 1px solid #ddd;
  border-radius: 5px;
*/  display: block;
    width: 100%;
    height: calc(2.25rem + 2px);
    padding: .375rem .75rem;
    margin-bottom: 1em;
    font-size: 1rem;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}
#survey form textarea {
  height: 5rem;
}
#survey form label {
  color: #444;
}

#survey form button {
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
    color: #fff;
    background-color: #17a2b8;
    border-color: #17a2b8;
}
#survey form button:hover {
  color: #fff;
  background-color: #117a8b;
  border-color: #10707f;
}

#survey .alert-danger {
    position: relative;
    padding: .75rem 1.25rem;
    margin-bottom: 1rem;
    border: 1px solid transparent;
    border-radius: .25rem;
/*alert danger*/
    color: #721c24;
    background-color: #f8d7da;
    border-color: #f5c6cb;
}

#survey h3 {
  font-weight: strong;
  font-size: 20px;
}

</style>
<!-- Modal HTML embedded directly into document -->
<div id="ex8" class="modal">
  <div id='modal-content'>

    <div id="tab-container" class='tab-container'>
     <ul class='etabs'>
       <li class='tab'><a href="#review-tab">Review</a></li>
       <li class='tab'><a href="#survey">Survey</a></li>
       <li class='tab'><a href="#social-media-tab">Social Media</a></li>
     </ul>
     <div class='panel-container'>

      <!-- Start review TAB -->
       <div id="review-tab">
        <div class='card'>
          <div class='card-header'>
            <h2>All reviews </h2>
          </div>
          <div class='card-body'>
            <div class='review-block'>
              @foreach($surveys as $survey)
                <div class='review-single'>
                  <div class='review-date-rating'> {{$survey->created_at->format('Y-m-d')}}
                    <span class='rating'>
                      @for($i = 0; $i < $survey->rating; $i++)
                        <i class="fa fa-star"></i>
                        @endfor
                    </span>
                  </div>
                  <div class='blockquote'>
                    <h3>{{$survey->title}}</h3>
                    <p>
                      {{$survey->content}}
                    </p>
                  </div>
                  <h3 class="reviewer">{{$survey->reviewer_name}}</h3>
                </div>
              @endforeach
            </div>
            <!-- /.review-block -->
          </div>
        </div>
       </div>
      <div id="social-media-tab">
          <div class="nested">
            <h2>Manage - Get - Social Media info in One place </h2>
            <br>
            <div id='tab-container-2' class='tab-container'>
               <ul class='etabs'>
                 <li class='tab'><a href="#facebook-tab">Facebook</a></li>
                 <li class='tab'><a href="#other-social-media">Social Media Info</a></li>
               </ul>
               <div class='panel-container'>
                 <div id="facebook-tab">

                  <h3>Your restaurant facebook page</h3>
                  <br>
                  <?php
                    $width = 300;
                    if (Agent::isDesktop()) {
                      $width = 800;
                    } else if (Agent::isTablet()) {
                      $width = 480;
                    } else if (Agent::isMobile()){
                      $width = 280;
                    }

                  ?>
                  <div class="fb-page" data-href="{{$data->setting->facebook}}" data-tabs="timeline" data-width="{{$width}}" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/LaravelCommunity" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/LaravelCommunity">Laravel</a></blockquote></div>
                 </div>
                 <div id="other-social-media">
                    <div id="containerTweet"></div>
                    Information of other social media
                 </div>
               </div>
            </div>
            <!-- /#tab-container-2.tab-container -->
          </div>
      </div>


       <!-- Start Survey tab -->
      <div id="survey">
        <h2>Give Us A feedback</h2>
        <form id="survey_form" action="{{action('SurveyController@survey_store')}}" method="post">
          {{csrf_field()}}
          <div class="survey_form_error alert alert-danger">
            <p>name not having</p>
            <p>email not having</p>
          </div>
          <input type='text' name="reviewer_name" placeholder="Enter Your Name" />
          <input type='text' name="reviewer_email" placeholder="Enter Your Email" />
          <input type="text" name="title" placeholder="Enter Review Title">
          <input type="hidden" name="user_id" value="{{ $user_id }}">
          <label>Select Rating</label>
          <select name="rating">
            <option value="1">Rating 1</option>
            <option value="2">Rating 2</option>
            <option value="3">Rating 3</option>
            <option value="4">Rating 4</option>
            <option value="5" selected>Rating 5</option>
          </select>
          <textarea name="content" placeholder="Enter your review"></textarea>
          <button id="survey_form_button" type="submit">Submit feedback</button>
        </form>
      </div>
     </div>
    </div>
    <div class='footer-content-modal'>
        <div id='model_footer_content'>
          <div class="footer-inner">
            <div class="container">
              <div class="row">
                <div class="col-md-12 footerlinker">
                  <div class="footer-social">
                    <h3>Find us</h3>
                    <ul>
                      <li><a href="<?= (isset($setting->facebook) && !empty($setting->facebook)) ? $setting->facebook : '#'; ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                      <li class="hidden"><a href="<?= (isset($setting->twitter) && !empty($setting->twitter)) ? $setting->twitter : '#'; ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
                      <li><a href="<?= (isset($setting->instagram) && !empty($setting->instagram)) ? $setting->instagram : '#'; ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
                      <li class="hidden"><a href="<?= (isset($setting->pintrest) && !empty($setting->pintrest)) ? $setting->pintrest : '#'; ?>" target="_blank"><i class="fa fa-pinterest"></i></a></li>
                      <li class="hidden"><a href="<?= (isset($setting->tumbler) && !empty($setting->tumbler)) ? $setting->tumbler : '#'; ?>" target="_blank"><i class="fa fa-tumblr"></i></a></li>
                    </ul>
                  </div>
                </div>
                <!--subscribe form-->
                <div class="col-md-4 hidden">
                  <div class="footer-info">
                    <h4>Newsletter</h4>
                    <div class="subcribe-form">
                      <form id="subscribe">
                        @csrf
                        <input class="enteremail" name="email" id="subscribe-email" placeholder="Your email address.." spellcheck="false" type="text">
                        <button type="submit" id="subscribe-button" class="subscribe-button"><i class="fa fa-envelope"></i></button>
                        <label for="subscribe-email" class="subscribe-message"></label>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <div class="bold-separator">
                <span></span>
              </div>
              <!--footer contacts links -->
              {{--<ul class="footer-contacts">
                <li><a href="#">+7(111)123456789</a></li>
                <li><a href="#">27th Brooklyn New York, NY 10065</a></li>
                <li><a href="#">yourmail@domain.com</a></li>
              </ul>--}}
            </div>
          </div>
          <div class="to-top-holder">
            <div class="container">
              <p><span> &#169; {{ date('Y') }} . </span> All rights reserved.</p>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>

<!-- Link to open the modal -->
{{-- <p><a title="Info" href="#ex1" class="footer-modal-trigger" rel="modal:open">i</a></p> --}}
<p><a class="footer-modal-trigger" href="#ex8">i</a></p>


@push('js_stack')
<script>

$('a[href="#ex8"]').click(function(event) {
  event.preventDefault();
  $(this).modal({
    fadeDuration: 500,
    fadeDelay: 0.50
  });
});

$(document).ready( function() {
  $('#tab-container').easytabs({uiTabs: true});
  $('#tab-container-2').easytabs({uiTabs: true});
});

 (function () {
  var Survey = {
    init: function () {
      this.domCached()
      this.bindEvents()
      $('.alert-danger').hide();
    },
    domCached: function () {
      this.$survey_form_button = $('#survey_form_button');
      this.$survey_form = $('#survey_form');
      this.$reviewer_name = $('input[name=reviewer_name]')
      this.$reviewer_email = $('input[name=reviewer_email]')
      this.$user_id = $('input[name=user_id]')
      this.$title = $('input[name=title]')
      this.$content = $('textarea[name=content]')
      this.$rating = $('select[name=rating]')
    },
    bindEvents: function () {
      this.$survey_form.on('submit', this.formSubmit.bind(this))
    },
    btnSpinning: function () {
      this.$survey_form_button.html(`<i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></i>`)
    },
    btnRevert: function () {
      this.$survey_form_button.html('Submit Survey')
    },
    formSubmit: function (e) {
        e.preventDefault();
        this.reviewer_name = this.$reviewer_name.val()
        this.reviewer_email = this.$reviewer_email.val()
        this.title = this.$title.val()
        this.content = this.$content.val()
        this.rating = this.$rating.find('option:selected').val()
        this.user_id = this.$user_id.val()
        this.actionUrl = this.$survey_form.attr('action')
        this.csrfToken = $('meta[name="csrf-token"]').attr('content');
        // this.modalFormSubmitBtn.innerHTML = `<i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></i>`
        this.clearErrors();
        this.btnSpinning();
        this.makeAjaxCall()
    },
    clearFields: function () {
      this.$reviewer_name.val('');
      this.$reviewer_email.val('');
      this.$title.val('');
      this.$content.val('');
    },
    clearErrors: function () {
        $('.alert-danger').html('');
        $('.alert-danger').hide(1);
    },
    showingSweetAlert: function () {
      swal({
          title: `Hello ${this.reviewer_name}`,
          text:  'Your Feedback Received. Thank You',
          type: 'success'
      })
    },
    makeAjaxCall: function () {
      console.log('this in makeAjaxCall', this)
       $.ajax({
            headers: {'X-CSRF-TOKEN': this.csrfToken},
            type: 'POST',
            url: this.actionUrl,
            data:{
              reviewer_name: this.reviewer_name,
              reviewer_email: this.reviewer_email,
              user_id: this.user_id,
              title: this.title,
              content: this.content,
              rating: this.rating,
            },
            success: (data) => {
              console.log('data', data);
              this.btnRevert();
              this.showingSweetAlert()
              this.clearFields();
            },
            error: (request, status, error) => {
                this.btnRevert()
                var response = JSON.parse(request.responseText)
                if (response.errors) {
                  console.log(response)
                    $('.alert-danger').show();
                    Object.keys(response.errors).forEach(key => $('.alert-danger').append('<p><strong>'+ response.errors[key][0]  +'</strong></p>') )
                }

            }
        });
    }
  }
  Survey.init();
}());

(function () {
  var app = {
    init: function () {
      this.domCached();
      this.addContent();
    },
    domCached: function () {
      this.$modalFooterContent = $('#model_footer_content')
      this.$footerContent = $('#other_footer_content')
    },
    addContent: function () {
      this.$modalFooterContent.html(
          this.$footerContent.html()
        )
    },
  }
  // app.init();

}());

</script>
@endpush
