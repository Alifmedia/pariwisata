$('.carousel').carousel();

// delete soon
$filterTipe = $('.akomodasi .data #filter1 option');
// $valueFilterTipe = $filterTipe.val();
$filterLevel = $('.akomodasi .data #filter2');
$options = '<option>Pilih Tipe</option>';
$filterLevel.html($options);
$filterLevel.prop('disabled', true);


$('.akomodasi .data #filter1').on('change', function () {
  $valueFilterTipe = $(this).find(':selected').val();
  console.log($valueFilterTipe);
  if ($valueFilterTipe == 'All') {
    $filterLevel.prop('disabled', true);
    $options = '<option>Pilih Tipe</option>';
  } else if ($valueFilterTipe == 'Hotel') {
    $filterLevel.prop('disabled', false);
    $options = `<option>Bintang 1</option>
                <option>Bintang 2</option>
                <option>Bintang 3</option>
                <option>Bintang 4</option>
                <option>Bintang 5</option>`;
  } else {
    $filterLevel.prop('disabled', false);
    $options = `<option>Ekonomi</option>
                <option>Standar</option>
                <option>Eklusif</option>`;
  }

  $filterLevel.html($options);
})
