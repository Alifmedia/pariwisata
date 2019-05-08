//upload image
$('.custom-file-input').change(function(){
  var $wrapper = $(this).parents('.form-group');
  var $preview = $wrapper.find('.preview-input-image');
  var $previewImg = $preview.find('.card-columns');
  var $progressBar = $preview.find('.progress-bar');

  var $lable = $(this).siblings('.custom-file-label');

  $previewImg.empty();
  $preview.removeClass('d-block');

  if (this.files.length <= 0) {
    $lable.html("Choose file");
    return 0;
  }

  if (this.files.length > 6) {
    alert("Gambar tidak boleh lebih dari 6.");
    return 0;
  }

  var uploadedImg = 0;
  var singleBar = 100/this.files.length;
  updateProgress($progressBar, 0);

  $preview.addClass('d-block');

  var files = this.files;
  var displayImage = new Promise(function(resolve, reject) {
    for (let file of files) {
      var reader = new FileReader();
      reader.onload = function (e) {
        fixOrientation(e.target.result, { image: true }, function (fixed, image) {
          var html = `<div class='card'>
                      <img src='${fixed}' data-toggle="tooltip" data-placement="bottom" title="${file.name}" alt='uploaded image'>
                      </div>`;
          $previewImg.append(html);
        });
        uploadedImg++;
        updateProgress($progressBar, uploadedImg*singleBar);
        if (uploadedImg >= files.length) {
          resolve('images successfuly displayed');
        }
      }
      $lable.html(uploadedImg + ' file' + (uploadedImg > 1 ? 's' : ''));
      reader.readAsDataURL(file);
    }
  });

  displayImage.then(function(msg){
    updateProgress($progressBar, 100);
    setTimeout(function(){
      $preview.find('.progress').fadeOut( "slow" );
    }, 1500);
  });

});

function updateProgress(progressbar, value) {
  progressbar.data('aria-valuenow', value);
  progressbar.css('width', value+'%');
}

$("#coba").change(function(){
  console.log(this.files);
});

//uploaded avatar
$(".file-upload").on('change', function() {
    if (this.files && this.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            fixOrientation(e.target.result, { image: true }, function (fixed, image) {
              $('.profile-pic').attr('src', fixed);
            });
        }
        reader.readAsDataURL(this.files[0]);
    }
});

$(".upload-button").on('click', function() {
   $(".file-upload").click();
});
