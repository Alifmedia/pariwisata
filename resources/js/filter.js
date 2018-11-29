var html;
var field;

function addOption(selector, opts) {
  html = '<option>Semua</option>';
  selector.append(html);
  for (var i = 0; i < opts.length; i++) {
    html = '<option value="' + opts[i] + '">' + opts[i] + '</option>';
    selector.append(html);
  }
}

function addResponsiveOptionSub(selector, according, opt) {
  console.log(selector, according, opt);
  selector.empty();
  selected = according.find(':selected').val().replace(/ /gi, "_");
  option = opt[selected];
  if (!option) {
    field = according.siblings('label').html();
    html = '<option>Pilih '+ field +'</option>';
    selector.append(html);
    selector.prop('disabled', true);
    return;
  }
  selector.prop('disabled', false);
  for (var i = 0; i < option.length; i++) {
    html = '<option value="' + option[i] + '">' + option[i] + '</option>';
    selector.append(html);
  }
}

function addResponsiveOption(selector, according, opt) {
  addResponsiveOptionSub(selector, according, opt)
  according.on('change', function(){
    addResponsiveOptionSub(selector, according, opt)
  });
}

//fields

var tipe = [ 'Hotel', 'Losmen', 'Wisma', 'Guesthouse', 'Homestay' ];

var levelSub = ['Ekonomi', 'Standard', 'Eklusif'];
var level = {
  Hotel : [ 'Bintang 1', 'Bintang 2', 'Bintang 3', 'Bintang 4', 'Bintang 5' ],
  Losmen : [ 'Melati 1', 'Melati 2' ],
  Wisma : levelSub,
  Guesthouse : levelSub,
  Homestay : levelSub,
};
var kecamatan = [ 'Baiturrahman', 'Kuta Alam', 'Meuraxa', 'Syiah Kuala', 'Lueng Bata', 'Kuta Raja', 'Banda Raya', 'Jaya Baru', 'Ulee Kareng' ];
var gampong = {
   Baiturrahman: [ 'Ateuk Jawo', 'Ateuk Deah Tanoh', 'Ateuk Pahlawan', 'Ateuk Munjeng', 'Neusu Aceh', 'Seutui', 'Sukaramai', 'Neusu Jaya', 'Peuniti', 'Kampung Baru'],
   Kuta_Alam: [ 'Peunayong', 'Laksana', 'Keuramat', 'Kuta Alam', 'Beurawe', 'Kota Baru', 'Bandar Baru', 'Mulia', 'Lampulo', 'Lamdingin', 'Lambaro Skep' ],
   Meuraxa: [ 'Surien', 'Aso Nanggroe', 'Gampong Blang', 'Lamjabat', 'Gampong Baro', 'Punge Jurong', 'Lampaseh Aceh', 'Punge Ujong', 'Cot Lamkeuweuh', 'Gampong Pie', 'Ulee Lheue', 'Deah Glumpang', 'Lambung', 'Blang Oi', 'Alue Deah Teungoh', 'Deah Baro' ],
   Syiah_Kuala: [ 'Ie Maseng Kaye Adang', 'Gampong Pineung', 'Lamgugob', 'Kopelma Darussalam', 'Rukoh', 'Jeulingke', 'Tibang', 'Deah Raya', 'Aleu Naga', 'Peurada' ],
   Lueng_Bata: [ 'Lamdom', 'Cot Masjid', 'Bathoh', 'Lueng Bata', 'Blang Cut', 'Lampaloh', 'Suka Damai', 'Panteriek', 'Lamseupeung' ],
   Kuta_Raja: [ 'Lampaseh Kota', 'Merduati', 'Keudah', 'Peulanggahan', 'Gampong Jawa', 'Gampong Pande' ],
   Banda_Raya: [ 'Lam Ara', 'Lampeuot', 'Mibo', 'Lhong Cut', 'Lhong Raya', 'Peunyerat', 'Lamlagang', 'Geuceu Komplek', 'Geuceu Inem', 'Geuceu Kayee Jato' ],
   Jaya_Baru: [ 'Ulee Pata', 'Lamjamee', 'Lampoh Daya', 'Emperom', 'Geuceu Meunara', 'Lamteumen Barat', 'Lamteumen Timur', 'Bitai', 'Punge Blang Cut' ],
   Ulee_Kareng: [ 'Pango Raya', 'Pango Deah', 'Ilie', 'Lamteh', 'Lamglumpang', 'Ceurih', 'Ie Masen Ulee Kareng', 'Doi', 'Lambhuk' ]
};
var phri = ['Ya', 'Tidak'];
var izin = [ 'Aktif', 'Non-Aktif' ];
var tipeBiroPer = [ 'BPW', 'APW' ];
var tipeObjWis = [ 'Bangunan', 'Benda', 'Makam', 'Taman', 'Monumen', 'Rumah', 'Tugu', 'Situs', 'Taman/Bangunan/Makam' ];



//call function for options in fields
if ($('#akomodasi').length) {
  addOption($('#akomodasi #data #filter1'), tipe);
  addResponsiveOption($('#akomodasi #data #filter2'), $('#akomodasi #data #filter1') , level);
  addOption($('#akomodasi #data #filter3'), kecamatan);
  addResponsiveOption($('#akomodasi #data #filter4'), $('#akomodasi #data #filter3') , gampong);
  addOption($('#akomodasi #data #filter5'), phri);
  addOption($('#akomodasi #data #filter6'), izin);
}

if ($('#biro-perjalanan').length) {
  addOption($('#biro-perjalanan #data #filter1'), tipeBiroPer);
  addOption($('#biro-perjalanan #data #filter2'), kecamatan);
  addResponsiveOption($('#biro-perjalanan #data #filter3'), $('#biro-perjalanan #data #filter2') , gampong);
}

if ($('#objek-wisata').length) {
  addOption($('#objek-wisata #data #filter1'), tipeObjWis);
  addOption($('#objek-wisata #data #filter2'), kecamatan);
  addResponsiveOption($('#objek-wisata #data #filter3'), $('#objek-wisata #data #filter2') , gampong);
}
