<footer class="footer footer-light @if(isset($configData['footerType'])){{$configData['footerClass']}}@endif">
  <p class="clearfix mb-0">
    <span class="float-left d-inline-block"><script>document.write(new Date().getFullYear())</script> &copy; Lemon Beads LLC</span>
    <span class="float-right d-sm-inline-block d-none">Crafted with
      <i class="bx bxs-heart pink mx-50 font-small-3"></i>by
      <a class="text-uppercase" href="https://lemonbeads.jo" target="_blank">Lemon Beads</a>
    </span>
  </p>
  @if($configData['isScrollTop'] === true)
  <button class="btn btn-primary btn-icon scroll-top" type="button" style="display: inline-block;">
  <i class="bx bx-up-arrow-alt"></i>
  </button>
  @endif
</footer>

