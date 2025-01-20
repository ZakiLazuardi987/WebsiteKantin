</div>
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- Default to the left -->
    <strong>Copyright &copy; 2025 <a href="/">Website Kantin</a>.</strong> All rights
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="/assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/assets/dist/js/adminlte.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>
  document.addEventListener('DOMContentLoaded', function () {
      const form = document.getElementById('editForm');
      const submitButton = document.getElementById('saveButton');

      if (form && submitButton) {
          submitButton.addEventListener('click', function (event) {
              event.preventDefault();  // Mencegah form untuk submit langsung

              Swal.fire({
                  title: 'Konfirmasi Simpan',
                  text: 'Apakah Anda yakin ingin mengubah data ini?',
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonText: 'Ya, Simpan!',
                  cancelButtonText: 'Batal',
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33'
              }).then((result) => {
                  if (result.isConfirmed) {
                      form.submit();  // Submit form jika konfirmasi
                  }
              });
          });
      }
  });
</script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
      const deleteForms = document.querySelectorAll('.delete-form');
      
      deleteForms.forEach(form => {
          form.addEventListener('submit', function (event) {
              event.preventDefault(); // Mencegah form untuk submit langsung

              Swal.fire({
                  title: 'Konfirmasi Hapus',
                  text: "Apakah Anda yakin ingin menghapus data ini?",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonText: 'Ya, Hapus!',
                  cancelButtonText: 'Batal',
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33'
              }).then((result) => {
                  if (result.isConfirmed) {
                      form.submit();  // Submit form jika dikonfirmasi
                  }
              });
          });
      });
  });
</script>




</body>
</html>
