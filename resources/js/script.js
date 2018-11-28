$('.carousel').carousel();

$('.check-all').on('click', function(){
  $('.check').prop('checked', this.checked);
})
