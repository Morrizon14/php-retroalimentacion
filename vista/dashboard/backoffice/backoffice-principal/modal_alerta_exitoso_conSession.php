<?php
if (isset($_SESSION['mensaje']) && $_SESSION['mensaje'] != "") {
?>
  <script>
    Swal.fire({
      position: "center",
      icon: "success",
      title: "<?php echo $_SESSION['mensaje']; ?>",
      showConfirmButton: false,
      timer: 1500,
    });
  </script>
<?php
  unset($_SESSION['mensaje']);
}
?>