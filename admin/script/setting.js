
let general_data, contacts_data;

let general_s_form = document.getElementById('general_s_form');
let site_title_inp = document.getElementById('site_title_inp');
let site_about_inp = document.getElementById('site_about_inp');

let contacts_s_form = document.getElementById('contacts_s_form');

let team_s_form = document.getElementById('team_s_form');
let member_name_inp = document.getElementById('member_name_inp');
let member_picture_inp = document.getElementById('member_picture_inp');

function get_general() {
  let site_title = document.getElementById('site_title');
  let site_about = document.getElementById('site_about');

  let shutdown_toggle = document.getElementById('shutdown-toggle');

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/settings_crud.php", true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  xhr.onload = function () {
    try {
      console.log('General response:', this.responseText);
      general_data = JSON.parse(this.responseText);

      site_title.innerText = general_data.site_title;
      site_about.innerText = general_data.site_about;

      site_title_inp.value = general_data.site_title;
      site_about_inp.value = general_data.site_about;

      if (general_data.shutdown == 0) {
        shutdown_toggle.checked = false;
        shutdown_toggle.value = 0;
      } else {
        shutdown_toggle.checked = true;
        shutdown_toggle.value = 1;
      }

    } catch (e) {
      console.error('Failed to parse response:', this.responseText);
      console.error('Error:', e);
    }

  };

  xhr.onerror = function () {
    console.error('Network error in get_general');
  };

  xhr.send('get_general=1');
}

general_s_form.addEventListener('submit', function (e) {
  e.preventDefault();
  upd_general(site_title_inp.value, site_about_inp.value);
});

function upd_general(site_title_val, site_about_val) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/settings_crud.php", true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  xhr.onload = function () {
    var myModal = document.getElementById('general-s')
    var modal = bootstrap.Modal.getInstance(myModal)
    modal.hide();

    if (this.responseText == 1) {
      alert('success', 'Changes saved!')
      get_general();
    } else {
      alert('error', ' No changes made!')
    }

  };


  const params = 'site_title=' + encodeURIComponent(site_title_val) + '&site_about=' + encodeURIComponent(site_about_val) + '&upd_general=1';

  xhr.send(params);
}

function upd_shutdown(val) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/settings_crud.php", true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  xhr.onload = function () {

    if (this.responseText == 1) {
      if (val == 0) {
        alert('success', 'Site has been shutdown!');
      } else {
        alert('success', 'Shutdown mode off!');
      }
    }
    get_general();
  };

  xhr.onerror = function () {
    alert('error', 'Network error occurred!');
  };

  const params = 'upd_shutdown=' + encodeURIComponent(val);
  xhr.send(params);
}

function get_contacts() {

  let contacts_p_id = ['address', 'gmap', 'pn1', 'pn2', 'email', 'insta', 'fb', 'tw'];
  let iframe = document.getElementById('iframe');

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/settings_crud.php", true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  xhr.onload = function () {

    contacts_data = JSON.parse(this.responseText);
    contacts_data = Object.values(contacts_data);

    for (i = 0; i < contacts_p_id.length; i++) {
      document.getElementById(contacts_p_id[i]).innerHTML = contacts_data[i + 1];
    }
    iframe.src = contacts_data[9];
    contacts_inp(contacts_data);
  };

  xhr.send('get_contacts');
}

function contacts_inp(data) {
  let contacts_inp_id = ['address_inp', 'gmap_inp', 'pn1_inp', 'pn2_inp', 'email_inp', 'insta_inp', 'fb_inp', 'tw_inp', 'iframe_inp'];

  for (i = 0; i < contacts_inp_id.length; i++) {
    document.getElementById(contacts_inp_id[i]).value = data[i + 1];
  }
}

contacts_s_form.addEventListener('submit', function (e) {
  e.preventDefault();
  upd_contacts();
});

function upd_contacts() {
  let index = ['address', 'gmap', 'pn1', 'pn2', 'email', 'insta', 'fb', 'tw', 'iframe'];
  let contacts_inp_id = ['address_inp', 'gmap_inp', 'pn1_inp', 'pn2_inp', 'email_inp', 'insta_inp', 'fb_inp', 'tw_inp', 'iframe_inp'];

  let data_str = "";

  for (let i = 0; i < index.length; i++) {
    let value = document.getElementById(contacts_inp_id[i]).value;
    data_str += encodeURIComponent(index[i]) + "=" + encodeURIComponent(value) + "&";
  }

  // Add the action flag at the end
  data_str += "upd_contacts=true";

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/settings_crud.php", true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  xhr.onload = function () {
    var myModal = document.getElementById('contacts-s');
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    if (this.responseText == 1) {
      alert('success', 'Changes saved!');
      get_contacts();
    } else {
      alert('error', 'No changes made!');
    }
  }

  xhr.send(data_str);
}

team_s_form.addEventListener('submit', function (e) {
  e.preventDefault();
  add_member();
});

function add_member() {
  let data = new FormData();
  data.append('name', member_name_inp.value);
  data.append('picture', member_picture_inp.files[0]);
  data.append('add_member', '');

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/settings_crud.php", true);

  xhr.onload = function () {
    var myModal = document.getElementById('team-s')
    var modal = bootstrap.Modal.getInstance(myModal)
    modal.hide();

    if (this.responseText == 'inv_img') {
      alert('error', 'Only JPG and PNG image are allowed!');
    }
    if (this.responseText == 'inv_size') {
      alert('error', 'Image Should be less than 2GB!');
    }
    if (this.responseText == 'upd_failed') {
      alert('error', 'Image Upload failed. Serevr Down!');
    } else {
      alert('success', 'New member added!');
      member_name_inp.value = '';
      member_picture_inp.value = '';
      get_members();
    }
  };

  xhr.send(data);

}

function get_members() {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/settings_crud.php", true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  xhr.onload = function () {
    document.getElementById('team-data').innerHTML = this.responseText;

  }

  xhr.send('get_members');
}

function rem_member(val) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/settings_crud.php", true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  xhr.onload = function () {
    if (this.responseText == 1) {
      alert('success', 'Member remove!');
      get_members();
    } else {
      alert('error', 'Server downe!');
    }
  }

  xhr.send('rem_member=' + encodeURIComponent(val));
}

window.onload = function () {
  get_general();
  get_contacts();
  get_members();
};
