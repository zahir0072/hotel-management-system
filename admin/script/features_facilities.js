
let features_s_form = document.getElementById('features_s_form');
let facility_s_form = document.getElementById('facility_s_form');

features_s_form.addEventListener('submit', function (e) {
  e.preventDefault();
  add_feature();
});

function add_feature() {
  let data = new FormData();
  data.append('name', features_s_form.elements['features_name'].value);
  data.append('add_feature', '');

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/features_facilities.php", true);

  xhr.onload = function () {
    var myModal = document.getElementById('features-s');
    var modal = bootstrap.Modal.getOrCreateInstance(myModal);
    modal.hide();

    if (this.responseText == 1) {
      alert('success', 'New feature added!');
      features_s_form.elements['features_name'].value = '';
      get_features();
    } else {
      alert('error', 'Server Down!');
    }
  };

  xhr.send(data);
}


function get_features() {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/features_facilities.php", true);
  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

  xhr.onload = function () {
    document.getElementById('features-data').innerHTML = this.responseText;
  };

  xhr.send('get_features');
}

function rem_feature(val) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/features_facilities.php", true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  xhr.onload = function () {
    if (this.responseText == 1) {
      alert('success', 'Features remove!');
      get_features();
    } else if (this.responseText == 'room_added') {
      alert('error', 'Feature is added in room!')
    } else {
      alert('error', 'Server downe!');
    }
  }

  xhr.send('rem_feature=' + encodeURIComponent(val));
}

facility_s_form.addEventListener('submit', function (e) {
  e.preventDefault();
  add_facility();
});

function add_facility() {
  let data = new FormData();
  data.append('name', facility_s_form.elements['facility_name'].value);
  data.append('icon', facility_s_form.elements['facility_icon'].files[0]);
  data.append('desc', facility_s_form.elements['facility_desc'].value);
  data.append('add_facility', '');

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/features_facilities.php", true);

  xhr.onload = function () {
    var myModal = document.getElementById('facility-s');
    var modal = bootstrap.Modal.getOrCreateInstance(myModal);
    modal.hide();

    if (this.responseText == 'inv_img') {
      alert('error', 'Only SVG image are allowed!');
    }
    if (this.responseText == 'inv_size') {
      alert('error', 'Image Should be less than 1GB!');
    }
    if (this.responseText == 'upd_failed') {
      alert('error', 'Image Upload failed. Serevr Down!');
    } else {
      alert('success', 'New Facility member added!');
      facility_s_form.reset();
      get_facilities();
    }
  };

  xhr.send(data);
}

function get_facilities() {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/features_facilities.php", true);
  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

  xhr.onload = function () {
    document.getElementById('facilities-data').innerHTML = this.responseText;
  };

  xhr.send('get_facilities');
}

function rem_facility(val) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/features_facilities.php", true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  xhr.onload = function () {
    if (this.responseText == 1) {
      alert('success', 'Facility remove!');
      get_facilities();
    } else if (this.responseText == 'room_added') {
      alert('error', 'Facility is added in room!')
    } else {
      alert('error', 'Server downe!');
    }
  }

  xhr.send('rem_facility=' + (val));
}

window.onload = function () {
  get_features();
  get_facilities();
}
