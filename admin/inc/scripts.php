<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script>
  function alert(type, msg, position = 'body') {
    let bs_class = (type === 'success') ? 'alert-success' : 'alert-danger';
    let element = document.createElement('div');
    element.innerHTML = `
      <div class="alert ${bs_class} alert-dismissible fade show " role="alert" aria-live="polite">
        <strong class="me-3">${msg}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    `;

    if (position === 'body') {
      document.body.append(element);
      element.classList.add('custom-alert');
    } else {
      const target = document.getElementById(position);
      if (target) {
        target.appendChild(element);
      } else {
        console.warn(`alert(): Element with ID '${position}' not found. Appending to body.`);
        document.body.append(element);
      }
    }

    setTimeout(remAlert, 2000);
  }

  function remAlert() {
    const alertEl = document.getElementsByClassName('alert')[0];
    if (alertEl) alertEl.remove();
  }
</script>
<script>
  function setActive() {
    let navbar = document.getElementById('dashbord-menu');
    let a_tags = navbar.getElementsByTagName('a');

    for (let i = 0; i < a_tags.length; i++) {
      let file = a_tags[i].href.split('/').pop();
      let file_name = file.split('.')[0];

      if (document.location.href.indexOf(file_name) >= 0) {
        a_tags[i].classList.add('active');
      }
    }
  }
  setActive();
</script>