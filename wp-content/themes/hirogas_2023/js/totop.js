document.addEventListener(
  "DOMContentLoaded",
  function () {
    document.querySelector(".btn_to_top").addEventListener("click", function () {
      window.scrollTo(0, 0);
    });
    window.addEventListener("scroll", function () {
      if (window.pageYOffset > "100") {
        document.querySelector(".btn_to_top").classList.add("is-active");
      } else {
        document.querySelector(".btn_to_top").classList.remove("is-active");
      }
    });
  },
  false
);
