$('.filter .form-control').on('change', function(){
  $('#search-form').submit();
});

// pilihan di add form
var selectedOption;

function addOption(selector, option) {
  selectedOption = selector.children("option:selected").val();
  option.children('option').not('.default').addClass('d-none');
  option.children('option[data-on="' + selectedOption + '"]').removeClass('d-none');

  selector.on('change', function(){
    selectedOption = $(this).children("option:selected").val();
    option.children('option').not('.default').addClass('d-none');
    option.children('option[data-on="' + selectedOption + '"]').removeClass('d-none');
    option.find('.default').prop('selected', true);
  });
}

addOption($('#akomodasi-add #tipe'), $('#akomodasi-add #level'));
addOption($('#kecamatan'), $('#gampong'));

// addOption($('#objwis-add #kecamatan'), $('#objwis-add #gampong'));
// addOption($('#kuliner-add #kecamatan'), $('#kuliner-add #gampong'));
// addOption($('#biroper-add #kecamatan'), $('#biroper-add #gampong'));
// addOption($('#ekokrea-add #kecamatan'), $('#ekokrea-add #gampong'));
// addOption($('#sanggar-add #kecamatan'), $('#sanggar-add #gampong'));
